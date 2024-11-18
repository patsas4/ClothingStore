<?php

namespace App\Service;
use App\Entity\Cart;
use App\Entity\Item;
use App\Entity\CartItem;
use Psr\Log\LoggerInterface;

class CartItemService
{
    public static function addCartItem($enitityManager, Cart $cart, Item $item, int $quantity = 1)
    {
        $cartItem = new CartItem();
        $cartItem->setCart( $cart );
        $cartItem->setQuantity( $quantity );
        $cartItem->setItem( $item );

        $enitityManager->persist($cartItem);
        $enitityManager->flush();
    }

    public static function removeCartItem($enitityManager, CartItem $cartItem)
    {
        $enitityManager->remove($cartItem);
        $enitityManager->flush();
    }

    public static function getCartItemsByCustomerId($enitityManager, int $customerId)
    {
        $cart = CartService::getCartByCustomerId($enitityManager, $customerId);        
        return $enitityManager->getRepository(CartItem::class)->findBy(array("Cart" => $cart->getCartId()));
    }

    public static function updateItemInCart($entityManager, CartItem $cartItem)
    {
        $entityManager->persist($cartItem);
        $entityManager->flush();
        return CartItemService::getByCartItemId($entityManager, $cartItem->getCartItemId());
    }

    public static function getByCartItemId($entityManager, int $cartItemId)
    {
        return $entityManager->getRepository(CartItem::class)->find($cartItemId);
    }
}