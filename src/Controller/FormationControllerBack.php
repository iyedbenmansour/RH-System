<?php

namespace App\Controller;

use App\Entity\Formation;
use App\Form\FormationType;
use App\Repository\EventRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/formationBack')]
class FormationControllerBack extends AbstractController
{
    #[Route('/', name: 'app_formation_index_back', methods: ['GET'])]
    public function index(EntityManagerInterface $entityManager): Response
    {
        $formations = $entityManager
            ->getRepository(Formation::class)
            ->findAll();

        return $this->render('formationBack/index.html.twig', [
            'formations' => $formations,
        ]);
    }

    #[Route('/new/{eventId}', name: 'app_formation_new_back', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager, EventRepository $eventRepository, int $eventId): Response
    {
        // Find the event to which the formation will be linked
        $event = $eventRepository->find($eventId);
    
        if (!$event) {
            throw $this->createNotFoundException('Event not found');
        }
    
        // Create a new Formation object
        $formation = new Formation();
        $form = $this->createForm(FormationType::class, $formation);
        $form->handleRequest($request);
    
        if ($form->isSubmitted() && $form->isValid()) {
            // Persist the new formation
            $entityManager->persist($formation);
            $entityManager->flush();
    
            // Update the related event with the new formation ID
            $event->setHasFormation(true);
            $event->setFormationId($formation->getId()); // Link the event to the formation
    
            // Persist the updated event
            $entityManager->flush();
    
            // Redirect back to the formation index or event details, passing the eventId
            return $this->redirectToRoute('app_formation_new_back', ['eventId' => $eventId], Response::HTTP_SEE_OTHER);
        }
    
        return $this->render('formationBack/show.html.twig', [
            'formation' => $formation,
            'form' => $form->createView(),
        ]);
    }
    
    #[Route('/{id}', name: 'app_formation_show_back', methods: ['GET'])]
    public function show(Formation $formation): Response
    {
        return $this->render('formationBack/show.html.twig', [
            'formation' => $formation,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_formation_edit_back', methods: ['GET', 'POST'])]
public function edit(Request $request, Formation $formation, EntityManagerInterface $entityManager): Response
{
    $form = $this->createForm(FormationType::class, $formation);
    $form->handleRequest($request);

    if ($form->isSubmitted() && $form->isValid()) {
        $entityManager->flush();

        // Redirect to the show page after saving
        return $this->redirectToRoute('app_formation_show_back', ['id' => $formation->getId()], Response::HTTP_SEE_OTHER);
    }

    return $this->render('formationBack/edit.html.twig', [
        'formation' => $formation,
        'form' => $form->createView(),
    ]);
}

    #[Route('/{id}', name: 'app_formation_delete_back', methods: ['POST'])]
    public function delete(Request $request, Formation $formation, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$formation->getId(), $request->request->get('_token'))) {
            $entityManager->remove($formation);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_formation_index_back', [], Response::HTTP_SEE_OTHER);
    }
}