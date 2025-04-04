<?php

namespace App\Controller;
use App\Entity\Candidat;
use App\Service\CandidatFileUploader;
use App\Service\HashService;
use App\Service\SessionManager;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\HttpFoundation\Request;

final class CandidatController extends AbstractController
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

    #[Route('/candidat/register', name: 'candidat_register')]
    public function register(Request $request): Response
    {
        if ($this->sessionManager->isLoggedIn() && $this->sessionManager->getUserType() === 'candidat') {
            return $this->redirectToRoute('candidat_dashboard');
        }

        if ($request->isMethod('POST')) {
            $candidat = new Candidat();
            $candidat->setName($request->request->get('name'));
            $candidat->setEmail($request->request->get('email'));
            $candidat->setPassword($this->hashService->hashPassword($request->request->get('password')));

            $this->entityManager->persist($candidat);
            $this->entityManager->flush();

            $this->addFlash('success', 'Registration successful. Please login.');
            return $this->redirectToRoute('candidat_login');
        }

        return $this->render('candidat/register.html.twig');
    }

    #[Route('/candidat/login', name: 'candidat_login')]
    public function login(Request $request): Response
    {
        if ($this->sessionManager->isLoggedIn() && $this->sessionManager->getUserType() === 'candidat') {
            return $this->redirectToRoute('candidat_dashboard');
        }

        if ($request->isMethod('POST')) {
            $email = $request->request->get('email');
            $password = $request->request->get('password');

            $candidat = $this->entityManager->getRepository(Candidat::class)->findOneBy(['email' => $email]);

            if ($candidat && $this->hashService->verifyPassword($password, $candidat->getPassword())) {
                $this->sessionManager->loginCandidat($candidat->getId());
                return $this->redirectToRoute('candidat_dashboard');
            }

            $this->addFlash('error', 'Invalid credentials');
        }

        return $this->render('candidat/login.html.twig');
    }

    #[Route('/candidat/dashboard', name: 'candidat_dashboard')]
    public function dashboard(): Response
    {
        if (!$this->sessionManager->isLoggedIn() || $this->sessionManager->getUserType() !== 'candidat') {
            return $this->redirectToRoute('candidat_login');
        }
    
        // Récupérer l'utilisateur connecté
        $candidat = $this->sessionManager->getCurrentUser();
    
        return $this->render('candidat/dashboard.html.twig', [
            'candidat' => $candidat
        ]);
    }

    #[Route('/candidat/profile', name: 'candidat_profile')]
    public function profile(): Response
    {
        if (!$this->sessionManager->isLoggedIn() || $this->sessionManager->getUserType() !== 'candidat') {
            return $this->redirectToRoute('candidat_login');
        }

        $candidat = $this->sessionManager->getCurrentUser();

        return $this->render('candidat/profile.html.twig', [
            'candidat' => $candidat,
        ]);
    }

    #[Route('/candidat/profile/edit', name: 'candidat_profile_edit')]
    public function editProfile(Request $request, CandidatFileUploader $fileUploader): Response
    {
        if (!$this->sessionManager->isLoggedIn() || $this->sessionManager->getUserType() !== 'candidat') {
            return $this->redirectToRoute('candidat_login');
        }

        $candidat = $this->sessionManager->getCurrentUser();

        if ($request->isMethod('POST')) {
            $candidat->setName($request->request->get('name'));
            $candidat->setEmail($request->request->get('email'));

            $imageFile = $request->files->get('image');
            if ($imageFile) {
                $imageFileName = $fileUploader->upload($imageFile);
                $candidat->setImage($imageFileName);
            }

            $this->entityManager->flush();

            $this->addFlash('success', 'Profile updated successfully');
            return $this->redirectToRoute('candidat_profile');
        }

        return $this->render('candidat/edit_profile.html.twig', [
            'candidat' => $candidat,
        ]);
    }

    #[Route('/candidat/profile/delete-image', name: 'candidat_profile_delete_image', methods: ['POST'])]
    public function deleteImage(): Response
    {
        if (!$this->sessionManager->isLoggedIn() || $this->sessionManager->getUserType() !== 'candidat') {
            return $this->redirectToRoute('candidat_login');
        }

        $candidat = $this->sessionManager->getCurrentUser();
        
        if ($candidat->getImage()) {
            $imagePath = $this->getParameter('candidat_image_directory').'/'.$candidat->getImage();
            if (file_exists($imagePath)) {
                unlink($imagePath);
            }
            $candidat->setImage(null);
            $this->entityManager->flush();
        }

        $this->addFlash('success', 'Image deleted successfully');
        return $this->redirectToRoute('candidat_profile');
    }

    #[Route('/candidat/logout', name: 'candidat_logout')]
    public function logout(): Response
    {
        $this->sessionManager->logout();
        return $this->redirectToRoute('home');
    }
}
