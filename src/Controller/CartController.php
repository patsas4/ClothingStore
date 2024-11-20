<?php

namespace App\Controller;
use App\Entity\CartItem;
use App\Service\CartItemService;
use App\Service\CartService;
use App\Service\ItemService;
use Psr\Log\LoggerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\ErrorHandler\ErrorHandler;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\EntityManagerInterface;

class CartController extends AbstractController
{
    #[Route('/addToCart', methods:['post'], name:'add_to_cart')]
    public function addToCart(Request $request, EntityManagerInterface $entityManagerInterface, LoggerInterface $logger)
    {
        try
        {
            if(!$user = $this->getUser())
            {
                $request->getSession()->set('redirect','/addToCart');                
                return new RedirectResponse('/login');
            } 
            if(!$cartItems = $request->getSession()->get('cart'))
            {
                $storedItems = CartItemService::getCartItemsByCustomerId($entityManagerInterface, $user->getCustomerId());
                $cartItems = $storedItems ?? [];
            }
            $newItemId = $_POST['itemId'];
            $logger->info($newItemId);
            
            $userCart = CartService::getCartByCustomerId($entityManagerInterface, $user->getCustomerId());
            $cartItems = CartItemService::addCartItem($entityManagerInterface, $newItemId, $_POST['quantity'], $userCart);

            $request->getSession()->set('cartItems', $cartItems);

            if(!$links = $request->getSession()->get('links'))
            {
                $links = [];
            }
            return $this->render('Main/cart.html.twig', ['links' => $links, 'items' => $cartItems]);
        }
        catch (\Exception $e)
        {
            return new Response($e, Response::HTTP_INTERNAL_SERVER_ERROR);
        }
        
    }
}