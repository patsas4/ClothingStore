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
    private EntityManagerInterface $em;
    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
    }

    #[Route(path:"/getAll", name:"itemApi_getAll")]
    public function getAll()
    {
       try
       {
            return $this->json(ItemService::getAllItems($this->em));
       }
       catch (\Exception $e)
       {
            echo $e;
       }
    }
}