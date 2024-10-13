<?php

namespace Back\Service;
use Back\Entities\Cart;
use Back\Entities\Customer;
class CartService
{
    public static function getCartByCustomerId($entityManager, int $customerId): Cart
    {
        return $entityManager->getRepository(Cart::class)->find(array("CustomerId"=>$customerId));
    }

    public static function createCart($enitityManager, Customer $customer): Cart
    {
        $cart = new Cart();
        $cart->setCustomer($customer);

        $enitityManager->persist($cart);
        $enitityManager->flush();

        return $cart;
    }
}