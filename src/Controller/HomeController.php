<?php

// src/Controller/HomeController.php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    #[Route('/', name: 'app_home')]
    public function index(): Response
    {
        return $this->render('home/index.html.twig');
    }

    #[Route('/event/', name: 'admin_dashboard')]
    public function adminDashboard(): Response
    {
        return $this->render('event/index.html.twig');
    }

    #[Route('/event/', name: 'user_dashboard')]
    public function userDashboard(): Response
    {
        return $this->render('event/index.html.twig');
    }
}


