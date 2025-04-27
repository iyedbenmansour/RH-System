<?php

namespace App\Controller;

use App\Entity\Candidat;
use App\Entity\Employee;
use App\Service\FileUploader;
use App\Service\MailerService;
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
    private $mailerService;

    public function __construct(
        EntityManagerInterface $entityManager, 
        SessionInterface $session,
        MailerService $mailerService
    ) {
        $this->entityManager = $entityManager;
        $this->session = $session;
        $this->brevoApiKey = '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';
        $this->mailerService = $mailerService;
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

    // src/Controller/CandidatController.php
    #[Route('/candidat/edit-profile', name: 'candidat_edit_profile')]
    public function editProfile(Request $request, FileUploader $fileUploader): Response
    {
        if (!$this->session->get('candidat_id')) {
            return $this->redirectToRoute('candidat_login');
        }
    
        $candidat = $this->entityManager->getRepository(Candidat::class)->find($this->session->get('candidat_id'));
    
        if ($request->isMethod('POST')) {
            try {
                $candidat->setName($request->request->get('name'));
                $candidat->setEmail($request->request->get('email'));
    
                // Handle password change if provided
                $newPassword = $request->request->get('new_password');
                $confirmPassword = $request->request->get('confirm_password');
                
                if ($newPassword) {
                    if ($newPassword === $confirmPassword) {
                        $candidat->setPassword($newPassword);
                    } else {
                        $this->addFlash('error', 'Les mots de passe ne correspondent pas.');
                        return $this->render('candidat/edit_profile.html.twig', [
                            'candidat' => $candidat
                        ]);
                    }
                }
    
                /** @var UploadedFile $cvFile */
                $cvFile = $request->files->get('cv');
                if ($cvFile) {
                    $fileName = $fileUploader->upload($cvFile);
                    $candidat->setCv($fileName);
                }
    
                $this->entityManager->flush();
    
                // Update session data if name changed
                if ($candidat->getName() !== $this->session->get('candidat_name')) {
                    $this->session->set('candidat_name', $candidat->getName());
                }
    
                $this->addFlash('success', 'Profil mis à jour avec succès.');
                return $this->redirectToRoute('candidat_dashboard');
            } catch (\Exception $e) {
                $this->addFlash('error', 'Une erreur est survenue lors de la mise à jour : '.$e->getMessage());
            }
        }
    
        return $this->render('candidat/edit_profile.html.twig', [
            'candidat' => $candidat
        ]);
    }

    #[Route('/candidat/delete-cv', name: 'candidat_delete_cv')]
public function deleteCv(): Response
{
    if (!$this->session->get('candidat_id')) {
        return $this->redirectToRoute('candidat_login');
    }

    $candidat = $this->entityManager->getRepository(Candidat::class)->find($this->session->get('candidat_id'));
    
    if (!$candidat) {
        $this->addFlash('error', 'Candidat non trouvé.');
        return $this->redirectToRoute('candidat_dashboard');
    }
    
    try {
        // Remove file if it exists
        $cvPath = $this->getParameter('cv_directory') . '/' . $candidat->getCv();
        if (file_exists($cvPath)) {
            unlink($cvPath);
        }
        
        // Update database
        $candidat->setCv(null);
        $this->entityManager->flush();
        
        $this->addFlash('success', 'CV supprimé avec succès.');
    } catch (\Exception $e) {
        $this->addFlash('error', 'Erreur lors de la suppression du CV: ' . $e->getMessage());
    }
    
    return $this->redirectToRoute('candidat_edit_profile');
}
#[Route('/candidat/forgot-password', name: 'candidat_forgot_password')]
public function forgotPassword(Request $request): Response
{
    if ($request->isMethod('POST')) {
        $email = $request->request->get('email');
        $candidat = $this->entityManager->getRepository(Candidat::class)->findOneBy(['email' => $email]);

        if ($candidat) {
            $token = bin2hex(random_bytes(16));
            
            $this->session->set('password_reset_token', $token);
            $this->session->set('password_reset_email', $email);
            $this->session->set('password_reset_expires', time() + 3600);

            $resetUrl = $this->generateUrl('candidat_reset_password', ['token' => $token], true);
            
            try {
                $this->mailerService->sendPasswordResetEmail(
                    $candidat->getEmail(),
                    $candidat->getName(),
                    $resetUrl
                );
                
                $this->addFlash('success', 'Un email de réinitialisation a été envoyé. Veuillez vérifier votre boîte de réception (y compris les spams).');
            } catch (\Exception $e) {
                $this->addFlash('error', 'Une erreur est survenue lors de l\'envoi de l\'email: '.$e->getMessage());
            }
        } else {
            $this->addFlash('error', 'Aucun compte trouvé avec cette adresse email.');
        }
    }

    return $this->render('candidat/forgot_password.html.twig');
}

#[Route('/candidat/reset-password/{token}', name: 'candidat_reset_password')]
public function resetPassword(Request $request, string $token): Response
{
    $storedToken = $this->session->get('password_reset_token');
    $storedEmail = $this->session->get('password_reset_email');
    $expires = $this->session->get('password_reset_expires');

    if (!$storedToken || $storedToken !== $token || time() > $expires) {
        $this->addFlash('error', 'Le lien de réinitialisation est invalide ou a expiré.');
        return $this->redirectToRoute('candidat_forgot_password');
    }

    $candidat = $this->entityManager->getRepository(Candidat::class)->findOneBy(['email' => $storedEmail]);
    
    if (!$candidat) {
        $this->addFlash('error', 'Aucun compte trouvé avec cette adresse email.');
        return $this->redirectToRoute('candidat_forgot_password');
    }

    if ($request->isMethod('POST')) {
        $newPassword = $request->request->get('new_password');
        $confirmPassword = $request->request->get('confirm_password');

        if ($newPassword !== $confirmPassword) {
            $this->addFlash('error', 'Les mots de passe ne correspondent pas.');
        } else {
            $candidat->setPassword($newPassword);
            $this->entityManager->flush();

            $this->session->remove('password_reset_token');
            $this->session->remove('password_reset_email');
            $this->session->remove('password_reset_expires');

            $this->addFlash('success', 'Votre mot de passe a été réinitialisé avec succès. Vous pouvez maintenant vous connecter.');
            return $this->redirectToRoute('candidat_login');
        }
    }

    return $this->render('candidat/reset_password.html.twig', [
        'token' => $token
    ]);
}
}