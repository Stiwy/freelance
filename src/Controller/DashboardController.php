<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DashboardController extends AbstractController
{
    #[Route('/tableau_de_bord', name: 'app_dashboard')]
    public function index(): Response
    {
        return $this->render('pages/dashboard/index.html.twig', [
            'controller_name' => 'DashboardController',
        ]);
    }
}
