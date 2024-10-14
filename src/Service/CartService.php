<?php

namespace App\Service;
use App\Entities\Cart;
use App\Entities\Customer;
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