<?php

namespace App\Controller;

use App\Service\CustomerService;
use Doctrine\ORM\EntityManagerInterface;
use Psr\Log\LoggerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class SecurityController extends AbstractController
{
    #[Route(path: '/login', name: 'app_login')]
    public function login(AuthenticationUtils $authenticationUtils, EntityManagerInterface $entityManagerInterface, Request $request): Response
    {
        //if ($this->getUser()) {
            //return $this->redirectToRoute('HomePage');
        //}

        // get the login error if there is one
        $error = $authenticationUtils->getLastAuthenticationError();
        // last username entered by the user
        $lastUsername = $authenticationUtils->getLastUsername();

        if($lastUsername && $error)
        {
            $customer = CustomerService::getCustomerByEmail($entityManagerInterface, $lastUsername);
            if (!$customer) 
            {
                return $this->redirectToRoute('app_register');
            }
        }

        if(!$links = $request->getSession()->get('links'))
        {
            $links = [];
        }

        return $this->render('security/login.html.twig', ['last_username' => $lastUsername, 'error' => $error, 'links' => $links]);
    }

    #[Route(path: '/logout', name: 'app_logout')]
    public function logout(): void
    {
        throw new \LogicException('This method can be blank - it will be intercepted by the logout key on your firewall.');
    }

    #[Route(path: '/check-login', name: 'check_login')]
    public function checkLogin()
    {
        return $this->json($this->getUser());
    }
}
