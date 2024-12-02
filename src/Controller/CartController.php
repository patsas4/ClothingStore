<?php

namespace App\Controller;
use App\Entity\CartItem;
use App\Entity\Customer;
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
    #[Route('/addToCart', name:'add_to_cart')]
    public function addToCart(Request $request, EntityManagerInterface $entityManagerInterface, LoggerInterface $logger)
    {
        try
        {
            if(!$user = $this->getUser())
            {
                $request->getSession()->set('redirect','/addToCart');    
                $request->getSession()->set('newItemId', $_POST['itemId']);            
                $request->getSession()->set('quantity', $_POST['quantity']);            
                return new RedirectResponse('/login');
            } 
            
            $cartItems = CartItemService::getCartItemsByCustomerId($entityManagerInterface, $user->getCustomerId());
            if (!$newItemId = $request->getSession()->get('newItemId'))
            {
                $newItemId = $_POST['itemId'];
            }
            else
            {
                $request->getSession()->remove('newItemId');
            }
            if (!$quantity = $request->getSession()->get('quantity'))
            {
                $quantity = $_POST['quantity'];
            }
            else
            {
                $request->getSession()->remove('quantity');
            }
            
            $userCart = CartService::getCartByCustomerId($entityManagerInterface, $user->getCustomerId());
            $cartItems = CartItemService::addCartItem($entityManagerInterface, $newItemId, $quantity, $userCart);

            $request->getSession()->set('cartItems', $cartItems);

            return new RedirectResponse('/cart');
        }
        catch (\Exception $e)
        {
            return new Response($e, Response::HTTP_INTERNAL_SERVER_ERROR);
        }
        
    }

    #[Route('/cart', name: 'display_cart')]
    public function displayCart(Request $request, EntityManagerInterface $entityManagerInterface)
    {
        try
        {
            if(!$user = $this->getUser())
            {
                $request->getSession()->set('redirect','/cart');                
                return new RedirectResponse('/login');
            }

            $cartItems = CartItemService::getCartItemsByCustomerId($entityManagerInterface, $user->getCustomerId());

            if(!$links = $request->getSession()->get('links'))
            {
                $links = [];
            }
            $total = 0.00;
            foreach($cartItems as $cartItem)
            {
                $total += $cartItem->getPrice();
            }
            return $this->render('Main/cart.html.twig', ['links' => $links, 'items' => $cartItems, 'total' => $total]);
        }
        catch (\Exception $e)
        {
            return new Response($e, Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    #[Route('/delete', name: 'delete_item')]
    public function deleteItem(EntityManagerInterface $entityManagerInterface)
    {
        try
        {
            $itemId = $_POST['itemId'];            
            CartItemService::deleteCartItem($entityManagerInterface, $this->getUser()->getCustomerId(), $itemId);
            return new RedirectResponse('/cart');
        }
        catch(\Exception $e)
        {
            return new Response($e, Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}