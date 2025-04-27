<?php

namespace App\Controller;

use App\Entity\Applicant;
use App\Entity\Job;
use App\Entity\Employee;
use App\Entity\Candidat;
use App\Repository\EmployeeRepository;
use App\Repository\ApplicantRepository;
use App\Repository\CandidatRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Service\MailerService;
use Symfony\Component\HttpClient\HttpClient; // Add this import


class ApplicationController extends AbstractController
{
    private $mailerService;

    public function __construct(MailerService $mailerService)
    {
        $this->mailerService = $mailerService;
    }

    #[Route('/job/apply/{id}', name: 'app_job_apply')]
    public function apply(
        Request $request, 
        Job $job, 
        EntityManagerInterface $entityManager,
        CandidatRepository $candidatRepository
    ): Response {
        $applicant = new Applicant();
        $applicant->setJobId($job->getId());
        $applicant->setCompanyId($job->getCompanyId());

        if ($request->isMethod('POST')) {
            $userId = (int)$request->request->get('user_id');
            $applicant->setUserId($userId);
            $applicant->setComment($request->request->get('comment'));
            $applicant->setAdditionalFile($request->request->get('additional_file'));

            $entityManager->persist($applicant);
            $entityManager->flush();

            // Send confirmation email to the applicant
            $candidat = $candidatRepository->find($userId);
            if ($candidat) {
                $this->sendApplicationConfirmationEmail($candidat, $job);
            }

            $this->addFlash('success', 'Application submitted successfully!');
            return $this->redirectToRoute('app_job_show', ['id' => $job->getId()]);
        }

        return $this->render('application/apply.html.twig', [
            'job' => $job,
        ]);
    }

    private function sendApplicationConfirmationEmail(Candidat $candidat, Job $job): void
    {
        $subject = 'Your Application Has Been Submitted';
        $htmlContent = $this->renderView('emails/application_confirmation.html.twig', [
            'name' => $candidat->getName(),
            'jobTitle' => $job->getTitle(),
        ]);

        // Create client only if not already created
        $client = HttpClient::create();

        $url = 'https://send.api.mailtrap.io/api/send';
        $apiToken = '34bac4712a0f73772374f6ac6ecb42d8';

        $payload = [
            'from' => [
                'email' => 'hello@demomailtrap.co',
                'name' => 'JobPlatform'
            ],
            'to' => [
                [
                    'email' => $candidat->getEmail(),
                    'name' => $candidat->getName()
                ]
            ],
            'subject' => $subject,
            'html' => $htmlContent,
            'category' => 'job-application'
        ];

        $headers = [
            'Authorization' => 'Bearer ' . $apiToken,
            'Content-Type' => 'application/json',
            'Accept' => 'application/json'
        ];

        $response = $client->request('POST', $url, [
            'headers' => $headers,
            'json' => $payload,
        ]);

        $statusCode = $response->getStatusCode();
        if ($statusCode < 200 || $statusCode >= 300) {
            throw new \Exception('Failed to send application confirmation email. Status: ' . $statusCode);
        }
    }

    #[Route('/my-applications', name: 'app_user_applications', methods: ['GET'])]
    public function userApplications(Request $request, ApplicantRepository $applicantRepository): Response
    {
        $userId = $request->query->get('user_id');
        $applications = [];
    
        if ($userId) {
            $applications = $applicantRepository->findBy(
                ['userId' => $userId],
                ['appliedDate' => 'DESC']
            );
        }
    
        return $this->render('application/user_applications.html.twig', [
            'user_id' => $userId,
            'applications' => $applications,
        ]);
    }

    #[Route('/company-applications', name: 'company_applications', methods: ['GET'])]
    public function companyApplications(Request $request, ApplicantRepository $applicantRepository): Response
    {
        $companyId = $request->query->get('company_id');
        $applications = [];

        if ($companyId) {
            $applications = $applicantRepository->findBy(
                ['companyId' => $companyId],
                ['appliedDate' => 'DESC']
            );
        }

        return $this->render('application/company_applications.html.twig', [
            'company_id' => $companyId,
            'applications' => $applications,
        ]);
    }
    #[Route('/company-pending', name: 'company_pending', methods: ['GET'])]
    public function companyPending(Request $request, ApplicantRepository $applicantRepository): Response
    {
        $companyId = $request->query->get('company_id');
        $applications = [];
    
        if ($companyId) {
            $applications = $applicantRepository->findBy(
                [
                    'companyId' => $companyId,
                    'status' => 'Pending'
                ],
                ['appliedDate' => 'DESC']
            );
        }
    
        return $this->render('application/pending_application.html.twig', [
            'company_id' => $companyId,
            'applications' => $applications,
        ]);
    }

    #[Route('/application/update/{id}', name: 'app_update_application', methods: ['GET', 'POST'])]
    public function updateApplication(
        Request $request, 
        Applicant $applicant, 
        EntityManagerInterface $entityManager,
        EmployeeRepository $employeeRepository
    ): Response {
        $oldStatus = $applicant->getStatus();

        if ($request->isMethod('POST')) {
            if ($request->request->has('comment')) {
                $applicant->setComment($request->request->get('comment'));
                $applicant->setAdditionalFile($request->request->get('additional_file'));
            } elseif ($request->request->has('status')) {
                $newStatus = $request->request->get('status');
                $applicant->setStatus($newStatus);

                // If status is changed to "Accepted", create a new employee
                if ($newStatus === 'Accepted' && $oldStatus !== 'Accepted') {
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

            // FIX: Use the correct route name after status update
            if ($request->request->has('comment')) {
                return $this->redirectToRoute('app_user_applications', ['user_id' => $applicant->getUserId()]);
            } else {
                return $this->redirectToRoute('company_applications', ['company_id' => $applicant->getCompanyId()]);
            }
        }

        // Handle GET requests to display the edit form
        return $this->render('application/edit_application.html.twig', [
            'application' => $applicant
        ]);
    }

    #[Route('/application/delete/{id}', name: 'app_delete_application', methods: ['POST'])]
    public function deleteApplication(Request $request, Applicant $applicant, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete' . $applicant->getId(), $request->request->get('_token'))) {
            $entityManager->remove($applicant);
            $entityManager->flush();
            $this->addFlash('success', 'Application deleted successfully!');
        }

        return $this->redirectToRoute('app_user_applications', ['user_id' => $applicant->getUserId()]);
    }
}