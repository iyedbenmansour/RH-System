<?php

namespace App\Controller;

use App\Service\CvKeywordExtractor;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class BestMatchController extends AbstractController
{
    #[Route('/best-match', name: 'best_match')]
    public function bestMatch(
        Request $request, 
        EntityManagerInterface $em, 
        CvKeywordExtractor $keywordExtractor
    ): Response {
        $jobs = null;
        $error = null;
        $count = 0;

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

        return $this->render('best_match/index.html.twig', [
            'jobs' => $jobs,
            'error' => $error,
            'count' => $count,
        ]);
    }
}