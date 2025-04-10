<?php

namespace App\Controller;

use App\Repository\ReclamationRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class HomeBackController extends AbstractController
{
    #[Route('/home/back', name: 'app_home_back')]
    public function index(ReclamationRepository $reclamationRepository): Response
    {
        $totalReclamations = count($reclamationRepository->findAll());
        
        return $this->render('home_back/index.html.twig', [
            'controller_name' => 'HomeBackController',
            'total_reclamations' => $totalReclamations,
        ]);
    }
}
