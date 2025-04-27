<?php

// src/Controller/AdminController.php
namespace App\Controller;

use App\Entity\Company;
use App\Entity\Employee;
use App\Entity\Candidat;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Annotation\Route;

class AdminController extends AbstractController
{
    private EntityManagerInterface $entityManager;
    private SessionInterface $session;

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

        $users     = $this->entityManager->getRepository(Candidat::class)->findAll();
        $companies = $this->entityManager->getRepository(Company::class)->findAll();

        return $this->render('admin/dashboard.html.twig', [
            'admin'     => [
                'name'  => $this->session->get('admin_name'),
                'email' => $this->session->get('admin_email'),
            ],
            'users'     => $users,
            'companies' => $companies,
        ]);
    }

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

        $employees = $this->entityManager
            ->getRepository(Employee::class)
            ->findBy(['companyId' => $company->getId()]);

        $employeesWithEmail = [];
        foreach ($employees as $employee) {
            $cand  = $this->entityManager->getRepository(Candidat::class)->find($employee->getUserId());
            $email = $cand ? $cand->getEmail() : 'Email inconnu';
            $employeesWithEmail[] = ['employee' => $employee, 'email' => $email];
        }

        return $this->render('admin/company_employees.html.twig', [
            'company'            => $company,
            'employeesWithEmail' => $employeesWithEmail,
            'admin'              => [
                'id'    => $this->session->get('admin_id'),
                'name'  => $this->session->get('admin_name'),
                'email' => $this->session->get('admin_email'),
            ],
        ]);
    }

    #[Route('/admin/user-statistics', name: 'admin_user_statistics', methods: ['GET'])]
    public function userStatistics(): Response
    {
        if (!$this->session->get('admin_id')) {
            return $this->redirectToRoute('admin_login');
        }

        $userCount = $this->entityManager->getRepository(Candidat::class)->count([]);
        $activeUserCount = $this->entityManager->getRepository(Candidat::class)
            ->createQueryBuilder('c')
            ->select('COUNT(c.id)')
            ->where('c.cv IS NOT NULL')
            ->andWhere("c.cv != ''")
            ->getQuery()
            ->getSingleScalarResult();

        $activeRatio = $userCount > 0
            ? round(($activeUserCount / $userCount) * 100)
            : 0;

        $recentActiveUsers = $this->entityManager->getRepository(Candidat::class)
            ->createQueryBuilder('c')
            ->where('c.cv IS NOT NULL')
            ->andWhere("c.cv != ''")
            ->orderBy('c.id', 'DESC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult();

        return $this->render('admin/user_statistics.html.twig', [
            'admin'           => [
                'id'    => $this->session->get('admin_id'),
                'name'  => $this->session->get('admin_name'),
                'email' => $this->session->get('admin_email'),
            ],
            'userCount'       => $userCount,
            'activeUserCount' => $activeUserCount,
            'activeRatio'     => $activeRatio,
            'recentActiveUsers' => $recentActiveUsers,
        ]);
    }

    #[Route('/admin/company-statistics', name: 'admin_company_statistics', methods: ['GET'])]
    public function companyStatistics(): Response
    {
        if (!$this->session->get('admin_id')) {
            return $this->redirectToRoute('admin_login');
        }
    
        // Fetch total number of companies
        $companyCount = $this->entityManager->getRepository(Company::class)->count([]);
    
        // Fetch total number of employees
        $employeeCount = $this->entityManager->getRepository(Employee::class)->count([]);
    
        // Get companies with employee counts (for chart)
        $companiesData = $this->entityManager->getRepository(Company::class)
            ->createQueryBuilder('c')
            ->select('c.id, c.companyName, COUNT(e.id) as employeeCount')
            ->leftJoin('App\Entity\Employee', 'e', 'WITH', 'e.companyId = c.id')
            ->groupBy('c.id')
            ->orderBy('employeeCount', 'DESC')
            ->getQuery()
            ->getResult();
    
        // Prepare data for charts
        $companyNames = [];
        $employeeCounts = [];
        foreach ($companiesData as $company) {
            $companyNames[] = $company['companyName'];
            $employeeCounts[] = $company['employeeCount'];
        }
    
        // Get recent companies created (last 10)
        $recentCompanies = $this->entityManager->getRepository(Company::class)
            ->createQueryBuilder('c')
            ->orderBy('c.id', 'DESC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult();
    
        return $this->render('admin/company_statistics.html.twig', [
            'admin' => [
                'id' => $this->session->get('admin_id'),
                'name' => $this->session->get('admin_name'),
                'email' => $this->session->get('admin_email')
            ],
            'companyCount' => $companyCount,
            'employeeCount' => $employeeCount,
            'companiesData' => $companiesData,
            'companyNames' => json_encode($companyNames),
            'employeeCounts' => json_encode($employeeCounts),
            'recentCompanies' => $recentCompanies
        ]);
    }
}
