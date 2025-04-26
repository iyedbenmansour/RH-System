<?php

namespace App\Controller;

use App\Entity\LeaveRequest;
use App\Entity\OnlineJob;

use App\Form\LeaveRequestType;
use App\Repository\LeaveRequestRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;//url
use Symfony\Component\String\Slugger\SluggerInterface;
use Symfony\Component\HttpFoundation\File\Exception\FileException;


class LeaveRequestController extends AbstractController
{
    #[Route('/leave-request/create', name: 'leave_request_create', methods: ['GET', 'POST'])]
    public function create(
        Request $request,//données du formulaire
        EntityManagerInterface $entityManager,//GB
        SluggerInterface $slugger
    ): Response {
        $leaveRequest = new LeaveRequest();//vide
        $form = $this->createForm(LeaveRequestType::class, $leaveRequest);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $pdfFile = $form->get('pdfFile')->getData();//recuperer champ valeur 
            
            if ($pdfFile) {
                $originalFilename = pathinfo($pdfFile->getClientOriginalName(), PATHINFO_FILENAME);
                $safeFilename = $slugger->slug($originalFilename);
                $newFilename = $safeFilename.'-'.uniqid().'.'.$pdfFile->guessExtension();
                
                try {
                    $pdfFile->move(
                        $this->getParameter('pdf_directory'),
                        $newFilename
                    );
                    $leaveRequest->setPdfPath($newFilename);//save
                } catch (FileException $e) {
                    $this->addFlash('error', 'There was an error uploading your PDF file.');
                    return $this->redirectToRoute('leave_request_create');
                }
            }
            
            $leaveRequest->setConfirmed(false);
            $entityManager->persist($leaveRequest);
            $entityManager->flush();//xécute la requête SQL → la demande est enregistrée en base de données

            $this->addFlash('success', 'Leave request created successfully!');
            return $this->redirectToRoute('employee_leave_requests', ['employeeId' => $leaveRequest->getEmployeeId()]);
        }

