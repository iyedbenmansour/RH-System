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
use Knp\Component\Pager\PaginatorInterface; // Add this import


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
    public function index(
        Request $request,
        ReclamationRepository $reclamationRepository,
        PaginatorInterface $paginator
    ): Response
    {
        $search = $request->query->get('q');
        $page = $request->query->getInt('page', 1);
        
        // Find not treated reclamations for the specific company with optional search
        $query = $reclamationRepository->findNotTreatedQuery($search);
        
        $pagination = $paginator->paginate(
            $query,
            $page,
            5 // Items per page
        );
        
        return $this->render('reclamation/index.html.twig', [
            'reclamations' => $pagination,
            'search' => $search,
        ]);
    }
    #[Route('/archive', name: 'app_reclamation_archive', methods: ['GET'])]
    public function archive(
        Request $request,
        ReclamationRepository $reclamationRepository,
        PaginatorInterface $paginator // use KnpPaginatorBundle or similar
    ): Response
    {
        $statuses = ['In Progress', 'Resolved', 'Rejected'];
    
        $statut = $request->query->get('statut');
        $search = $request->query->get('q');
        $page = $request->query->getInt('page', 1);
    
        // Find by filter & search
        $query = $reclamationRepository->getArchivedQuery($statuses, $statut, $search);
    
        $pagination = $paginator->paginate(
            $query, /* query NOT result */
            $page,
            5 // per page
        );
    
        return $this->render('reclamation/archive.html.twig', [
            'reclamations' => $pagination,
            'statuses' => $statuses,
            'current_statut' => $statut,
            'search' => $search,
        ]);
    }

    #[Route('/status-management', name: 'app_reclamation_status_management', methods: ['GET'])]
    public function statusManagement(ReclamationRepository $reclamationRepository): Response
    {
        $notTreated = $reclamationRepository->findByStatus('Not Treated');
        $inProgress = $reclamationRepository->findByStatus('In Progress');
        $resolved = $reclamationRepository->findByStatus('Resolved');
        $rejected = $reclamationRepository->findByStatus('Rejected');
        
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
        // Validate CSRF token
        $submittedToken = $request->request->get('_token');
        if (!$this->isCsrfTokenValid('app', $submittedToken)) {
            return $this->json(['success' => false, 'message' => 'Invalid CSRF token'], 403);
        }
    
        $reclamation = $entityManager->getRepository(Reclamation::class)->find($id);
        
        if (!$reclamation) {
            return $this->json(['success' => false, 'message' => 'Complaint not found'], 404);
        }
        
        $newStatus = $request->request->get('status');
        $validStatuses = ['Not Treated', 'In Progress', 'Resolved', 'Rejected'];
        
        if (!in_array($newStatus, $validStatuses)) {
            return $this->json(['success' => false, 'message' => 'Invalid status'], 400);
        }
        
        try {
            $reclamation->setStatueOfReclamation($newStatus);
            $entityManager->flush();
            
            return $this->json([
                'success' => true,
                'message' => 'Status updated successfully',
                'newStatus' => $newStatus,
                'statusClass' => strtolower(str_replace(' ', '-', $newStatus))
            ]);
            
        } catch (\Exception $e) {
            return $this->json(['success' => false, 'message' => 'Error updating status: ' . $e->getMessage()], 500);
        }
    }
    
    #[Route('/{id}/send-status-email', name: 'app_reclamation_send_status_email', methods: ['GET', 'POST'])]
    public function sendStatusEmail(
        Request $request, 
        int $id, 
        ReclamationRepository $reclamationRepository, 
        EmailService $emailService
    ): Response
    {
        $reclamation = $reclamationRepository->find($id);
        
        if (!$reclamation) {
            $this->addFlash('error', 'Réclamation non trouvée.');
            return $this->redirectToRoute('app_reclamation_index');
        }
        
        $defaultComment = $this->getDefaultComment($reclamation->getStatueOfReclamation());
        $comment = $defaultComment;
        $emailSent = false;
        
        if ($request->isMethod('POST')) {
            $comment = $request->request->get('comment', $defaultComment);
            
            try {
                // Envoyer l'email
                $emailService->sendReclamationStatusEmail($reclamation, $comment);
                
                $this->addFlash('success', 'Email envoyé avec succès à : alabendawed@gmail.com');
                $emailSent = true;
                
                // Redirection vers la page de détails de la réclamation après 2 secondes (pour laisser le temps de voir l'alerte)
                return $this->render('reclamation/send_status_email.html.twig', [
                    'reclamation' => $reclamation,
                    'comment' => $comment,
                    'emailSent' => $emailSent,
                    'redirectUrl' => $this->generateUrl('app_reclamation_show', ['id' => $id])
                ]);
            } catch (\Exception $e) {
                $this->addFlash('error', 'Erreur lors de l\'envoi de l\'email: ' . $e->getMessage());
            }
        }
        
        return $this->render('reclamation/send_status_email.html.twig', [
            'reclamation' => $reclamation,
            'comment' => $comment,
            'emailSent' => $emailSent
        ]);
    }
    
    private function getDefaultComment(string $status): string
    {
        switch ($status) {
            case 'Not Treated':
                return "Votre réclamation a été reçue et sera traitée prochainement par notre équipe.";
            case 'In Progress':
                return "Votre réclamation est actuellement en cours de traitement. Notre équipe travaille pour résoudre votre problème dans les meilleurs délais.";
            case 'Resolved':
                return "Nous sommes heureux de vous informer que votre réclamation a été résolue. N'hésitez pas à nous contacter si vous avez d'autres questions.";
            case 'Rejected':
                return "Après examen, nous sommes au regret de vous informer que votre réclamation ne peut pas être traitée favorablement. Pour plus d'informations, veuillez contacter le service RH.";
            default:
                return "Merci pour votre réclamation. Notre équipe est à votre disposition pour toute question.";
        }
    }

    #[Route('/new', name: 'app_reclamation_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager, SluggerInterface $slugger, EmailService $emailService): Response
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
            
            // Envoyer un email de confirmation
            try {
                $emailService->sendNewReclamationConfirmation($reclamation);
            } catch (\Exception $e) {
                // Log l'erreur mais ne pas bloquer le processus
                // Dans un environnement de production, vous pourriez utiliser un logger
                // $logger->error('Erreur d\'envoi d\'email: ' . $e->getMessage());
            }
            
            $this->addFlash('success', 'Complaint created successfully.');
            return $this->redirectToRoute('app_reclamation_index');
        }

        return $this->render('reclamation/new.html.twig', [
            'reclamation' => $reclamation,
            'form' => $form->createView(),
        ]);
    }
    #[Route('/update-status-simple/{id}', name: 'app_reclamation_update_status_simple', methods: ['POST'])]
    public function updateStatusSimple(Request $request, EntityManagerInterface $entityManager, int $id): Response
    {
        $reclamation = $entityManager->getRepository(Reclamation::class)->find($id);
    
        if (!$reclamation) {
            $this->addFlash('error', 'Complaint not found');
            return $this->redirectToRoute('app_reclamation_index');
        }
    
        $newStatus = $request->request->get('status');
        $validStatuses = ['Not Treated', 'In Progress', 'Resolved', 'Rejected'];
    
        if (!in_array($newStatus, $validStatuses)) {
            $this->addFlash('error', 'Invalid status');
            return $this->redirectToRoute('app_reclamation_show', ['id' => $id]);
        }
    
        $reclamation->setStatueOfReclamation($newStatus);
        $entityManager->flush();
    
        $this->addFlash('success', 'Status updated successfully!');
        return $this->redirectToRoute('app_reclamation_show', ['id' => $id]);
    }
    #[Route('/my-reclamations/{userId}', name: 'app_reclamation_my_list', methods: ['GET'])]
    public function myReclamations(
        Request $request,
        ReclamationRepository $reclamationRepository,
        PaginatorInterface $paginator,
        string $userId = null
    ): Response {
        // Create query builder
        $queryBuilder = $reclamationRepository->createQueryBuilder('r')
            ->orderBy('r.date', 'DESC');
        
        // If userId is provided in the route, filter by that user
        if ($userId) {
            $queryBuilder
                ->andWhere('r.userId = :userId')
                ->setParameter('userId', $userId);
        }
        
        // Paginate results (5 items per page)
        $pagination = $paginator->paginate(
            $queryBuilder->getQuery(),
            $request->query->getInt('page', 1),
            5
        );
        
        return $this->render('reclamation/my_reclamations.html.twig', [
            'reclamations' => $pagination,
            'error' => null,
            'searchTerm' => $userId // We'll use this to display the user ID in the template
        ]);
    }
    #[Route('/{id}', name: 'app_reclamation_show', methods: ['GET'], requirements: ['id' => '\d+'])]
    public function show(int $id, ReclamationRepository $reclamationRepository): Response
    {
        $reclamation = $reclamationRepository->findOneWithResponses($id);
        
        if (!$reclamation) {
            throw $this->createNotFoundException('The complaint does not exist');
        }
        
        return $this->render('reclamation/show.html.twig', [
            'reclamation' => $reclamation,
        ]);
    }

    #[Route('/show/{id}', name: 'app_reclamation_client', methods: ['GET'], requirements: ['id' => '\d+'])]
    public function showC(int $id, ReclamationRepository $reclamationRepository): Response
    {
        $reclamation = $reclamationRepository->findOneWithResponses($id);
        
        if (!$reclamation) {
            throw $this->createNotFoundException('The complaint does not exist');
        }
        
        return $this->render('reclamation/showC.html.twig', [
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

    // Add this new method to ReclamationController.php
#[Route('/{id}/respond', name: 'app_reclamation_respond', methods: ['GET'])]
public function respond(int $id, ReclamationRepository $reclamationRepository): Response
{
    $reclamation = $reclamationRepository->find($id);
    
    if (!$reclamation) {
        throw $this->createNotFoundException('The complaint does not exist');
    }
    
    return $this->redirectToRoute('app_reponse_reclamation_new_for_reclamation', [
        'id' => $id
    ]);
}
}