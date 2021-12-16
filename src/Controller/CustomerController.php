<?php

namespace App\Controller;

use App\Entity\Customer;
use App\Entity\User;
use App\Form\CustomerType;
use App\Repository\CustomerRepository;
use App\Repository\OwnerRepository;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Annotation\Route;

class CustomerController extends AbstractController
{
    #[Route('/clients', name: 'app_customer')]
    public function index(CustomerRepository $customerRepository): Response
    {
        $customers = $customerRepository->findAll();

        return $this->render('pages/customer/index.html.twig', compact('customers'));
    }

    #[Route('/clients/nouveau', name: 'app_customer_create')]
    public function create(Request $request, EntityManagerInterface $manager, OwnerRepository $ownerRepository, UserRepository $userRepository, UserPasswordHasherInterface $hasher): Response
    {
        $customer = new Customer();
        $form = $this->createForm(CustomerType::class, $customer);

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {
            $owner = $ownerRepository->findOneBy(['email' => $this->getUser()->getEmail()]);
            $customer = $form->getData();
            $customer->setOwner($owner);

            $emailExist = $userRepository->count(["email" => $customer->getEmail()]);

            if ($emailExist) {
                return $this->redirectToRoute('app_customer_create');
            }

            $user = new User();
            $user->setEmail($customer->getEmail());

            $password = $hasher->hashPassword($user,$customer->getEmail() . '&' . $owner->getId());
            $user->setPassword($password);
            $user->setRoles(["ROLE_CUSTOMER"]);
            $user->setCustomer($customer);
            $user->setFirstConnexion(true);

            $manager->persist($customer);
            $manager->persist($user);
            $manager->flush();

            return $this->redirectToRoute('app_customer_show', ['id' => $customer->getId()]);
        }

        return $this->render('pages/customer/form.html.twig', [
            'form' => $form->createView(),
            'title' => 'Créer un nouveau client'
        ]);
    }

    #[Route('/clients/{id}', name: 'app_customer_show')]
    public function show(Customer $customer): Response
    {
        return $this->render('pages/customer/show.html.twig', compact('customer'));
    }

    #[Route('/clients/editer/{id}', name: 'app_customer_update')]
    public function update(Customer $customer, EntityManagerInterface $manager, Request $request): Response
    {
        $form = $this->createForm(CustomerType::class, $customer);

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {
            $customer = $form->getData();

            $manager->persist($customer);
            $manager->flush();

            return $this->redirectToRoute('app_customer_show', ['id' => $customer->getId()]);
        }

        return $this->render('pages/customer/form.html.twig', [
            'form' => $form->createView(),
            'title' => 'Modifier un client'
        ]);
    }

    #[Route('/clients/supprimer/{id}', name: 'app_customer_delete')]
    public function delete(Customer $customer, EntityManagerInterface $manager): Response
    {
        $manager->remove($customer);
        $manager->flush();

        return $this->redirectToRoute('app_customer');
    }
}
