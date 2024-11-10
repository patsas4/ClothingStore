<?php

namespace App\Controller;

use App\Entity\Customer;
use App\Form\CustomerType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Routing\Annotation\Route;

class RegistrationController extends AbstractController
{
    #[Route('/register', name: 'app_register')]
    public function register(Request $request, UserPasswordHasherInterface $passwordHasher, EntityManagerInterface $entityManager): Response
    {
        $customer = new Customer();
        $form = $this->createForm(CustomerType::class, $customer);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            // Hash the plain password
            $hashedPassword = $passwordHasher->hashPassword(
                $customer,
                $form->get('password')->getData()
            );
            $customer->setPassword($hashedPassword);

            // Set any default roles
            $customer->setRoles(['ROLE_USER']);

            // Save the new user to the database
            $entityManager->persist($customer);
            $entityManager->flush();

            // Optionally, log the user in immediately after registration
            // return $this->redirectToRoute('app_login');
            return $this->redirectToRoute('app_login');
        }

        return $this->render('registration/register.html.twig', [
            'registrationForm' => $form->createView(),
            'links' => []
        ]);
    }
}
