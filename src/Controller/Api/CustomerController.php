<?php

namespace App\Controller\Api;
use Doctrine\ORM\EntityManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;
use Doctrine\ORM\EntityManagerInterface;


#[Route(path:"/api/customer", name:"")]
class CustomerController extends AbstractController
{
    #[Route(path:"/get", name:"get_customer")]
    public function getCustomer(EntityManagerInterface $entityManagerInterface, string $email)
    {

    }
}