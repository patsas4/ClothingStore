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
            if(!$cart = $request->getSession()->get('cart'))
            {
                $storedItems = CartItemService::getCartItemsByCustomerId($entityManagerInterface, $user->getCustomerId());
                $cart = $storedItems ?? [];
            }
            $newItemId = $_POST['itemId'];
            $logger->info($newItemId);
            $updated = false;
            foreach ($cart as $item) 
            {
                if ($item->getItemId() == $newItemId)
                {
                    $item->setQuantity($item->getQuantity() + $_POST['quantity']);
                    $item = CartItemService::updateItemInCart($entityManagerInterface, $item);
                    $updated = true;
                    break;
                }
            }    
            
            if(!$updated)
            {
                
            }
            return $this->render('Main/cart.html.twig', ['links' => []]);
        }
        catch (\Exception $e)
        {
            return new Response($e, Response::HTTP_INTERNAL_SERVER_ERROR);
        }
        
    }
}