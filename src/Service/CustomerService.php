<?php

namespace App\Service;
use App\Entity\Customer;
class CustomerService
{
    public static function createCustomer($enitityManager, Customer $customer) 
    {                
        $enitityManager->persist($customer);
        $enitityManager->flush();

        $cart = CartService::createCart($enitityManager, $customer);

        return array('customer' => $customer, 'cart' => $cart);
    }

    public static function deleteCustomer($enitityManager, Customer $customer) 
    {
        $enitityManager->remove($customer);
        $enitityManager.flush();
    }

    public static function getCustomerById($enitityManager, int $customerId)
    {
        return $enitityManager->getRespository(Customer::class)->find($customerId);
    }

    public static function getCustomerByEmail($enitityManager, string $email)
    {
        return $enitityManager->getRepository(Customer::class)->findOneBy(array("Email"=> $email));
    }

    public static function verifyLogin($enitityManager, string $email, string $password)
    {
        $customer = CustomerService::getCustomerByEmail($enitityManager, $email);
        if ($customer && $customer->getPassword() !== $password) 
        {
            return true;
        }
        else if (!$customer) 
        {
            return false;
        }
        return $customer;
    }
}