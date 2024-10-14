<?php

namespace App\Service;
use App\Entity\Customer;
class CustomerService
{
    public static function createCustomer($enitityManager, string $firstName, string $lastName, string $email, string $password) 
    {
        $customer = new Customer();
        $customer->setFirstName($firstName);
        $customer->setLastName($lastName);
        $customer->setEmail($email);
        $customer->setPassword($password);
        
        $enitityManager->persist($customer);
        $enitityManager->flush();

        CartService::createCart($enitityManager, $customer);
    }

    public static function deleteCustomer($enitityManager, Customer $customer) 
    {
        $enitityManager->remove($customer);
        $enitityManager.flush();
    }

    public static function getCustomerById($enitityManager, int $customerId): Customer
    {
        return $enitityManager->getRespository(Customer::class)->find($customerId);
    }

    public static function getCustomerByEmail($enitityManager, string $email): Customer 
    {
        return $enitityManager->getRespository(Customer::class)->findOneBy(array("email"=> $email));
    }

    public static function verifyLogin($enitityManager, string $email, string $password): Customer|bool
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