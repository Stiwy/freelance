<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AccountController extends AbstractController
{
    #[Route('/mon_compte', name: 'app_account')]
    public function index(): Response
    {
        return $this->render('pages/account/index.html.twig', [
            'controller_name' => 'AccountController',
        ]);
    }
}
