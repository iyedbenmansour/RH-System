<?php

namespace App\Controller;

use App\Entity\Applicant;
use App\Service\CvKeywordExtractor;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Contracts\HttpClient\HttpClientInterface;

class BestMatchController extends AbstractController
{
    private HttpClientInterface $httpClient;

    public function __construct(HttpClientInterface $httpClient)
    {
        $this->httpClient = $httpClient;
    }

    #[Route('/best-match', name: 'best_match')]
    public function bestMatch(
        Request $request, 
        EntityManagerInterface $em, 
        CvKeywordExtractor $keywordExtractor
    ): Response {
        $jobs = null;
        $error = null;
        $count = 0;
        $cvKeywords = [];
        $profileLinks = [];

        if ($request->isMethod('POST')) {
            $cvFile = $request->files->get('cv');

            if (!$cvFile) {
                $error = 'Please upload your CV (PDF format).';
            } elseif (strtolower($cvFile->getClientOriginalExtension()) !== 'pdf') {
                $error = 'Only PDF files are accepted.';
            } else {
                $tmpPath = sys_get_temp_dir() . '/' . uniqid('cv_') . '.pdf';
                try {
                    $cvFile->move(dirname($tmpPath), basename($tmpPath));
                    $cvContent = $keywordExtractor->extractTextFromPdf($tmpPath);

                    if (!$cvContent) {
                        $error = 'Unable to read CV. Please ensure it\'s a valid PDF.';
                    } else {
                        $cvKeywords = $keywordExtractor->extractKeywordsFromCV($cvContent);

                        // Extract profile links from CV content
                        $profileLinks = $this->extractProfileLinks($cvContent);
                        $request->getSession()->set('profileLinks', $profileLinks);

                        // Save CV text to session for later use in quick apply
                        $request->getSession()->set('cvText', $cvContent);

                        if (empty($cvKeywords)) {
                            $error = 'No relevant keywords found in your CV.';
                        } else {
                            $conn = $em->getConnection();
                            $where = [];
                            foreach ($cvKeywords as $keyword) {
                                $where[] = "(j.title LIKE :kw_" . md5($keyword) . " OR j.description LIKE :kw_" . md5($keyword) . ")";
                            }
                            $whereSql = implode(' OR ', $where);
                            $params = [];
                            foreach ($cvKeywords as $keyword) {
                                $params['kw_' . md5($keyword)] = '%' . $keyword . '%';
                            }

                            $relevanceCases = [];
                            foreach ($cvKeywords as $keyword) {
                                $ph = 'kw_' . md5($keyword);
                                $relevanceCases[] =
                                    "(CASE WHEN j.title LIKE :$ph THEN 1 ELSE 0 END + CASE WHEN j.description LIKE :$ph THEN 1 ELSE 0 END)";
                            }

                            $sql = "
                                SELECT j.*, (
                                    " . implode(' + ', $relevanceCases) . "
                                ) AS relevance_score
                                FROM jobs j
                                WHERE $whereSql
                                ORDER BY relevance_score DESC, j.posted_date DESC
                                LIMIT 50
                            ";

                            $stmt = $conn->prepare($sql);
                            $result = $stmt->executeQuery($params)->fetchAllAssociative();

                            // Calculate and add match percentage for each job
                            $totalKeywords = count($cvKeywords);
                            foreach ($result as &$job) {
                                $jobMatchCount = 0;
                                $jobTitle = mb_strtolower($job['title']);
                                $jobDescription = mb_strtolower($job['description']);

                                foreach ($cvKeywords as $keyword) {
                                    if (
                                        mb_stripos($jobTitle, $keyword) !== false ||
                                        mb_stripos($jobDescription, $keyword) !== false
                                    ) {
                                        $jobMatchCount++;
                                    }
                                }
                                $job['match_percent'] = $totalKeywords > 0
                                    ? round(($jobMatchCount / $totalKeywords) * 100)
                                    : 0;
                            }

                            $jobs = $result;
                            $count = count($jobs);
                        }
                    }
                    @unlink($tmpPath);
                } catch (FileException $e) {
                    $error = 'File upload failed.';
                }
            }
        }

        // Fetch all applied job IDs for the current user (user_id = 1)
        $appliedJobIds = [];
        $appRepo = $em->getRepository(Applicant::class);
        $applications = $appRepo->findBy(['userId' => 1]);
        foreach ($applications as $application) {
            $appliedJobIds[] = $application->getJobId();
        }

        return $this->render('best_match/index.html.twig', [
            'jobs' => $jobs,
            'error' => $error,
            'count' => $count,
            'appliedJobIds' => $appliedJobIds, // <-- Pass to Twig
        ]);
    }

