<?php

namespace App\Controller;

use App\Entity\ReponseReclamation;
use App\Form\ReponseReclamationType;
use App\Entity\Reclamation;

use App\Repository\ReponseReclamationRepository;
use App\Service\ReponseReclamationService;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\String\Slugger\SluggerInterface;
use Symfony\Component\HttpFoundation\File\Exception\FileException;

#[Route('/reponse/reclamation')]
class ReponseReclamationController extends AbstractController
{
    private $reponseReclamationService;

    public function __construct(ReponseReclamationService $reponseReclamationService)
    {
        $this->reponseReclamationService = $reponseReclamationService;
    }

    #[Route('/', name: 'app_reponse_reclamation_index', methods: ['GET'])]
    public function index(EntityManagerInterface $entityManager): Response
    {
        $reponseReclamations = $entityManager->getRepository(ReponseReclamation::class)
            ->createQueryBuilder('r')
            ->leftJoin('r.reclamation', 'reclamation')
            ->addSelect('reclamation')
            ->orderBy('r.date', 'DESC')
            ->getQuery()
            ->getResult();
            
        return $this->render('reponse_reclamation/index.html.twig', [
            'reponse_reclamations' => $reponseReclamations,
        ]);
    }

    #[Route('/new', name: 'app_reponse_reclamation_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager, SluggerInterface $slugger): Response
    {
        $reponseReclamation = new ReponseReclamation();
        $reponseReclamation->setDate(new \DateTime());
        $reponseReclamation->setStatueOfReponseReclamation('Pending');
        
        $form = $this->createForm(ReponseReclamationType::class, $reponseReclamation);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            try {
                // Gestion du fichier PDF
                $pdfFile = $form->get('pdfFile')->getData();
                if ($pdfFile) {
                    $originalFilename = pathinfo($pdfFile->getClientOriginalName(), PATHINFO_FILENAME);
                    $safeFilename = $slugger->slug($originalFilename);
                    $newFilename = $safeFilename.'-'.uniqid().'.'.$pdfFile->guessExtension();

                    try {
                        $pdfFile->move(
                            $this->getParameter('reponse_pdfs_directory'),
                            $newFilename
                        );
                        $reponseReclamation->setPdfPath($newFilename);
                    } catch (FileException $e) {
                        $this->addFlash('error', 'An error occurred while uploading the PDF file');
                        return $this->renderForm('reponse_reclamation/new.html.twig', [
                            'reponse_reclamation' => $reponseReclamation,
                            'form' => $form,
                        ]);
                    }
                }

                // Use service to add the response
                if ($this->reponseReclamationService->addReponseReclamation($reponseReclamation)) {
                    $this->addFlash('success', 'The complaint response has been created successfully');
                    return $this->redirectToRoute('app_reponse_reclamation_index', [], Response::HTTP_SEE_OTHER);
                } else {
                    $this->addFlash('error', 'An error occurred while creating the response');
                }
            } catch (\Exception $e) {
                $this->addFlash('error', 'An error occurred: ' . $e->getMessage());
            }
        }

