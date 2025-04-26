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

   
    #[Route('/company/dashboard', name: 'company_dashboard')]
    public function dashboard(EntityManagerInterface $em): Response
    {
        // Check authentication
        $companyId = $this->session->get('company_id');
        if (!$companyId) {
            $this->addFlash('warning', 'Vous devez vous connecter');
            return $this->redirectToRoute('login_page'); // Redirect to general login page
        }
    
        // Fetch fresh company data from database instead of relying only on session
        $company = $em->getRepository(Company::class)->find($companyId);
        
        if (!$company) {
            $this->session->clear();
            $this->addFlash('error', 'Entreprise non trouvée');
            return $this->redirectToRoute('login_page');
        }
    
        // Prepare company data
        $companyData = [
            'id' => $company->getId(),
            'name' => $company->getCompanyName(),
            'email' => $company->getEmail(),
            // Add any other relevant company data you need
        ];
    
        // Update session data with fresh values
        $this->session->set('company_name', $company->getCompanyName());
        $this->session->set('company_email', $company->getEmail());
    
        return $this->render('company/dashboard.html.twig', [
            'company' => $companyData
        ]);
    }

  
}