<?php

namespace App\Controller;

use App\Entity\Candidat;
use App\Entity\Employee;
use App\Service\FileUploader;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Validator\Validator\ValidatorInterface;
use Symfony\Component\HttpFoundation\File\UploadedFile;

class CandidatController extends AbstractController
{
    private $entityManager;
    private $session;
    private $brevoApiKey;

    public function __construct(EntityManagerInterface $entityManager, SessionInterface $session)
    {
        $this->entityManager = $entityManager;
        $this->session = $session;
        $this->brevoApiKey = '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';
    }

    #[Route('/candidat/register', name: 'candidat_register')]
    public function register(Request $request, ValidatorInterface $validator, FileUploader $fileUploader): Response
    {
        if ($request->isMethod('POST')) {
            try {
                $email = $request->request->get('email');

                // Vérification de l'existence de l'email
                if ($this->entityManager->getRepository(Candidat::class)->findOneBy(['email' => $email])) {
                    $this->addFlash('error', 'Un compte existe déjà avec cette adresse email.');
                    return $this->redirectToRoute('candidat_register');
                }

                $candidat = new Candidat();
                $candidat->setName($request->request->get('name'));
                $candidat->setEmail($email);
                $candidat->setPassword($request->request->get('password'));

                /** @var UploadedFile $cvFile */
                $cvFile = $request->files->get('cv');
                if ($cvFile) {
                    $fileName = $fileUploader->upload($cvFile);
                    $candidat->setCv($fileName);
                }

                $errors = $validator->validate($candidat);
                if (count($errors) > 0) {
                    foreach ($errors as $error) {
                        $this->addFlash('error', $error->getMessage());
                    }
                } else {
                    $this->entityManager->persist($candidat);
                    $this->entityManager->flush();

                    $this->sendWelcomeEmail($candidat);

                    $this->addFlash('success', 'Inscription réussie. Un email de confirmation vous a été envoyé.');
                    return $this->redirectToRoute('candidat_login');
                }
            } catch (\Exception $e) {
                $this->addFlash('error', 'Une erreur est survenue lors de l\'inscription : '.$e->getMessage());
            }
        }

        return $this->render('candidat/register.html.twig');
    }

    private function sendWelcomeEmail(Candidat $candidat): void
    {
        $data = [
            'sender' => [
                'name' => 'JobPlatform',
                'email' => 'no-reply@jobplatform.com'
            ],
            'to' => [[
                'email' => $candidat->getEmail(),
                'name' => $candidat->getName()
            ]],
            'subject' => 'Bienvenue sur JobPlatform',
            'htmlContent' => $this->renderView('emails/welcome_candidat.html.twig', [
                'name' => $candidat->getName()
            ]),
            'tags' => ['welcome-email']
        ];

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, 'https://api.brevo.com/v3/smtp/email');
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            'api-key: ' . $this->brevoApiKey,
            'Content-Type: application/json'
        ]);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));

        $response = curl_exec($ch);
        $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);

        if (curl_errno($ch) || $httpCode >= 400) {
            error_log("Erreur envoi Brevo: " . curl_error($ch) . " | Réponse: " . $response);
        }

        curl_close($ch);
    }

  

    #[Route('/candidat/dashboard', name: 'candidat_dashboard')]
    public function dashboard(): Response
    {
        if (!$this->session->get('candidat_id')) {
            return $this->redirectToRoute('candidat_login');
        }

        $candidat = $this->entityManager->getRepository(Candidat::class)->find($this->session->get('candidat_id'));

        return $this->render('candidat/dashboard.html.twig', [
            'candidat_name' => $this->session->get('candidat_name'),
            'candidat' => $candidat
        ]);
    }

    #[Route('/candidat/logout', name: 'candidat_logout')]
    public function logout(): Response
    {
        $this->session->remove('candidat_id');
        $this->session->remove('candidat_name');

        $response = $this->redirectToRoute('home');
        $content = $response->getContent();
        $script = "
            <script>
                localStorage.removeItem('candidat_id');
                localStorage.removeItem('candidat_name');
                localStorage.removeItem('employee_id');
            </script>
        ";

        return new Response($content.$script);
    }
}