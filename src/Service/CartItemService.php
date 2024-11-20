<?php

namespace App\Service;
use App\Entity\Cart;
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
                $item = CartItemService::updateItemInCart($entityManager, $item);
                return $entityManager->getRepository(CartItem::class)->findBy(array('Cart' => $cart));
            }
        }    

        $cartItem = new CartItem();
        $cartItem->setCart( $cart );
        $cartItem->setQuantity( $quantity );
        $cartItem->setItem( ItemService::getItemById($entityManager, $itemId));

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
}