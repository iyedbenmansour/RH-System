<?php

namespace App\Controller;

use App\Entity\Applicant;
use App\Entity\Job;
use App\Entity\Candidat;
use App\Service\CvKeywordExtractor;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Contracts\HttpClient\HttpClientInterface;
use Symfony\Component\HttpClient\HttpClient;
use App\Repository\CandidatRepository;

class BestMatchController extends AbstractController
{
    private HttpClientInterface $httpClient;

    public function __construct(HttpClientInterface $httpClient)
    {
        $this->httpClient = $httpClient;
    }

    /**
     * Extract candidat_id from session/cookie/token
     */
    private function getCandidatId(Request $request): ?int
    {
        return $request->getSession()->get('candidat_id');
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

        $candidatId = $this->getCandidatId($request);
        if (!$candidatId) {
            throw $this->createAccessDeniedException('User not authenticated.');
        }

        $candidatRepo = $em->getRepository(Candidat::class);
        /** @var Candidat|null $candidat */
        $candidat = $candidatRepo->find($candidatId);

        if (!$candidat) {
            throw $this->createNotFoundException('Candidate not found.');
        }

        $cvFilePath = null;
        $cvContent = null;

        if ($request->isMethod('POST')) {
            $cvFile = $request->files->get('cv');
            if (!$cvFile) {
                $error = 'Please upload your CV (PDF format).';
            } elseif (strtolower($cvFile->getClientOriginalExtension()) !== 'pdf') {
                $error = 'Only PDF files are accepted.';
            } else {
                $uploadDir = $this->getParameter('kernel.project_dir') . '/public/uploads/cv';
                $cvFileName = 'cv_' . $candidatId . '_' . uniqid() . '.pdf';

                try {
                    $cvFile->move($uploadDir, $cvFileName);
                    $candidat->setCv($cvFileName);
                    $em->flush();

                    $cvFilePath = $uploadDir . '/' . $cvFileName;
                    $cvContent = $keywordExtractor->extractTextFromPdf($cvFilePath);

                    if (!$cvContent) {
                        $error = 'Unable to read CV. Please ensure it\'s a valid PDF.';
                    }
                } catch (FileException $e) {
                    $error = 'File upload failed.';
                }
            }
        }

        if (!$cvContent && $candidat->getCv()) {
            $uploadDir = $this->getParameter('kernel.project_dir') . '/public/uploads/cv';
            $cvFilePath = $uploadDir . '/' . $candidat->getCv();
            if (file_exists($cvFilePath)) {
                $cvContent = $keywordExtractor->extractTextFromPdf($cvFilePath);
            } else {
                $error = 'Your CV file could not be found on the server. Please upload it again.';
            }
        }

        if ($cvContent && !$error) {
            $cvKeywords = $keywordExtractor->extractKeywordsFromCV($cvContent);
            $profileLinks = $this->extractProfileLinks($cvContent);
            $request->getSession()->set('profileLinks', $profileLinks);
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

        $appliedJobIds = [];
        $appRepo = $em->getRepository(Applicant::class);
        $applications = $appRepo->findBy(['userId' => $candidatId]);
        foreach ($applications as $application) {
            $appliedJobIds[] = $application->getJobId();
        }

        return $this->render('best_match/index.html.twig', [
            'jobs' => $jobs,
            'error' => $error,
            'count' => $count,
            'appliedJobIds' => $appliedJobIds,
        ]);
    }

    #[Route('/quick-apply/{jobId}', name: 'quick_apply')]
    public function quickApply(
        int $jobId,
        EntityManagerInterface $em,
        Request $request,
        CandidatRepository $candidatRepository
    ): Response {
        $candidatId = $this->getCandidatId($request);
        if (!$candidatId) {
            throw $this->createAccessDeniedException('User not authenticated.');
        }

        $job = $em->getRepository(Job::class)->find($jobId);
        if (!$job) {
            throw $this->createNotFoundException('Job not found');
        }

        $existingApplication = $em->getRepository(Applicant::class)->findOneBy([
            'userId' => $candidatId,
            'jobId' => $jobId
        ]);

        if ($existingApplication) {
            $this->addFlash('warning', 'Application already exists for this position.');
            return $this->redirectToRoute('best_match');
        }

        $profileLinks = $request->getSession()->get('profileLinks', []);
        $profileLink = $this->selectBestProfileLink($profileLinks);

        $cvText = $request->getSession()->get('cvText');

        $aiMessage = $this->generateApplicationMessage($job->getTitle(), $job->getDescription(), $cvText);

        $application = new Applicant();
        $application->setUserId($candidatId);
        $application->setJobId($jobId);
        $application->setCompanyId($job->getCompanyId());

        $comment = $aiMessage ?? "I'm excited to apply for this position. My skills and experience make me a strong candidate for this role.";

        if ($profileLink) {
            $comment .= ": " . $profileLink;
            $application->setAdditionalFile($profileLink);
        }

        $application->setComment($comment);
        $application->setStatus('Pending');

        $em->persist($application);
        $em->flush();

        $candidat = $candidatRepository->find($candidatId);
        if ($candidat) {
            $this->sendApplicationConfirmationEmail($candidat, $job);
        }

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
2. Highlight most relevant skills, projects, or experiences for this job (based on the CV above).
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

    private function sendApplicationConfirmationEmail(Candidat $candidat, Job $job): void
    {
        $subject = 'Your Application Has Been Submitted';
        $htmlContent = $this->renderView('emails/application_confirmation.html.twig', [
            'name' => $candidat->getName(),
            'jobTitle' => $job->getTitle(),
        ]);

        $client = HttpClient::create();

        $url = 'https://send.api.mailtrap.io/api/send';
        $apiToken = '34bac4712a0f73772374f6ac6ecb42d8';

        $payload = [
            'from' => [
                'email' => 'hello@demomailtrap.co',
                'name' => 'JobPlatform'
            ],
            'to' => [
                [
                    'email' => $candidat->getEmail(),
                    'name' => $candidat->getName()
                ]
            ],
            'subject' => $subject,
            'html' => $htmlContent,
            'category' => 'job-application'
        ];

        $headers = [
            'Authorization' => 'Bearer ' . $apiToken,
            'Content-Type' => 'application/json',
            'Accept' => 'application/json'
        ];

        $response = $client->request('POST', $url, [
            'headers' => $headers,
            'json' => $payload,
        ]);

        $statusCode = $response->getStatusCode();
        if ($statusCode < 200 || $statusCode >= 300) {
            throw new \Exception('Failed to send application confirmation email. Status: ' . $statusCode);
        }
    }
}