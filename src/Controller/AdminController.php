<?php

namespace App\Controller;
use App\Entity\Company;
use App\Entity\Employee;
use App\Entity\Admin;
use App\Entity\Candidat;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class AdminController extends AbstractController
{
    private $entityManager;
    private $session;

    public function __construct(EntityManagerInterface $entityManager, SessionInterface $session)
    {
        $this->entityManager = $entityManager;
        $this->session = $session;
    }

  

#[Route('/admin/dashboard', name: 'admin_dashboard', methods: ['GET'])]
public function dashboard(): Response
{
    if (!$this->session->get('admin_id')) {
        return $this->redirectToRoute('admin_login');
    }

    // Récupération des données
    $users = $this->entityManager->getRepository(Candidat::class)->findAll();
    $companies = $this->entityManager->getRepository(Company::class)->findAll();

    return $this->render('admin/dashboard.html.twig', [
        'admin' => [
            'name' => $this->session->get('admin_name'),
            'email' => $this->session->get('admin_email')
        ],
        'users' => $users,
        'companies' => $companies
    ]);
}
// src/Controller/AdminController.php

#[Route('/admin/company/{id}/employees', name: 'admin_company_employees')]
public function companyEmployees(int $id): Response
{
    if (!$this->session->get('admin_id')) {
        return $this->redirectToRoute('admin_login');
    }

    $company = $this->entityManager->getRepository(Company::class)->find($id);
    
    if (!$company) {
        throw $this->createNotFoundException('Entreprise non trouvée');
    }

    $employees = $this->entityManager->getRepository(Employee::class)->findBy(['company' => $company]);

    return $this->render('admin/company_employees.html.twig', [
        'company' => $company,
        'employees' => $employees,
        'admin' => [
            'id' => $this->session->get('admin_id'),
            'name' => $this->session->get('admin_name'),
            'email' => $this->session->get('admin_email')
        ]
    ]);
}
    

    #[Route('/admin/logout', name: 'admin_logout', methods: ['GET'])]
public function logout(): Response
{
    // Nettoyage session serveur
    $this->session->invalidate();
    
    // Redirection avec script de nettoyage localStorage
    $response = $this->redirectToRoute('home');
    $content = $response->getContent();
    $script = "
        <script>
            localStorage.removeItem('admin_id');
            localStorage.removeItem('admin_name');
            localStorage.removeItem('admin_email');
        </script>
    ";
    
    return new Response($content.$script);
}
}