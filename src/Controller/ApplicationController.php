<?php

namespace App\Controller;

use App\Entity\Applicant;
use App\Entity\Job;
use App\Entity\Employee;
use App\Repository\EmployeeRepository;
use App\Repository\ApplicantRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ApplicationController extends AbstractController
{
    #[Route('/job/apply/{id}', name: 'app_job_apply')]
    public function apply(Request $request, Job $job, EntityManagerInterface $entityManager): Response
    {
        $applicant = new Applicant();
        $applicant->setJobId($job->getId());
        $applicant->setCompanyId($job->getCompanyId());

        if ($request->isMethod('POST')) {
            $applicant->setUserId((int)$request->request->get('user_id'));
            $applicant->setComment($request->request->get('comment'));
            $applicant->setAdditionalFile($request->request->get('additional_file'));
            
            $entityManager->persist($applicant);
            $entityManager->flush();

            $this->addFlash('success', 'Application submitted successfully!');
            return $this->redirectToRoute('app_job_show', ['id' => $job->getId()]);
        }

        return $this->render('application/apply.html.twig', [
            'job' => $job,
        ]);
    }

    #[Route('/my-applications/{user_id}', name: 'app_user_applications')]
    public function userApplications(int $user_id, ApplicantRepository $applicantRepository): Response
    {
        $applications = $applicantRepository->findBy(
            ['userId' => $user_id],
            ['appliedDate' => 'DESC']
        );

        return $this->render('application/user_applications.html.twig', [
            'applications' => $applications,
            'user_id' => $user_id,
        ]);
    }

    #[Route('/company-applications/{company_id}', name: 'app_company_applications')]
    public function companyApplications(int $company_id, ApplicantRepository $applicantRepository): Response
    {
        $applications = $applicantRepository->findBy(
            ['companyId' => $company_id],
            ['appliedDate' => 'DESC']
        );

        return $this->render('application/company_applications.html.twig', [
            'applications' => $applications,
            'company_id' => $company_id,
        ]);
    }

    #[Route('/application/update/{id}', name: 'app_update_application', methods: ['GET', 'POST'])]
    public function updateApplication(
        Request $request, 
        Applicant $applicant, 
        EntityManagerInterface $entityManager,
        EmployeeRepository $employeeRepository
    ): Response {
        // Store the old status before updating
        $oldStatus = $applicant->getStatus();
        
        // Handle POST requests for form submission
        if ($request->isMethod('POST')) {
            if ($request->request->has('comment')) {
                $applicant->setComment($request->request->get('comment'));
                $applicant->setAdditionalFile($request->request->get('additional_file'));
            } elseif ($request->request->has('status')) {
                $newStatus = $request->request->get('status');
                $applicant->setStatus($newStatus);
                
                // If status is changed to "Accepted", create a new employee
                if ($newStatus === 'Accepted' && $oldStatus !== 'Accepted') {
                    // Check if employee already exists to avoid duplicates
                    $existingEmployee = $employeeRepository->findOneBy([
                        'userId' => $applicant->getUserId(),
                        'companyId' => $applicant->getCompanyId(),
                        'jobId' => $applicant->getJobId()
                    ]);
                    
                    if (!$existingEmployee) {
                        $employee = new Employee();
                        $employee->setCompanyId($applicant->getCompanyId());
                        $employee->setUserId($applicant->getUserId());
                        $employee->setJobId($applicant->getJobId());
                        
                        $entityManager->persist($employee);
                        $this->addFlash('success', 'Applicant has been accepted and added as an employee!');
                    }
                }
            }
    
            $entityManager->flush();
            $this->addFlash('success', 'Application updated successfully!');
    
            return $request->request->has('comment') 
                ? $this->redirectToRoute('app_user_applications', ['user_id' => $applicant->getUserId()])
                : $this->redirectToRoute('app_company_applications', ['company_id' => $applicant->getCompanyId()]);
        }
    
        // Handle GET requests to display the edit form
        return $this->render('application/edit_application.html.twig', [
            'application' => $applicant
        ]);
    }
    #[Route('/application/delete/{id}', name: 'app_delete_application', methods: ['POST'])]
    public function deleteApplication(Request $request, Applicant $applicant, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$applicant->getId(), $request->request->get('_token'))) {
            $entityManager->remove($applicant);
            $entityManager->flush();
            $this->addFlash('success', 'Application deleted successfully!');
        }

        return $this->redirectToRoute('app_user_applications', ['user_id' => $applicant->getUserId()]);
    }
}