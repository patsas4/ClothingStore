<?php

namespace App\Controller;
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

    #[Route(path:"/getAll", name:"app_itemApi_getAll")]
    public function getAll(): Response 
    {
       try
       {
            $data = $this->json(ItemService::getAllItems($this->em));
       }
       catch (\Exception $e)
       {
            throw new \Exception($e->getMessage(), $e->getCode(), $e);
       }

       return $data;
    }
}