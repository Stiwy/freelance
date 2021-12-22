<?php

namespace App\Controller;

use App\Entity\MissionStatus;
use App\Form\MissionStatusType;
use App\Repository\OwnerRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MissionStatusController extends AbstractController
{
    #[Route('/mission/status', name: 'app_mission_status_create')]
    public function index(Request $request, EntityManagerInterface $manager, OwnerRepository $ownerRepository): Response
    {

        $missionStatus = new MissionStatus();
        $form = $this->createForm(MissionStatusType::class, $missionStatus);

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {
            $owner = $ownerRepository->findOneBy(['email' => $this->getUser()->getEmail()]);

            $missionStatus = $form->getData();
            $missionStatus->setInsertDate(new \DateTime());
            $missionStatus->setOwner($owner);

            $manager->persist($missionStatus);
            $manager->flush();

            return $this->redirectToRoute('app_setting');
        }

        return $this->renderForm('pages/account/setting/mission_status/form.html.twig', [
            'form' => $form,
        ]);
    }

    #[Route('/mission/status/editer/{id}', name: 'app_mission_status_update')]
    public function update(Request $request, EntityManagerInterface $manager, OwnerRepository $ownerRepository, MissionStatus $missionStatus): Response
    {
        $form = $this->createForm(MissionStatusType::class, $missionStatus);

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {
            $owner = $ownerRepository->findOneBy(['email' => $this->getUser()->getEmail()]);

            $missionStatus = $form->getData();

            $manager->flush();

            return $this->redirectToRoute('app_setting');
        }

        return $this->renderForm('pages/account/setting/mission_status/form.html.twig', [
            'form' => $form,
        ]);
    }

    #[Route('/mission/status/supprimer/{id}', name: 'app_mission_status_delete')]
    public function delete(MissionStatus $missionStatus, EntityManagerInterface $manager): Response
    {
        $manager->remove($missionStatus);
        $manager->flush();

        return $this->redirectToRoute('app_setting');
    }
}
