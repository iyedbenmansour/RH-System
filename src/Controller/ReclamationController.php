<?php

namespace App\Controller;

use App\Entity\Reclamation;
use App\Form\ReclamationType;
use App\Repository\ReclamationRepository;
use App\Service\ReclamationService;
use App\Service\EmailService;
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
    private $reclamationService;
    private $emailService;

    public function __construct(ReclamationService $reclamationService, EmailService $emailService) 
    {
        $this->reclamationService = $reclamationService;
        $this->emailService = $emailService;
    }

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
        $notTreated = $reclamationRepository->findBy(['statueOfReclamation' => 'Not Treated']);
        $inProgress = $reclamationRepository->findBy(['statueOfReclamation' => 'In Progress']);
        $resolved = $reclamationRepository->findBy(['statueOfReclamation' => 'Resolved']);
        $rejected = $reclamationRepository->findBy(['statueOfReclamation' => 'Rejected']);
        
        return $this->render('reclamation/status_management.html.twig', [
            'notTreated' => $notTreated,
            'inProgress' => $inProgress,
            'resolved' => $resolved,
            'rejected' => $rejected,
        ]);
    }

    #[Route('/update-status/{id}', name: 'app_reclamation_update_status', methods: ['POST'])]
    public function updateStatus(Request $request, EntityManagerInterface $entityManager, int $id): JsonResponse
    {
        // Récupérer la réclamation
        $reclamation = $entityManager->getRepository(Reclamation::class)->find($id);
        
        if (!$reclamation) {
            return $this->json([
                'success' => false,
                'message' => 'Réclamation non trouvée'
            ], 404);
        }
        
        // Vérifier le statut
        $newStatus = $request->request->get('status');
        $validStatuses = ['Not Treated', 'In Progress', 'Resolved', 'Rejected'];
        
        if (!in_array($newStatus, $validStatuses)) {
            return $this->json([
                'success' => false, 
                'message' => 'Statut invalide'
            ], 400);
        }
        
        try {
            // Mise à jour directe du statut
            $reclamation->setStatueOfReclamation($newStatus);
            $entityManager->persist($reclamation);
            $entityManager->flush();
            
            // Préparer les labels et classes pour l'interface
            $statusLabel = match($newStatus) {
                'Not Treated' => 'Non traité',
                'In Progress' => 'En cours',
                'Resolved' => 'Résolu',
                'Rejected' => 'Rejeté',
                default => $newStatus
            };
            
            $statusClass = match($newStatus) {
                'Not Treated' => 'not-treated',
                'In Progress' => 'in-progress',
                'Resolved' => 'resolved',
                'Rejected' => 'rejected',
                default => 'secondary'
            };
            
            return $this->json([
                'success' => true,
                'message' => 'Statut mis à jour avec succès',
                'status' => $newStatus,
                'statusLabel' => $statusLabel,
                'statusClass' => $statusClass
            ]);
        } catch (\Exception $e) {
            return $this->json([
                'success' => false,
                'message' => 'Erreur lors de la mise à jour: ' . $e->getMessage()
            ], 500);
        }
    }

    #[Route('/new', name: 'app_reclamation_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager, SluggerInterface $slugger): Response
    {
        $reclamation = new Reclamation();
        $reclamation->setDate(new \DateTime());
        $reclamation->setStatueOfReclamation('Not Treated');
        
        $form = $this->createForm(ReclamationType::class, $reclamation);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // Ensure the default status is set
            $reclamation->setStatueOfReclamation('Not Treated');
            
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

            // Utilisation du service pour ajouter la réclamation (avec nettoyage du texte)
            $this->reclamationService->addReclamation($reclamation);
            
            $this->addFlash('success', 'Complaint created successfully.');
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

            // Utilisation du service pour mettre à jour la réclamation
            $this->reclamationService->updateReclamation($reclamation);
            
            $this->addFlash('success', 'Complaint updated successfully.');
            return $this->redirectToRoute('app_reclamation_index');
        }

        return $this->render('reclamation/edit.html.twig', [
            'reclamation' => $reclamation,
            'form' => $form->createView(),
        ]);
    }

    #[Route('/{id}/delete', name: 'app_reclamation_delete', methods: ['POST', 'DELETE'])]
    public function delete(Request $request, int $id, EntityManagerInterface $entityManager): Response
    {
        // Vérifier si la réclamation existe avant de tenter de la supprimer
        $reclamation = $entityManager->getRepository(Reclamation::class)->find($id);
        if (!$reclamation) {
            $this->addFlash('error', 'Réclamation non trouvée.');
            return $this->redirectToRoute('app_reclamation_index');
        }

        $token = $request->request->get('_token');
        // Débogage: vérifier si le token est présent
        if (!$token) {
            $this->addFlash('error', 'Token CSRF manquant dans la requête.');
            return $this->redirectToRoute('app_reclamation_index');
        }
        
        if ($this->isCsrfTokenValid('delete'.$id, $token)) {
            try {
                $success = $this->reclamationService->deleteReclamation($id);
                
                if ($success) {
                    $this->addFlash('success', 'Réclamation supprimée avec succès.');
                } else {
                    $this->addFlash('error', 'Erreur lors de la suppression de la réclamation.');
                }
            } catch (\Exception $e) {
                $this->addFlash('error', 'Erreur: ' . $e->getMessage());
            }
        } else {
            $this->addFlash('error', 'Token CSRF invalide. Reçu: ' . substr($token, 0, 10) . '...');
        }

        return $this->redirectToRoute('app_reclamation_index');
    }
}