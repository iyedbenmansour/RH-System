<?php

namespace App\Controller;

use App\Entity\Admin;
use App\Entity\Candidat;
use App\Entity\Company;
use App\Entity\Employee;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class LoginController extends AbstractController
{
    private $entityManager;
    private $session;

    public function __construct(EntityManagerInterface $entityManager, SessionInterface $session)
    {
        $this->entityManager = $entityManager;
        $this->session = $session;
    }

    #[Route('/login', name: 'login_page')]
    public function index(): Response
    {
        // Vérifie si l'utilisateur est déjà connecté et redirige si c'est le cas
        if ($this->session->get('candidat_id')) {
            return $this->redirectToRoute('candidat_dashboard');
        }
        if ($this->session->get('company_id')) {
            return $this->redirectToRoute('company_dashboard');
        }
        if ($this->session->get('admin_id')) {
            return $this->redirectToRoute('admin_dashboard');
        }

        return $this->render('login_all.html.twig');
    }

    #[Route('/login/candidat', name: 'candidat_login', methods: ['POST'])]
    public function candidatLogin(Request $request): Response
    {
        $email = $request->request->get('email');
        $password = $request->request->get('password');

        $candidat = $this->entityManager->getRepository(Candidat::class)->findOneBy(['email' => $email]);

        if ($candidat && $candidat->getPassword() === $password) {
            // Session serveur
            $this->session->set('candidat_id', $candidat->getId());
            $this->session->set('candidat_name', $candidat->getName());
            
            // Vérifier si l'utilisateur est aussi un employé
            $employee = $this->entityManager->getRepository(Employee::class)->findOneBy(['user' => $candidat]);
            $employeeId = $employee ? $employee->getId() : null;
            
            if ($employeeId) {
                $this->session->set('employee_id', $employeeId);
            }
            
            // Redirection avec script pour localStorage
            $response = $this->redirectToRoute('candidat_dashboard');
            $content = $response->getContent();
            $script = sprintf("
                <script>
                    localStorage.setItem('candidat_id', '%s');
                    localStorage.setItem('candidat_name', '%s');
                    %s
                </script>
            ", 
            $candidat->getId(), 
            addslashes($candidat->getName()),
            $employeeId ? "localStorage.setItem('employee_id', '{$employeeId}');" : ""
            );
            
            return new Response($content.$script);
        }

        $this->addFlash('error', 'Email ou mot de passe incorrect');
        return $this->redirectToRoute('login_page');
    }

    #[Route('/login/company', name: 'company_login', methods: ['POST'])]
    public function companyLogin(Request $request): Response
    {
        $email = $request->request->get('email');
        $password = $request->request->get('password');

        $company = $this->entityManager->getRepository(Company::class)->findOneBy([
            'email' => $email,
            'password' => $password
        ]);

        if ($company) {
            $this->session->set('company_id', $company->getId());
            $this->session->set('company_name', $company->getCompanyName());
            $this->session->set('company_email', $company->getEmail());
            
            // Créer une réponse avec un script pour stocker dans localStorage
            $response = $this->redirectToRoute('company_dashboard');
            $content = $response->getContent();
            $script = sprintf("
                <script>
                    localStorage.setItem('company_id', '%s');
                    localStorage.setItem('company_name', '%s');
                    localStorage.setItem('company_email', '%s');
                </script>
            ",
            $company->getId(),
            addslashes($company->getCompanyName()),
            addslashes($company->getEmail())
            );
            
            return new Response($content.$script);
        }

        $this->addFlash('error', 'Email ou mot de passe incorrect');
        return $this->redirectToRoute('login_page');
    }

    #[Route('/login/admin', name: 'admin_login', methods: ['POST'])]
    public function adminLogin(Request $request): Response
    {
        $email = $request->request->get('email');
        $password = $request->request->get('password');

        $admin = $this->entityManager->getRepository(Admin::class)->findOneBy([
            'email' => $email,
            'password' => $password
        ]);

        if ($admin) {
            // Session serveur
            $this->session->set('admin_id', $admin->getId());
            $this->session->set('admin_name', $admin->getName());
            $this->session->set('admin_email', $admin->getEmail());
            
            // Redirection avec script pour localStorage
            $response = $this->redirectToRoute('admin_dashboard');
            $content = $response->getContent();
            $script = sprintf("
                <script>
                    localStorage.setItem('admin_id', '%s');
                    localStorage.setItem('admin_name', '%s');
                    localStorage.setItem('admin_email', '%s');
                </script>
            ",
            $admin->getId(),
            addslashes($admin->getName()),
            addslashes($admin->getEmail())
            );
            
            return new Response($content.$script);
        }

        $this->addFlash('error', 'Email ou mot de passe incorrect');
        return $this->redirectToRoute('login_page');
    }

    #[Route('/logout', name: 'logout')]
    public function logout(): Response
    {
        // Suppression des données de session
        $this->session->clear();

        // Redirection avec script pour supprimer le localStorage
        $response = $this->redirectToRoute('home');
        $content = $response->getContent();
        $script = "
            <script>
                localStorage.removeItem('candidat_id');
                localStorage.removeItem('candidat_name');
                localStorage.removeItem('employee_id');
                localStorage.removeItem('company_id');
                localStorage.removeItem('company_name');
                localStorage.removeItem('company_email');
                localStorage.removeItem('admin_id');
                localStorage.removeItem('admin_name');
                localStorage.removeItem('admin_email');
            </script>
        ";
        
        return new Response($content.$script);
    }
}