<?php

namespace App\Controller\Api;
use App\Service\ItemService;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;

#[Route(path:"/api/item", name:"itemController")]
class ItemController extends AbstractController
{

    #[Route(path:"/getAll", name:"itemApi_getAll")]
    public function getAll(EntityManagerInterface $em)
    {
       try
       {
            return $this->json(ItemService::getAllItems($em));
       }
       catch (\Exception $e)
       {
            echo $e;
       }
    }
}