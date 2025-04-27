<?php

namespace App\Controller;

use App\Service\StatisticsService;
use Dompdf\Dompdf;
use Dompdf\Options;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class StatisticsController extends AbstractController
{
    private $statisticsService;
    private $validator;

    public function __construct(
        StatisticsService $statisticsService,
        ValidatorInterface $validator
    ) {
        $this->statisticsService = $statisticsService;
        $this->validator = $validator;
    }

    #[Route('/company/statistics', name: 'company_statistics')]
    public function index(Request $request): Response
    {
        $companyId = $request->query->get('company_id');

        if ($companyId !== null) {
            $errors = $this->validateCompanyId($companyId);
            if (count($errors) > 0) {
                throw new BadRequestHttpException((string) $errors);
            }

            $stats = $this->statisticsService->getCompanyStatistics((int) $companyId);

            return $this->render('statistics/index.html.twig', [
                'stats' => $stats,
                'company_id' => $companyId,
            ]);
        }

        return $this->render('statistics/index.html.twig');
    }

    #[Route('/company/job-statistics/{id}', name: 'job_statistics')]
    public function jobStatistics(int $id): Response
    {
        $stats = $this->statisticsService->getJobStatistics($id);

        if (!$stats) {
            throw $this->createNotFoundException('Job statistics not found');
        }

        return $this->render('statistics/job.html.twig', [
            'stats' => $stats,
        ]);
    }

    #[Route('/company/statistics/pdf', name: 'company_statistics_pdf')]
    public function generatePdf(Request $request): Response
    {
        $companyId = $request->query->get('company_id');

        if (!$companyId) {
            throw $this->createNotFoundException('Company ID is missing.');
        }

        $errors = $this->validateCompanyId($companyId);
        if (count($errors) > 0) {
            throw new BadRequestHttpException((string) $errors);
        }

        $stats = $this->statisticsService->getCompanyStatistics((int) $companyId);

        // Render the HTML view first
        $html = $this->renderView('statistics/pdf.html.twig', [
            'stats' => $stats,
            'company_id' => $companyId,
        ]);

        // Setup Dompdf options
        $options = new Options();
        $options->set('defaultFont', 'Arial');
        $options->setIsRemoteEnabled(true); // allow loading CSS/Images if needed

        // Instantiate Dompdf
        $dompdf = new Dompdf($options);
        $dompdf->loadHtml($html);
        $dompdf->setPaper('A4', 'landscape');
        $dompdf->render();

        // Output the PDF
        return new Response(
            $dompdf->output(),
            Response::HTTP_OK,
            [
                'Content-Type' => 'application/pdf',
                'Content-Disposition' => 'attachment; filename="company_statistics_'.$companyId.'.pdf"',
            ]
        );
    }

    private function validateCompanyId($companyId): \Symfony\Component\Validator\ConstraintViolationListInterface
    {
        $constraints = new Assert\Collection([
            'company_id' => [
                new Assert\NotBlank(),
                new Assert\Type(['type' => 'numeric']),
                new Assert\Positive(),
            ],
        ]);

        return $this->validator->validate(['company_id' => $companyId], $constraints);
    }
}