        return $this->render('leave_request/create.html.twig', [
            'form' => $form->createView(),
        ]);
    }

  
    #[Route('/leave-requests/employee/{employeeId}', name: 'employee_leave_requests', methods: ['GET'])]// accepte seulement les requêtes GET
    public function employeeLeaveRequests(int $employeeId, LeaveRequestRepository $leaveRequestRepository, EntityManagerInterface $entityManager): Response//page http
    {
        $leaveRequests = $leaveRequestRepository->findBy(['employeeId' => $employeeId]);
        
        // Calculate confirmed normal leave days
        $confirmedNormalDays = 0;
        foreach ($leaveRequests as $request) {
            if ($request->isConfirmed() && $request->getLeaveType() === 'normal') {
                $start = $request->getStartDate();
                $end = $request->getEndDate();
                $diff = $start->diff($end);
                $confirmedNormalDays += $diff->days + 1; // +1 to include both start and end dates
            }
        }
        
        $remainingDays = 18 - $confirmedNormalDays;
        
        // Get all online jobs for these leave requests
        $onlineJobs = [];
        if (!empty($leaveRequests)) {
            $leaveRequestIds = array_map(fn($lr) => $lr->getId(), $leaveRequests);
            $onlineJobs = $entityManager->getRepository(OnlineJob::class)
                ->findBy(['leaveRequestId' => $leaveRequestIds]);
            
            // Create a mapping of leaveRequestId => OnlineJob
            $onlineJobs = array_reduce($onlineJobs, function($carry, $oj) {
                $carry[$oj->getLeaveRequestId()] = $oj;
                return $carry;//garde en mémoire le résultat à chaque étape
            }, []);
        }
    
        return $this->render('leave_request/employee_list.html.twig', [//affichage page html
            'leaveRequests' => $leaveRequests,
            'onlineJobs' => $onlineJobs,
            'confirmedNormalDays' => $confirmedNormalDays,
            'remainingDays' => $remainingDays
        ]);
    }   

    #[Route('/leave-request/edit/{id}', name: 'leave_request_edit', methods: ['GET', 'POST'])]
    public function edit(
        int $id, 
        Request $request,//donne  
        LeaveRequestRepository $leaveRequestRepository, 
        EntityManagerInterface $entityManager,
        SluggerInterface $slugger
    ): Response {
        $leaveRequest = $leaveRequestRepository->find($id);

        if (!$leaveRequest) {
            throw $this->createNotFoundException('Leave request not found');//lancer err
        }

        $form = $this->createForm(LeaveRequestType::class, $leaveRequest);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $pdfFile = $form->get('pdfFile')->getData();
            
            if ($pdfFile) {
                $originalFilename = pathinfo($pdfFile->getClientOriginalName(), PATHINFO_FILENAME);
                $safeFilename = $slugger->slug($originalFilename);
                $newFilename = $safeFilename.'-'.uniqid().'.'.$pdfFile->guessExtension();
                
                try {
                    $pdfFile->move(
                        $this->getParameter('pdf_directory'),
                        $newFilename//servise
                    );
                    
                    // Remove old file if exists
                    if ($leaveRequest->getPdfPath()) {
                        $oldFilePath = $this->getParameter('pdf_directory').'/'.$leaveRequest->getPdfPath();
                        if (file_exists($oldFilePath)) {
                            unlink($oldFilePath);
                        }
                    }
                    
                    $leaveRequest->setPdfPath($newFilename);
                } catch (FileException $e) {
                    $this->addFlash('error', 'There was an error uploading your PDF file.');
                    return $this->redirectToRoute('leave_request_edit', ['id' => $id]);
                }
            }

            $entityManager->flush();

            $this->addFlash('success', 'Leave request updated successfully!');
            return $this->redirectToRoute('employee_leave_requests', ['employeeId' => $leaveRequest->getEmployeeId()]);
        }

        return $this->render('leave_request/edit.html.twig', [
            'form' => $form->createView(),
            'pdfPath' => $leaveRequest->getPdfPath(),
        ]);
    }

    #[Route('/leave-request/delete/{id}', name: 'leave_request_delete', methods: ['POST'])]
    public function delete(int $id, LeaveRequestRepository $leaveRequestRepository, EntityManagerInterface $entityManager): Response
    {
        $leaveRequest = $leaveRequestRepository->find($id);

        if (!$leaveRequest) {
            throw $this->createNotFoundException('Leave request not found');
        }

        $employeeId = $leaveRequest->getEmployeeId();
        $entityManager->remove($leaveRequest);
        $entityManager->flush();

        $this->addFlash('success', 'Leave request deleted successfully!');
        return $this->redirectToRoute('employee_leave_requests', ['employeeId' => $employeeId]);
    }


