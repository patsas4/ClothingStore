<?php

namespace App\Controller\Api;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;

#[Route(path:"/api/customer", name:"")]
class CustomerController extends AbstractController
{
    #[Route(path:"/", name:"CreateCustomer", methods: ["POST"])]
    public function createCustomer(string $email, string $name)
    {

    }
}