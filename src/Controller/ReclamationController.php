<?php

namespace App\Controller;

use App\Entity\Reclamation;
use App\Form\ReclamationType;
use App\Repository\ReclamationRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\String\Slugger\SluggerInterface;

#[Route('/reclamation')]
class ReclamationController extends AbstractController
{
    #[Route('/', name: 'app_reclamation_index', methods: ['GET'])]
    public function index(ReclamationRepository $reclamationRepository): Response
    {
        return $this->render('reclamation/index.html.twig', [
            'reclamations' => $reclamationRepository->findAll(),
        ]);
    }

    #[Route('/status-management', name: 'app_reclamation_status_management', methods: ['GET'])]
    public function statusManagement(ReclamationRepository $reclamationRepository): Response
    {
        $pending = $reclamationRepository->findBy(['statueOfReclamation' => 'pending']);
        $inProgress = $reclamationRepository->findBy(['statueOfReclamation' => 'in_progress']);
        $resolved = $reclamationRepository->findBy(['statueOfReclamation' => 'resolved']);
        $rejected = $reclamationRepository->findBy(['statueOfReclamation' => 'rejected']);
        
        return $this->render('reclamation/status_management.html.twig', [
            'pending' => $pending,
            'inProgress' => $inProgress,
            'resolved' => $resolved,
            'rejected' => $rejected,
        ]);
    }

    #[Route('/update-status/{id}', name: 'app_reclamation_update_status', methods: ['POST'])]
    public function updateStatus(Request $request, Reclamation $reclamation, EntityManagerInterface $entityManager): JsonResponse
    {
        $newStatus = $request->request->get('status');
        $validStatuses = ['pending', 'in_progress', 'resolved', 'rejected'];
        
        if (!in_array($newStatus, $validStatuses)) {
            return $this->json(['success' => false, 'message' => 'Invalid status'], 400);
        }
    
        $reclamation->setStatueOfReclamation($newStatus);
        $entityManager->flush();
    
        return $this->json([
            'success' => true,
            'newStatus' => $newStatus,
            'statusLabel' => ucfirst(str_replace('_', ' ', $newStatus)),
            'statusClass' => $this->getStatusBadgeClass($newStatus)
        ]);
    }

    private function getStatusBadgeClass(string $status): string
    {
        return match ($status) {
            'pending' => 'warning',
            'resolved' => 'success',
            'in_progress' => 'info',
            'rejected' => 'danger',
            default => 'secondary',
        };
    }

    #[Route('/new', name: 'app_reclamation_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager, SluggerInterface $slugger): Response
    {
        $reclamation = new Reclamation();
        $reclamation->setDate(new \DateTime());
        $reclamation->setStatueOfReclamation('pending');
        
        $form = $this->createForm(ReclamationType::class, $reclamation);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // Handle image upload
            $imageFile = $form->get('imageFile')->getData();
            if ($imageFile) {
                $originalFilename = pathinfo($imageFile->getClientOriginalName(), PATHINFO_FILENAME);
                $safeFilename = $slugger->slug($originalFilename);
                $newFilename = $safeFilename.'-'.uniqid().'.'.$imageFile->guessExtension();

                try {
                    $imageFile->move(
                        $this->getParameter('reclamation_images_directory'),
                        $newFilename
                    );
                    $reclamation->setImagePath($newFilename);
                } catch (FileException $e) {
                    $this->addFlash('error', 'Error uploading image: '.$e->getMessage());
                    return $this->redirectToRoute('app_reclamation_new');
                }
            } else {
                $reclamation->setImagePath('no-image.jpg');
            }

            // Handle PDF upload
            $pdfFile = $form->get('pdfFile')->getData();
            if ($pdfFile) {
                $originalFilename = pathinfo($pdfFile->getClientOriginalName(), PATHINFO_FILENAME);
                $safeFilename = $slugger->slug($originalFilename);
                $newFilename = $safeFilename.'-'.uniqid().'.pdf';

                try {
                    $pdfFile->move(
                        $this->getParameter('reclamation_pdfs_directory'),
                        $newFilename
                    );
                    $reclamation->setPdfPath($newFilename);
                } catch (FileException $e) {
                    $this->addFlash('error', 'Error uploading PDF: '.$e->getMessage());
                    return $this->redirectToRoute('app_reclamation_new');
                }
            } else {
                $reclamation->setPdfPath('no-pdf.pdf');
            }

            $entityManager->persist($reclamation);
            $entityManager->flush();
            
            $this->addFlash('success', 'Reclamation created successfully.');
            return $this->redirectToRoute('app_reclamation_index');
        }

