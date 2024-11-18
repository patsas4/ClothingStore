<?php

namespace App\Service;
use App\Entity\Cart;
use App\Entity\Customer;
class CartService
{
    public static function getCartByCustomerId($entityManager, int $customerId)
    {
        return $entityManager->getRepository(Cart::class)->findOneBy(array('Customer' => $customerId));
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