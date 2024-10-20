<?php

namespace App\Service;
use App\Entity\Cart;
use App\Entity\Item;
use App\Entity\CartItem;

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
        return $enitityManager->getRepository(CartItem::class)->findBy(array("CustomerId"=>$cart->getCustomer()->getCustomerId()));
    }
}