    #[Route('/quick-apply/{jobId}', name: 'quick_apply')]
    public function quickApply(
        int $jobId,
        EntityManagerInterface $em,
        Request $request
    ): Response {
        $job = $em->getConnection()->fetchAssociative('SELECT * FROM jobs WHERE id = ?', [$jobId]);
        
        if (!$job) {
            throw $this->createNotFoundException('Job not found');
        }

        // Check if already applied (using user ID 1)
        $existingApplication = $em->getRepository(Applicant::class)->findOneBy([
            'userId' => 1,
            'jobId' => $jobId
        ]);

        if ($existingApplication) {
            $this->addFlash('warning', 'Application already exists for this position.');
            return $this->redirectToRoute('best_match');
        }

        // Get profile links from session
        $profileLinks = $request->getSession()->get('profileLinks', []);
        $profileLink = $this->selectBestProfileLink($profileLinks);

        // Get CV text from session (may be null)
        $cvText = $request->getSession()->get('cvText');

        // Generate AI-powered application message using CV and job info
        $aiMessage = $this->generateApplicationMessage($job['title'], $job['description'], $cvText);

        // Create new application with user ID 1
        $application = new Applicant();
        $application->setUserId(1); // Hardcoded user ID
        $application->setJobId($jobId);
        $application->setCompanyId($job['company_id']);
        
        $comment = $aiMessage ?? "I'm excited to apply for this position. My skills and experience make me a strong candidate for this role.";
        
        if ($profileLink) {
            $comment .= ": " . $profileLink;
            $application->setAdditionalFile($profileLink);
        }
        
        $application->setComment($comment);
        $application->setStatus('Pending');

        $em->persist($application);
        $em->flush();

        $this->addFlash('success', 'Application submitted successfully!');
        return $this->redirectToRoute('best_match');
    }

    private function generateApplicationMessage(string $jobTitle, string $jobDescription, ?string $cvText = null): ?string
    {
        try {
            $cvTextForPrompt = $cvText ?? '';

            $prompt = <<<EOT
You are an expert career assistant.
Write a professional job application cover letter for the position "{$jobTitle}". 
The job description is: "{$jobDescription}".

The candidate's full CV is below:
----
{$cvTextForPrompt}
----

Instructions:
Write 3 concise paragraphs:
1. Express genuine interest and enthusiasm for the company and role.
2. Highlight Iyed’s most relevant skills, projects, or experiences for this job (based on the CV above).
3. End with a confident, positive closing and a call to action.

Maintain a professional, enthusiastic, and personal tone. Avoid generic statements. Reference specific details from the candidate CV and the job description.
EOT;

            $response = $this->httpClient->request('POST', 'https://openrouter.ai/api/v1/chat/completions', [
                'headers' => [
                    'Authorization' => 'Bearer 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',
                    'Content-Type' => 'application/json',
                ],
                'json' => [
                    'model' => 'mistralai/mixtral-8x7b-instruct',
                    'messages' => [
                        ['role' => 'user', 'content' => $prompt],
                    ],
                    'max_tokens' => 400,
                    'temperature' => 0.7,
                ],
                'timeout' => 30,
            ]);

            $content = $response->toArray();

            if (isset($content['choices'][0]['message']['content'])) {
                $message = trim($content['choices'][0]['message']['content']);
                // Remove incomplete last sentence
                $message = preg_replace('/[^.!?]+$/', '', $message);
                return $message;
            }

            return null;
        } catch (\Exception $e) {
            return null;
        }
    }

    private function extractProfileLinks(string $text): array
    {
        $links = [];
        $pattern = '/\b(?:https?:\/\/)?(?:www\.)?(?:github\.com\/[a-zA-Z0-9-]+|linkedin\.com\/in\/[a-zA-Z0-9-]+)\b/';
        
        if (preg_match_all($pattern, $text, $matches)) {
            foreach ($matches[0] as $match) {
                if (!preg_match('/^https?:\/\//i', $match)) {
                    $match = 'https://' . $match;
                }
                $links[] = $match;
            }
        }
        
        return array_unique($links);
    }

    private function selectBestProfileLink(array $links): ?string
    {
        if (empty($links)) {
            return null;
        }

        foreach ($links as $link) {
            if (stripos($link, 'linkedin.com') !== false) {
                return $link;
            }
        }

        return $links[0];
    }
}