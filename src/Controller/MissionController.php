<?php

namespace App\Controller;

use App\Entity\Mission;
use App\Form\MissionType;
use App\Repository\MissionRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MissionController extends AbstractController
{
    #[Route('/missions', name: 'app_mission')]
    public function index(MissionRepository $missionRepository): Response
    {
        $missions = $missionRepository->findAll();

        return $this->render('pages/mission/index.html.twig', [
            'missions' => $missions,
        ]);
    }

    #[Route('/missions/ajouter', name: 'app_mission_create')]
    public function create(Request $request, EntityManagerInterface $manager): Response
    {
        $mission = new Mission();
        $form = $this->createForm(MissionType::class, $mission);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $mission = $form->getData();

            $mission->setInsertDate(new \DateTime());

            $manager->persist($mission);
            $manager->flush();

            return $this->redirectToRoute('app_mission');
        }

        return $this->render('pages/mission/form.html.twig', [
            'form' => $form->createView(),
            'title' => 'Créer une mission'
        ]);
    }
}
