<?php

namespace App\Controller;

use App\Entity\Mission;
use App\Form\MissionType;
use App\Repository\CustomerRepository;
use App\Repository\MissionRepository;
use App\Repository\MissionStatusRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MissionController extends AbstractController
{
    #[Route('/missions', name: 'app_mission')]
    public function index(MissionRepository $missionRepository, MissionStatusRepository $missionStatusRepository): Response
    {
        $missions = $missionRepository->findAll();
        $missionStatuses = $missionStatusRepository->findAll();

        return $this->render('pages/mission/index.html.twig', [
            'missions' => $missions,
            'missionStatuses' => $missionStatuses,
        ]);
    }

    #[Route('/missions/ajouter', name: 'app_mission_create')]
    public function create(Request $request, EntityManagerInterface $manager, CustomerRepository $customerRepository, MissionStatusRepository $missionStatusRepository): Response
    {
        $customersOptions = [];
        $customers = $customerRepository->findBy(['owner' => $this->getUser()->getOwner()]);
        foreach ($customers as $customer) {
            $customersOptions[$customer->getFirstname() . ' ' . $customer->getLastname() . ' | ' . $customer->getEmail()] = $customer;
        }

        $missionStatusOptions = [];
        $missionStatuses = $missionStatusRepository->findBy(['owner' => $this->getUser()->getOwner()]);
        foreach ($missionStatuses as $missionStatus) {
            $missionStatusOptions[$missionStatus->getStatus()] = $missionStatus;
        }

        $mission = new Mission();
        $form = $this->createForm(MissionType::class, $mission, [
            'customers' => $customersOptions,
            'missionStatus' => $missionStatusOptions
        ]);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $mission = $form->getData();

            $mission->setInsertDate(new \DateTime());

            $manager->persist($mission);
            $manager->flush();

            return $this->redirectToRoute('app_mission');
        }

        return $this->renderForm('pages/mission/form.html.twig', [
            'form' => $form,
            'title' => 'Créer une mission'
        ]);
    }

    #[Route('/missions/change_statut/{id}', name: 'app_mission_update_status', requirements: ["id"=>"\d+"], methods: ['POST','HEAD'])]
    public function updateStatus(Request $request, Mission $mission, int $id, EntityManagerInterface $manager, MissionStatusRepository $missionStatusRepository): Response
    {
        if ($mission->getCustomer()->getOwner()->getId() !== $this->getUser()->getOwner()->getId()) {
            throw $this->createNotFoundException('La mission demandé n\'existe pas');
        }

        $status = $request->get("missionStatus-$id");
        $missionStatus = $missionStatusRepository->findOneBy(['status' => $status]);

        if ($missionStatus) {
            $mission->setMissionStatus($missionStatus);

            $manager->flush();
        }

        return $this->redirectToRoute('app_mission');
    }

    #[Route('/missions/{id}', name: 'app_mission_show', requirements: ["id"=>"\d+"], methods: ['GET','HEAD'])]
    public function show(Mission $mission): Response
    {

        if ($mission->getCustomer()->getOwner()->getId() !== $this->getUser()->getOwner()->getId()) {
            throw $this->createNotFoundException('La mission demandé n\'existe pas');
        }

        return $this->renderForm('pages/mission/show.html.twig', compact('mission'));
    }

    #[Route('/missions/editer/{id}', name: 'app_mission_update', requirements: ["id"=>"\d+"], methods: ['GET','HEAD'])]
    public function update(Mission $mission): Response
    {
        return $this->renderForm('pages/mission/show.html.twig', compact('mission'));
    }
}