        return $this->renderForm('reponse_reclamation/new.html.twig', [
            'reponse_reclamation' => $reponseReclamation,
            'form' => $form,
        ]);
    }

    #[Route('/new/{id}', name: 'app_reponse_reclamation_new_for_reclamation', methods: ['GET', 'POST'])]
    public function newForReclamation(Request $request, int $id, EntityManagerInterface $entityManager): Response
    {
        $reclamation = $entityManager->getRepository(Reclamation::class)->find($id);
        
        if (!$reclamation) {
            throw $this->createNotFoundException('The complaint does not exist');
        }
    
        $reponseReclamation = new ReponseReclamation();
        $reponseReclamation->setReclamation($reclamation);
        $reponseReclamation->setIdUser(1);
        $reponseReclamation->setIdReceiver($reclamation->getUserId());
        $reponseReclamation->setDate(new \DateTime());
        $reponseReclamation->setStatueOfReponseReclamation('Pending');
    
        $form = $this->createForm(ReponseReclamationType::class, $reponseReclamation);
        $form->handleRequest($request);
    
        if ($form->isSubmitted() && $form->isValid()) {
            // Only change status if it's currently "Not Treated"
            if ($reclamation->getStatueOfReclamation() === 'Not Treated') {
                $reclamation->setStatueOfReclamation('In Progress');
                $entityManager->persist($reclamation);
            }
            
            $entityManager->persist($reponseReclamation);
            $entityManager->flush();
    
            $this->addFlash('success', 'Response created successfully');
            return $this->redirectToRoute('app_reclamation_show', ['id' => $id]);
        }
    
        return $this->render('reponse_reclamation/new.html.twig', [
            'reponse_reclamation' => $reponseReclamation,
            'form' => $form->createView(),
            'reclamation' => $reclamation,
        ]);
    }

    #[Route('/{id}', name: 'app_reponse_reclamation_show', methods: ['GET'])]
    public function show(ReponseReclamation $reponseReclamation): Response
    {
        return $this->render('reponse_reclamation/show.html.twig', [
            'reponse_reclamation' => $reponseReclamation,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_reponse_reclamation_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, ReponseReclamation $reponseReclamation, EntityManagerInterface $entityManager, SluggerInterface $slugger): Response
    {
        $form = $this->createForm(ReponseReclamationType::class, $reponseReclamation);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // Gestion du fichier PDF
            $pdfFile = $form->get('pdfFile')->getData();
            if ($pdfFile) {
                $originalFilename = pathinfo($pdfFile->getClientOriginalName(), PATHINFO_FILENAME);
                $safeFilename = $slugger->slug($originalFilename);
                $newFilename = $safeFilename.'-'.uniqid().'.'.$pdfFile->guessExtension();

                try {
                    $pdfFile->move(
                        $this->getParameter('reponse_pdfs_directory'),
                        $newFilename
                    );
                    
                    // Supprimer l'ancien fichier si nécessaire
                    if ($reponseReclamation->getPdfPath()) {
                        $oldPdfPath = $this->getParameter('reponse_pdfs_directory') . '/' . $reponseReclamation->getPdfPath();
                        if (file_exists($oldPdfPath)) {
                            unlink($oldPdfPath);
                        }
                    }
                    
                    $reponseReclamation->setPdfPath($newFilename);
                } catch (FileException $e) {
                    $this->addFlash('error', 'An error occurred while uploading the PDF file');
                }
            }

            // Use service to update the response
            if ($this->reponseReclamationService->updateReponseReclamation($reponseReclamation)) {
                $this->addFlash('success', 'The complaint response has been updated successfully');
                return $this->redirectToRoute('app_reponse_reclamation_index', [], Response::HTTP_SEE_OTHER);
            } else {
                $this->addFlash('error', 'An error occurred while updating the response');
            }
        }

        return $this->render('reponse_reclamation/edit.html.twig', [
            'reponse_reclamation' => $reponseReclamation,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_reponse_reclamation_delete', methods: ['POST'])]
    public function delete(Request $request, ReponseReclamation $reponseReclamation, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$reponseReclamation->getId(), $request->request->get('_token'))) {
            // Supprimer le fichier PDF si nécessaire
            if ($reponseReclamation->getPdfPath()) {
                $pdfPath = $this->getParameter('reponse_pdfs_directory') . '/' . $reponseReclamation->getPdfPath();
                if (file_exists($pdfPath)) {
                    unlink($pdfPath);
                }
            }
            
            // Use service to delete the response
            if ($this->reponseReclamationService->deleteReponseReclamation($reponseReclamation->getId())) {
                $this->addFlash('success', 'The complaint response has been deleted successfully');
            } else {
                $this->addFlash('error', 'An error occurred while deleting the response');
            }
        }

        return $this->redirectToRoute('app_reponse_reclamation_index', [], Response::HTTP_SEE_OTHER);
    }
}
