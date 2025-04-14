<?php

namespace App\Controller;
use App\Entity\Company;
use App\Service\CompanyFileUploader;
use App\Service\HashService;
use App\Service\SessionManager;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\HttpFoundation\Request;

final class CompanyController extends AbstractController
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

    #[Route('/company/register', name: 'company_register')]
    public function register(Request $request): Response
    {
        if ($this->sessionManager->isLoggedIn() && $this->sessionManager->getUserType() === 'company') {
            return $this->redirectToRoute('company_dashboard');
        }

        if ($request->isMethod('POST')) {
            $company = new Company();
            $company->setCompanyName($request->request->get('companyName'));
            $company->setLocation($request->request->get('location'));
            $company->setSecteur($request->request->get('secteur'));
            $company->setEmail($request->request->get('email'));
            $company->setPassword($this->hashService->hashPassword($request->request->get('password')));

            $this->entityManager->persist($company);
            $this->entityManager->flush();

            $this->addFlash('success', 'Registration successful. Please login.');
            return $this->redirectToRoute('company_login');
        }

        return $this->render('company/register.html.twig');
    }

    #[Route('/company/login', name: 'company_login')]
public function login(Request $request): Response
{
    if ($this->sessionManager->isLoggedIn() && $this->sessionManager->getUserType() === 'company') {
        return $this->redirectToRoute('company_dashboard');
    }

    if ($request->isMethod('POST')) {
        $email = $request->request->get('email');
        $password = $request->request->get('password');

        $company = $this->entityManager->getRepository(Company::class)->findOneBy(['email' => $email]);

        if ($company && $this->hashService->verifyPassword($password, $company->getPassword())) {
            $this->sessionManager->loginCompany($company->getId());

            // Retourne une réponse avec un script qui stocke l'ID avant redirection
            return new Response(
                <<<HTML
                <script>
                    sessionStorage.setItem('companyId', '{$company->getId()}');
                    window.location.href = '{$this->generateUrl('company_dashboard')}';
                </script>
                HTML
            );
        }

        $this->addFlash('error', 'Invalid credentials');
    }

    return $this->render('company/login.html.twig');
}
    #[Route('/company/dashboard', name: 'company_dashboard')]
public function dashboard(): Response
{
    if (!$this->sessionManager->isLoggedIn() || $this->sessionManager->getUserType() !== 'company') {
        return $this->redirectToRoute('company_login');
    }

    $company = $this->sessionManager->getCurrentUser();

    return $this->render('company/dashboard.html.twig', [
        'company' => $company
    ]);
}

    #[Route('/company/profile', name: 'company_profile')]
    public function profile(): Response
    {
        if (!$this->sessionManager->isLoggedIn() || $this->sessionManager->getUserType() !== 'company') {
            return $this->redirectToRoute('company_login');
        }

        $company = $this->sessionManager->getCurrentUser();

        return $this->render('company/profile.html.twig', [
            'company' => $company,
        ]);
    }

    #[Route('/company/profile/edit', name: 'company_profile_edit')]
public function editProfile(Request $request, CompanyFileUploader $fileUploader): Response
{
    if (!$this->sessionManager->isLoggedIn() || $this->sessionManager->getUserType() !== 'company') {
        return $this->redirectToRoute('company_login');
    }

    $company = $this->sessionManager->getCurrentUser();

    if ($request->isMethod('POST')) {
        $company->setCompanyName($request->request->get('companyName'));
        $company->setLocation($request->request->get('location'));
        $company->setSecteur($request->request->get('secteur'));
        $company->setEmail($request->request->get('email'));

        $imageFile = $request->files->get('image');
        if ($imageFile) {
            $imageFileName = $fileUploader->upload($imageFile);
            $company->setImage($imageFileName);
        }

        $this->entityManager->flush();

        $this->addFlash('success', 'Profile updated successfully');
        return $this->redirectToRoute('company_profile');
    }

    return $this->render('company/edit_profile.html.twig', [
        'company' => $company,
    ]);
}

    #[Route('/company/profile/delete-image', name: 'company_profile_delete_image', methods: ['POST'])]
    public function deleteImage(): Response
    {
        if (!$this->sessionManager->isLoggedIn() || $this->sessionManager->getUserType() !== 'company') {
            return $this->redirectToRoute('company_login');
        }

        $company = $this->sessionManager->getCurrentUser();
        
        if ($company->getImage()) {
            $imagePath = $this->getParameter('company_image_directory').'/'.$company->getImage();
            if (file_exists($imagePath)) {
                unlink($imagePath);
            }
            $company->setImage(null);
            $this->entityManager->flush();
        }

        $this->addFlash('success', 'Image deleted successfully');
        return $this->redirectToRoute('company_profile');
    }

    #[Route('/company/logout', name: 'company_logout')]
    public function logout(): Response
    {
        $this->sessionManager->logout();
        return $this->redirectToRoute('home');
    }
}