#[Route('/leave-requests/company/{companyId}', name: 'company_leave_requests', methods: ['GET'])]
public function companyLeaveRequests(int $companyId, LeaveRequestRepository $leaveRequestRepository, EntityManagerInterface $entityManager): Response
{
    $leaveRequests = $leaveRequestRepository->findBy(['companyId' => $companyId]);
    
    // Get all online jobs for these leave requests
    $onlineJobs = [];
    if (!empty($leaveRequests)) {
        $leaveRequestIds = array_map(fn($lr) => $lr->getId(), $leaveRequests);//[2 4]
        $onlineJobResults = $entityManager->getRepository(OnlineJob::class)
            ->findBy(['leaveRequestId' => $leaveRequestIds]);
        
        // Create a mapping of leaveRequestId => OnlineJob
        foreach ($onlineJobResults as $onlineJob) {
            $onlineJobs[$onlineJob->getLeaveRequestId()] = $onlineJob;
        }
    }

    return $this->render('leave_request/company_list.html.twig', [
        'leaveRequests' => $leaveRequests,
        'onlineJobs' => $onlineJobs,
    ]);
}

    #[Route('/leave-request/confirm/{id}', name: 'leave_request_confirm', methods: ['POST'])]
    public function confirm(int $id, LeaveRequestRepository $leaveRequestRepository, EntityManagerInterface $entityManager): Response
    {
        $leaveRequest = $leaveRequestRepository->find($id);

        if (!$leaveRequest) {
            throw $this->createNotFoundException('Leave request not found');
        }

        $leaveRequest->setConfirmed(true);
        $entityManager->flush();

        $this->addFlash('success', 'Leave request confirmed successfully!');
        return $this->redirectToRoute('company_leave_requests', ['companyId' => $leaveRequest->getCompanyId()]);
    }
    #[Route('/leave-request/revoke/{id}', name: 'leave_request_revoke', methods: ['POST'])]
    public function revoke(int $id, LeaveRequestRepository $leaveRequestRepository, EntityManagerInterface $entityManager): Response
    {
        $leaveRequest = $leaveRequestRepository->find($id);

        if (!$leaveRequest) {
            throw $this->createNotFoundException('Leave request not found');
        }

        $leaveRequest->setConfirmed(false); // Revoke the confirmation
        $entityManager->flush();

        $this->addFlash('success', 'Leave request confirmation revoked successfully!');
        return $this->redirectToRoute('company_leave_requests', ['companyId' => $leaveRequest->getCompanyId()]);
    }
    #[Route('/company/{companyId}/leave-ranking', name: 'company_leave_ranking')]
    public function companyLeaveRanking(
        int $companyId,
        LeaveRequestRepository $leaveRequestRepository
    ): Response {
        $leaveRequests = $leaveRequestRepository->findBy(['companyId' => $companyId]);
    
        $employeeLeaveCount = [];
        foreach ($leaveRequests as $leaveRequest) {
            $employeeId = $leaveRequest->getEmployeeId();
            if (!isset($employeeLeaveCount[$employeeId])) {
                $employeeLeaveCount[$employeeId] = 0;
            }
            $employeeLeaveCount[$employeeId]++;
        }
    
        asort($employeeLeaveCount);
    
        $leaveRanking = [];
        $rank = 1;
        $total = count($employeeLeaveCount);
    
        foreach ($employeeLeaveCount as $employeeId => $leaveCount) {
            $comment = match ($rank) {
                1 => '🏆 Best Attendance',
                $total => '⚠️ Most Leaves Taken',
                default => 'Average Attendance',
            };
    
            $leaveRanking[] = [
                'rank' => $rank,
                'employeeId' => $employeeId,
                'leaveCount' => $leaveCount,
                'comment' => $comment,
                'position' => $rank <= 3 ? $rank : null,
            ];
    
            $rank++;
        }
    
        return $this->render('leave_request/company.html.twig', [
            'companyId' => $companyId,
            'leaveRanking' => $leaveRanking
        ]);
    }
    #[Route('/online-job/toggle-status/{id}', name: 'online_job_toggle_status', methods: ['POST'])]
    public function toggleStatus(OnlineJob $onlineJob, EntityManagerInterface $entityManager): Response
    {
        // Toggle the confirmation status
        $onlineJob->setIsConfirmed(!$onlineJob->isConfirmed());
        $entityManager->flush();
    
        $this->addFlash('success', sprintf(
            'Online job status changed to %s', 
            $onlineJob->isConfirmed() ? 'Confirmed' : 'Pending'
        ));
    
        // Get the associated leave request using leaveRequestId
        $leaveRequest = $entityManager->getRepository(LeaveRequest::class)
            ->find($onlineJob->getLeaveRequestId());
        
        if (!$leaveRequest) {
            throw $this->createNotFoundException('Leave request not found');
        }
    
        return $this->redirectToRoute('company_leave_requests', [
            'companyId' => $leaveRequest->getCompanyId()
        ]);
    }
    
    

}