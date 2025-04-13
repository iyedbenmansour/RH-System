<?php
// src/Controller/OnlineJobController.php
namespace App\Controller;

use App\Entity\OnlineJob;
use App\Entity\LeaveRequest;
use App\Form\OnlineJobType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class OnlineJobController extends AbstractController
{
    #[Route('/online-job/create/{leaveRequestId}', name: 'online_job_create', methods: ['GET', 'POST'])]
    public function create(Request $request, EntityManagerInterface $entityManager, int $leaveRequestId): Response
    {
        $existingOnlineJob = $entityManager->getRepository(OnlineJob::class)
            ->findOneBy(['leaveRequestId' => $leaveRequestId]);
        
        if ($existingOnlineJob) {
            return $this->redirectToRoute('online_job_view', ['id' => $existingOnlineJob->getId()]);
        }
    
        $leaveRequest = $entityManager->getRepository(LeaveRequest::class)->find($leaveRequestId);
        if (!$leaveRequest) {
            throw $this->createNotFoundException('Leave request not found');
        }
    
        $onlineJob = new OnlineJob();
        $onlineJob->setLeaveRequestId($leaveRequestId)
                  ->setStartDate($leaveRequest->getStartDate())
                  ->setEndDate($leaveRequest->getEndDate());
    
        $form = $this->createForm(OnlineJobType::class, $onlineJob);
        $form->handleRequest($request);
    
        if ($form->isSubmitted() && $form->isValid()) {
            $onlineJob->setIsConfirmed(false);
            $entityManager->persist($onlineJob);
            $entityManager->flush();
    
            $this->addFlash('success', 'Online job application submitted successfully!');
            return $this->redirectToRoute('employee_leave_requests', ['employeeId' => $leaveRequest->getEmployeeId()]);
        }
    
        return $this->render('online_job/create.html.twig', [
            'form' => $form->createView(),
            'leaveRequest' => $leaveRequest,
        ]);
    }

    #[Route('/online-job/{id}', name: 'online_job_view', methods: ['GET'])]
    public function view(OnlineJob $onlineJob, EntityManagerInterface $entityManager): Response
    {
        $leaveRequest = $entityManager->getRepository(LeaveRequest::class)
            ->find($onlineJob->getLeaveRequestId());

        if (!$leaveRequest) {
            throw $this->createNotFoundException('Leave request not found');
        }

        return $this->render('online_job/view.html.twig', [
            'onlineJob' => $onlineJob,
            'leaveRequest' => $leaveRequest,
        ]);
    }

    #[Route('/online-job/edit/{id}', name: 'online_job_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, OnlineJob $onlineJob, EntityManagerInterface $entityManager): Response
    {
        $leaveRequest = $entityManager->getRepository(LeaveRequest::class)
            ->find($onlineJob->getLeaveRequestId());
        
        if (!$leaveRequest) {
            throw $this->createNotFoundException('Leave request not found');
        }

        $form = $this->createForm(OnlineJobType::class, $onlineJob);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            $this->addFlash('success', 'Online job updated successfully!');
            return $this->redirectToRoute('online_job_view', ['id' => $onlineJob->getId()]);
        }

        return $this->render('online_job/edit.html.twig', [
            'form' => $form->createView(),
            'onlineJob' => $onlineJob,
            'leaveRequest' => $leaveRequest,
        ]);
    }

    #[Route('/online-job/delete/{id}', name: 'online_job_delete', methods: ['POST'])]
    public function delete(Request $request, OnlineJob $onlineJob, EntityManagerInterface $entityManager): Response
    {
        $leaveRequest = $entityManager->getRepository(LeaveRequest::class)
            ->find($onlineJob->getLeaveRequestId());
        
        if (!$leaveRequest) {
            throw $this->createNotFoundException('Leave request not found');
        }

        if ($this->isCsrfTokenValid('delete'.$onlineJob->getId(), $request->request->get('_token'))) {
            $entityManager->remove($onlineJob);
            $entityManager->flush();
            
            $this->addFlash('success', 'Online job application deleted successfully!');
        }

        return $this->redirectToRoute('employee_leave_requests', [
            'employeeId' => $leaveRequest->getEmployeeId()
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