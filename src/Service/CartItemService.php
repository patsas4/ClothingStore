<?php

namespace App\Service;
use App\Entity\Cart;
use App\Entity\Customer;
use App\Entity\Item;
use App\Entity\CartItem;
use Psr\Log\LoggerInterface;
use Doctrine\ORM\EntityManagerInterface;


class CartItemService
{
    public static function addCartItem(EntityManagerInterface $entityManager, int $itemId, int $quantity, Cart $cart)
    {
        $cartItems = $entityManager->getRepository(CartItem::class)->findBy(array('Cart' => $cart));
        foreach ($cartItems as $item) 
        {
            if ($item->getItem()->getItemId() == $itemId)
            {
                $item->setQuantity($item->getQuantity() + $quantity);
                $item->setPrice($item->getQuantity() * $item->getPrice());
                $item = CartItemService::updateItemInCart($entityManager, $item);
                return $entityManager->getRepository(CartItem::class)->findBy(array('Cart' => $cart));
            }
        }    

        $cartItem = new CartItem();
        $cartItem->setCart( $cart );
        $cartItem->setQuantity( $quantity );
        $cartItem->setItem( ItemService::getItemById($entityManager, $itemId));
        $cartItem->setPrice((float) $quantity * $cartItem->getItem()->getPrice());

        $entityManager->persist($cartItem);
        $entityManager->flush();

        return $entityManager->getRepository(CartItem::class)->findBy(array('Cart' => $cart));
    }

    public static function removeCartItem(EntityManagerInterface $entityManager, CartItem $cartItem)
    {
        $entityManager->remove($cartItem);
        $entityManager->flush();
    }

    public static function getCartItemsByCustomerId(EntityManagerInterface $entityManager, int $customerId)
    {
        $cart = CartService::getCartByCustomerId($entityManager, $customerId);        
        return $entityManager->getRepository(CartItem::class)->findBy(array("Cart" => $cart->getCartId()));
    }

    public static function updateItemInCart(EntityManagerInterface $entityManager, CartItem $cartItem)
    {
        $entityManager->persist($cartItem);
        $entityManager->flush();
        return CartItemService::getByCartItemId($entityManager, $cartItem->getCartItemId());
    }

    public static function getByCartItemId(EntityManagerInterface $entityManager, int $cartItemId)
    {
        return $entityManager->getRepository(CartItem::class)->find($cartItemId);
    }

    public static function deleteCartItem(EntityManagerInterface $entityManagerInterface, int $customerId, int $itemId)
    {
        $cart = CartService::getCartByCustomerId($entityManagerInterface, $customerId);
        $cartItem = CartItemService::getByCartandItemId($entityManagerInterface, $cart, $itemId);
        $entityManagerInterface->remove($cartItem);
        $entityManagerInterface->flush();
        return;
    }

    public static function getByCartandItemId(EntityManagerInterface $entityManagerInterface, Cart $cart, $itemId)
    {
        return $entityManagerInterface->getRepository(CartItem::class)->findOneBy(array('Cart' => $cart->getCartId(), 'Item' => $itemId));
    }

    public static function removeItemsOrdered(EntityManagerInterface $enitityManager, Customer $customer)
    {
        $cartItems = CartItemService::getCartItemsByCustomerId($enitityManager, $customer->getCustomerId());
        foreach ($cartItems as $cartItem)
        {
            $enitityManager->remove($cartItem);
        }

        $enitityManager->flush();
        return;
    }
}