<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class OwnerController extends AbstractController
{
    #[Route('/admin/connxexion', name: 'app_owner_login')]
    public function login(): Response
    {
        return $this->render('owner/index.html.twig', [
            'controller_name' => 'OwnerController',
        ]);
    }

    #[Route('/admin/deconnexion', name: 'app_owner_logout')]
    public function logout(): Response
    {
        return $this->render('owner/index.html.twig', [
            'controller_name' => 'OwnerController',
        ]);
    }

    #[Route('/admin/mot-de-passe-perdus', name: 'app_owner_forgot')]
    public function forgot(): Response
    {
        return $this->render('owner/index.html.twig', [
            'controller_name' => 'OwnerController',
        ]);
    }

    #[Route('/admin/desinscription', name: 'app_owner_unsubscribe')]
    public function unsubscribe(): Response
    {
        return $this->render('owner/index.html.twig', [
            'controller_name' => 'OwnerController',
        ]);
    }
}
