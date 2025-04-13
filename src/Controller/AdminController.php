<?php

namespace App\Controller;
use App\Entity\Admin;
use App\Entity\Company;
use App\Entity\Candidat;
use App\Service\FileUploader;
use App\Service\HashService;
use App\Service\SessionManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;

final class AdminController extends AbstractController
{
    private $sessionManager;
    private $entityManager;
    private $hashService;

    public function __construct(SessionManager $sessionManager, EntityManagerInterface $entityManager, HashService $hashService)
    {
        $this->sessionManager = $sessionManager;
        $this->entityManager = $entityManager;
        $this->hashService = $hashService;
    }

    

    #[Route('/admin/login', name: 'admin_login', methods: ['GET', 'POST'])]
    public function login(Request $request): Response
    {
        if ($this->sessionManager->isLoggedIn() && $this->sessionManager->getUserType() === 'admin') {
            return $this->redirectToRoute('admin_dashboard');
        }
    
        $error = null;
        if ($request->isMethod('POST')) {
            $email = $request->request->get('email');
            $password = $request->request->get('password');
    
            $admin = $this->entityManager->getRepository(Admin::class)->findOneBy(['email' => $email]);
    
            if ($admin && $this->hashService->verifyPassword($password, $admin->getPassword())) {
                $this->sessionManager->loginAdmin($admin->getId());
    
                // Retourne une réponse avec un script qui stocke l'ID avant redirection
                return new Response(
                    <<<HTML
                    <script>
                        sessionStorage.setItem('adminId', '{$admin->getId()}');
                        window.location.href = '{$this->generateUrl('admin_dashboard')}';
                    </script>
                    HTML
                );
            }
    
            $error = 'Identifiants incorrects';
        }
    
        return $this->render('admin/login.html.twig', [
            'error' => $error,
            'last_username' => $request->request->get('email', '')
        ]);
    }

    #[Route('/admin/dashboard', name: 'admin_dashboard')]
public function dashboard(EntityManagerInterface $em): Response
{
    if (!$this->sessionManager->isLoggedIn() || $this->sessionManager->getUserType() !== 'admin') {
        return $this->redirectToRoute('admin_login');
    }

    // Récupérer les statistiques
    $userCount = $em->getRepository(Candidat::class)->count([]);
    $companyCount = $em->getRepository(Company::class)->count([]);
    
    

    // Activités récentes (exemple simplifié)
    $recentActivities = [
        ['description' => 'Nouvelle inscription candidat', 'date' => new \DateTime('-1 hour')],
        ['description' => 'Entreprise en attente de validation', 'date' => new \DateTime('-3 hours')],
    ];

    return $this->render('admin/dashboard.html.twig', [
        'user_count' => $userCount,
        'company_count' => $companyCount,
        'recent_activities' => $recentActivities,
    ]);
}

    #[Route('/admin/profile', name: 'admin_profile')]
    public function profile(): Response
    {
        if (!$this->sessionManager->isLoggedIn() || $this->sessionManager->getUserType() !== 'admin') {
            return $this->redirectToRoute('admin_login');
        }

        $admin = $this->sessionManager->getCurrentUser();

        return $this->render('admin/profile.html.twig', [
            'admin' => $admin,
        ]);
    }

    #[Route('/admin/profile/edit', name: 'admin_profile_edit')]
    public function editProfile(Request $request, FileUploader $fileUploader): Response
    {
        if (!$this->sessionManager->isLoggedIn() || $this->sessionManager->getUserType() !== 'admin') {
            return $this->redirectToRoute('admin_login');
        }

        $admin = $this->sessionManager->getCurrentUser();

        if ($request->isMethod('POST')) {
            $admin->setName($request->request->get('name'));
            $admin->setEmail($request->request->get('email'));

            $imageFile = $request->files->get('image');
            if ($imageFile) {
                $imageFileName = $fileUploader->upload($imageFile);
                $admin->setImage($imageFileName);
            }

            $this->entityManager->flush();

            $this->addFlash('success', 'Profile updated successfully');
            return $this->redirectToRoute('admin_profile');
        }

        return $this->render('admin/edit_profile.html.twig', [
            'admin' => $admin,
        ]);
    }

    #[Route('/admin/profile/delete-image', name: 'admin_profile_delete_image', methods: ['POST'])]
    public function deleteImage(): Response
    {
        if (!$this->sessionManager->isLoggedIn() || $this->sessionManager->getUserType() !== 'admin') {
            return $this->redirectToRoute('admin_login');
        }

        $admin = $this->sessionManager->getCurrentUser();
        
        if ($admin->getImage()) {
            $imagePath = $this->getParameter('admin_image_directory').'/'.$admin->getImage();
            if (file_exists($imagePath)) {
                unlink($imagePath);
            }
            $admin->setImage(null);
            $this->entityManager->flush();
        }

        $this->addFlash('success', 'Image deleted successfully');
        return $this->redirectToRoute('admin_profile');
    }

    #[Route('/admin/logout', name: 'admin_logout')]
    public function logout(): Response
    {
        $this->sessionManager->logout();
        return $this->redirectToRoute('home');
    }
}
