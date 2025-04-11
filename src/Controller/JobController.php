<?php

namespace App\Controller;

use App\Entity\Job;
use App\Form\JobType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class JobController extends AbstractController
{
    #[Route('/job/new', name: 'app_job_new')]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $job = new Job();
        $job->setPostedDate(new \DateTime());
        
        $form = $this->createForm(JobType::class, $job);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($job);
            $entityManager->flush();

            $this->addFlash('success', 'Job created successfully!');
            return $this->redirectToRoute('app_job_list');
        }

        return $this->render('job/new.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    #[Route('/job/list', name: 'app_job_list')]
    public function list(Request $request, EntityManagerInterface $entityManager): Response
    {
        $companyId = $request->query->get('company_id');
        $jobs = [];
        
        if ($companyId) {
            $jobs = $entityManager->getRepository(Job::class)->findBy(
                ['companyId' => $companyId],
                ['postedDate' => 'DESC']
            );
        }

        return $this->render('job/list.html.twig', [
            'jobs' => $jobs,
            'company_id' => $companyId
        ]);
    }

    #[Route('/job/edit/{id}', name: 'app_job_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Job $job, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(JobType::class, $job);
        $form->handleRequest($request);
    
        if ($form->isSubmitted() && $form->isValid()) {
            // Add explicit persist call to ensure entity is tracked
            $entityManager->persist($job);
            $entityManager->flush();
    
            $this->addFlash('success', 'Job updated successfully!');
            return $this->redirectToRoute('app_job_list', [
                'company_id' => $job->getCompanyId()
            ]);
        }
    
        return $this->render('job/edit.html.twig', [
            'job' => $job,
            'form' => $form->createView(),
        ]);
    }

    #[Route('/job/delete/{id}', name: 'app_job_delete', methods: ['POST'])]
    public function delete(Request $request, Job $job, EntityManagerInterface $entityManager): Response
    {
        $companyId = $job->getCompanyId();
        
        if ($this->isCsrfTokenValid('delete'.$job->getId(), $request->request->get('_token'))) {
            $entityManager->remove($job);
            $entityManager->flush();
            $this->addFlash('success', 'Job deleted successfully!');
        }

        return $this->redirectToRoute('app_job_list', [
            'company_id' => $companyId
        ]);
    }


    #[Route('/jobs', name: 'app_jobs_all')]
public function allJobs(EntityManagerInterface $entityManager): Response
{
    $jobs = $entityManager->getRepository(Job::class)->findBy(
        [],
        ['postedDate' => 'DESC']
    );

    return $this->render('job/all.html.twig', [
        'jobs' => $jobs,
    ]);
}

#[Route('/job/{id}', name: 'app_job_show')]
public function show(Job $job): Response
{
    return $this->render('job/show.html.twig', [
        'job' => $job,
    ]);
}
}