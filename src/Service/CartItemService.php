<?php

namespace Back\Service;
use Back\Entities\Cart;
use Back\Entities\Item;
use Back\Entities\CartItem;

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