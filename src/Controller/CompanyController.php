<?php

namespace App\Controller;

use App\Entity\Company;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class CompanyController extends AbstractController
{
    private $entityManager;
    private $session;

    public function __construct(EntityManagerInterface $entityManager, SessionInterface $session)
    {
        $this->entityManager = $entityManager;
        $this->session = $session;
    }

    #[Route('/company/register', name: 'company_register')]
    public function register(
        Request $request,
        ValidatorInterface $validator
    ): Response {
        if ($request->isMethod('POST')) {
            $company = new Company();
            $company->setCompanyName($request->request->get('company_name'));
            $company->setLocation($request->request->get('location'));
            $company->setSecteur($request->request->get('secteur'));
            $company->setEmail($request->request->get('email'));
            $company->setPassword($request->request->get('password')); // Stockage direct sans hash

            // Validation des données
            $errors = $validator->validate($company);
            
            if (count($errors) === 0) {
                // Vérification si l'email existe déjà
                $existingCompany = $this->entityManager->getRepository(Company::class)
                    ->findOneBy(['email' => $company->getEmail()]);
                
                if ($existingCompany) {
                    $this->addFlash('error', 'Cet email est déjà utilisé');
                } else {
                    $this->entityManager->persist($company);
                    $this->entityManager->flush();
                    $this->addFlash('success', 'Inscription réussie. Connectez-vous maintenant.');
                    return $this->redirectToRoute('company_login');
                }
            } else {
                foreach ($errors as $error) {
                    $this->addFlash('error', $error->getMessage());
                }
            }
        }

        return $this->render('company/register.html.twig');
    }

    #[Route('/company/login', name: 'company_login')]
    public function login(Request $request): Response
    {
        $loginAttempts = $this->session->get('company_login_attempts', 0);
        if ($loginAttempts > 3) {
            $this->addFlash('error', 'Trop de tentatives. Réessayez plus tard.');
            return $this->redirectToRoute('home');
        }
    
        if ($request->isMethod('POST')) {
            $email = $request->request->get('email');
            $password = $request->request->get('password');
    
            $company = $this->entityManager->getRepository(Company::class)->findOneBy([
                'email' => $email,
                'password' => $password
            ]);
    
            if ($company) {
                $this->session->set('company_login_attempts', 0);
                $this->session->set('company_id', $company->getId());
                $this->session->set('company_name', $company->getCompanyName());
                $this->session->set('company_email', $company->getEmail());
                
                // Créer une réponse avec un script pour stocker dans localStorage
                $response = $this->redirectToRoute('company_dashboard');
                $content = $response->getContent();
                $script = "
                    <script>
                        localStorage.setItem('company_id', '{$company->getId()}');
                        localStorage.setItem('company_name', '{$company->getCompanyName()}');
                    </script>
                ";
                
                return new Response($content.$script);
            } else {
                $this->session->set('company_login_attempts', $loginAttempts + 1);
                $this->addFlash('error', 'Email ou mot de passe incorrect');
            }
        }
    
        return $this->render('company/login.html.twig');
    }

    #[Route('/company/dashboard', name: 'company_dashboard')]
    public function dashboard(): Response
    {
        // Vérification de l'authentification
        if (!$this->session->get('company_id')) {
            $this->addFlash('warning', 'Vous devez vous connecter');
            return $this->redirectToRoute('company_login');
        }

        // Récupération des données de l'entreprise
        $companyData = [
            'id' => $this->session->get('company_id'),
            'name' => $this->session->get('company_name'),
            'email' => $this->session->get('company_email')
        ];

        return $this->render('company/dashboard.html.twig', [
            'company' => $companyData
        ]);
    }

    #[Route('/company/logout', name: 'company_logout')]
public function logout(): Response
{
    // Nettoyage côté serveur
    $this->session->invalidate();
    
    // Créer une réponse avec script de nettoyage localStorage
    $response = $this->redirectToRoute('home');
    $content = $response->getContent();
    $script = "
        <script>
            localStorage.removeItem('company_id');
            localStorage.removeItem('company_name');
        </script>
    ";
    
    return new Response($content.$script);
}
}