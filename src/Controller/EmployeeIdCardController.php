<?php
// src/Controller/EmployeeIdCardController.php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\Routing\Annotation\Route;
use Dompdf\Dompdf;
use Dompdf\Options;
use Picqer\Barcode\BarcodeGeneratorPNG;

class EmployeeIdCardController extends AbstractController
{
    #[Route('/employee/id-card', name: 'employee_id_card')]
    public function index(Request $request): Response
    {
        $formData = [
            'id' => '',
            'fullName' => '',
            'position' => '',
            'telephone' => '',
            'startDate' => (new \DateTime())->format('Y-m-d'),
            'endDate' => (new \DateTime('+1 year'))->format('Y-m-d'),
            'photoPath' => null,
        ];

        if ($request->isMethod('POST')) {
            $formData = $request->request->all();

            /** @var UploadedFile $photoFile */
            $photoFile = $request->files->get('photo');
            if ($photoFile) {
                $newFilename = uniqid().'.'.$photoFile->guessExtension();
                $photoFile->move(
                    $this->getParameter('kernel.project_dir').'/public/uploads/employee_photos',
                    $newFilename
                );
                $formData['photoPath'] = '/uploads/employee_photos/'.$newFilename;
            }

            // If generate PDF was clicked
            if ($request->request->has('generate_pdf')) {
                return $this->generatePdf($formData, $request);
            }
        }

        return $this->render('employee_id_card/index.html.twig', [
            'formData' => $formData,
        ]);
    }

    private function generatePdf(array $formData, Request $request): Response
    {
        // Configure Dompdf
        $pdfOptions = new Options();
        $pdfOptions->set('defaultFont', 'Arial');
        $pdfOptions->set('isRemoteEnabled', true);

        $dompdf = new Dompdf($pdfOptions);

        // Generate barcode (fallback is ASCII, not image)
        $barcodeImage = $this->generateBarcodeImage(
            ($formData['id'] ?? '0000') . '-' . substr($formData['fullName'] ?? 'DefaultName', 0, 5)
        );

        // Generate the HTML for the PDF
        $html = $this->renderView('employee_id_card/pdf_template.html.twig', [
            'formData' => $formData,
            'barcode_image' => $barcodeImage,
            'app' => [
                'request' => $request,
            ],
        ]);

        // Load HTML to Dompdf
        $dompdf->loadHtml($html);
        $dompdf->setPaper('A6', 'portrait');
        $dompdf->render();

        // Generate a unique filename
        $filename = 'employee_id_card_'.str_replace(' ', '_', $formData['fullName']).'.pdf';

        // Stream the PDF to browser
        return new Response(
            $dompdf->output(),
            Response::HTTP_OK,
            [
                'Content-Type' => 'application/pdf',
                'Content-Disposition' => 'attachment; filename="'.$filename.'"',
            ]
        );
    }

    /**
     * Generate a barcode as a base64 PNG (if possible), else ASCII fallback (as HTML).
     */
    private function generateBarcodeImage(string $data): string
    {
        try {
            if (class_exists(BarcodeGeneratorPNG::class)) {
                // Use Picqer/Barcode if installed
                $generator = new BarcodeGeneratorPNG();
                $barcodeImage = $generator->getBarcode($data, $generator::TYPE_CODE_128);
                return 'data:image/png;base64,' . base64_encode($barcodeImage);
            }
        } catch (\Exception $e) {
            // Fallback below
        }
        // Fallback: return ASCII barcode as HTML (not an image)
        return $this->generateAsciiBarcode($data);
    }

    /**
     * Generate a simple ASCII barcode as HTML.
     */
    private function generateAsciiBarcode(string $data): string
    {
        // Simple ASCII pattern: bars and spaces
        $pattern = '';
        $seed = crc32($data);
        mt_srand($seed);
        $length = 32;

        for ($i = 0; $i < $length; $i++) {
            $pattern .= (mt_rand(0, 100) > 50) ? '|' : '&nbsp;';
        }

        $barcodeHtml = '
            <div style="
                width: 200px; height: 60px; border: 1px solid #333; 
                font-family: monospace; font-size: 38px; text-align: center; 
                letter-spacing: 1px; background: #fff; line-height: 60px;
                margin: 0 auto;">
                '.$pattern.'
            </div>
            <div style="font-size:12px; color:#333; text-align:center;">'.$data.'</div>
        ';
        return $barcodeHtml;
    }
}