        return $this->render('reclamation/new.html.twig', [
            'reclamation' => $reclamation,
            'form' => $form->createView(),
        ]);
    }

    #[Route('/{id}', name: 'app_reclamation_show', methods: ['GET'])]
    public function show(Reclamation $reclamation): Response
    {
        return $this->render('reclamation/show.html.twig', [
            'reclamation' => $reclamation,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_reclamation_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Reclamation $reclamation, EntityManagerInterface $entityManager, SluggerInterface $slugger): Response
    {
        $form = $this->createForm(ReclamationType::class, $reclamation);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // Handle image upload
            $imageFile = $form->get('imageFile')->getData();
            if ($imageFile) {
                $originalFilename = pathinfo($imageFile->getClientOriginalName(), PATHINFO_FILENAME);
                $safeFilename = $slugger->slug($originalFilename);
                $newFilename = $safeFilename.'-'.uniqid().'.'.$imageFile->guessExtension();

                try {
                    $imageFile->move(
                        $this->getParameter('reclamation_images_directory'),
                        $newFilename
                    );
                    // Remove old image if it's not the default one
                    if ($reclamation->getImagePath() !== 'no-image.jpg') {
                        $oldImage = $this->getParameter('reclamation_images_directory').'/'.$reclamation->getImagePath();
                        if (file_exists($oldImage)) {
                            unlink($oldImage);
                        }
                    }
                    $reclamation->setImagePath($newFilename);
                } catch (FileException $e) {
                    $this->addFlash('error', 'Error uploading image: '.$e->getMessage());
                    return $this->redirectToRoute('app_reclamation_edit', ['id' => $reclamation->getId()]);
                }
            }

            // Handle PDF upload
            $pdfFile = $form->get('pdfFile')->getData();
            if ($pdfFile) {
                $originalFilename = pathinfo($pdfFile->getClientOriginalName(), PATHINFO_FILENAME);
                $safeFilename = $slugger->slug($originalFilename);
                $newFilename = $safeFilename.'-'.uniqid().'.pdf';

                try {
                    $pdfFile->move(
                        $this->getParameter('reclamation_pdfs_directory'),
                        $newFilename
                    );
                    // Remove old PDF if it's not the default one
                    if ($reclamation->getPdfPath() !== 'no-pdf.pdf') {
                        $oldPdf = $this->getParameter('reclamation_pdfs_directory').'/'.$reclamation->getPdfPath();
                        if (file_exists($oldPdf)) {
                            unlink($oldPdf);
                        }
                    }
                    $reclamation->setPdfPath($newFilename);
                } catch (FileException $e) {
                    $this->addFlash('error', 'Error uploading PDF: '.$e->getMessage());
                    return $this->redirectToRoute('app_reclamation_edit', ['id' => $reclamation->getId()]);
                }
            }

            $reclamation->setDate(new \DateTime());
            $entityManager->flush();
            
            $this->addFlash('success', 'Reclamation updated successfully.');
            return $this->redirectToRoute('app_reclamation_index');
        }

        return $this->render('reclamation/edit.html.twig', [
            'reclamation' => $reclamation,
            'form' => $form->createView(),
        ]);
    }

    #[Route('/{id}', name: 'app_reclamation_delete', methods: ['POST'])]
    public function delete(Request $request, Reclamation $reclamation, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$reclamation->getId(), $request->request->get('_token'))) {
            // Delete associated files
            if ($reclamation->getImagePath() !== 'no-image.jpg') {
                $imagePath = $this->getParameter('reclamation_images_directory').'/'.$reclamation->getImagePath();
                if (file_exists($imagePath)) {
                    unlink($imagePath);
                }
            }
            
            if ($reclamation->getPdfPath() !== 'no-pdf.pdf') {
                $pdfPath = $this->getParameter('reclamation_pdfs_directory').'/'.$reclamation->getPdfPath();
                if (file_exists($pdfPath)) {
                    unlink($pdfPath);
                }
            }
            
            $entityManager->remove($reclamation);
            $entityManager->flush();
            $this->addFlash('success', 'Reclamation deleted successfully.');
        } else {
            $this->addFlash('error', 'Invalid CSRF token. Deletion failed.');
        }

        return $this->redirectToRoute('app_reclamation_index');
    }
}