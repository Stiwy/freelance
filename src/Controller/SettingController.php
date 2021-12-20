<?php

namespace App\Controller;

use App\Repository\MissionRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class SettingController extends AbstractController
{
    #[Route('/setting', name: 'app_setting')]
    public function index(MissionRepository $missionRepository): Response
    {
        dd($this->getUser());

        return $this->render('pages/account/setting/index.html.twig', [
        ]);
    }
}
