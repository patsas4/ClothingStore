<?php

namespace App\Controller;
use App\Entity\CartItem;
use App\Entity\Customer;
use App\Service\CartItemService;
use App\Service\CartService;
use App\Service\ItemService;
use App\Service\OrderedItemService;
use App\Service\OrderService;
use Psr\Log\LoggerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\ErrorHandler\ErrorHandler;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\EntityManagerInterface;

class OrderController extends AbstractController
{
    #[Route('/order', name:'order', methods:['post'])]
    public function Order(EntityManagerInterface $entityManagerInterface)
    {

            $user = $this->getUser();
            OrderService::createOrder($entityManagerInterface, $user);
            return new RedirectResponse('/show_order');


    }

    #[Route('/show_order', name:'show_order')]
    public function showOrder(Request $request, EntityManagerInterface $entityManagerInterface)
    {
        try
        {
            if(!$user = $this->getUser())
            {
                $request->getSession()->set('redirect','/cart');                
                return new RedirectResponse('/login');
            }

            if(!$links = $request->getSession()->get('links'))
            {
                $links = [];
            }
            
            $orders = OrderService::getAllForCustomer($entityManagerInterface, $user);
            return $this->render('Main/order.html.twig', ['orders' => $orders, 'links' => $links]);            
        }
        catch (\Exception $e)
        {
            return new Response($e, Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}