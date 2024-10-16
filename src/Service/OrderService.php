<?php

namespace App\Service;
use App\Entity\Customer;
use App\Entity\Order;
use DateTime;
class OrderService
{
    public static function getOrderByCustomerId($enitityManager, int $customerId)
    {
        return $enitityManager->getRepository(Order::class)->findOneBy(array("CustomerId"=>$customerId));
    }

    public static function createOrder($enitityManager, Customer $customer, DateTime $dateOrdered)
    {
        $order = new Order();
        $order->setCustomer($customer);
        $order->setDateOrdered($dateOrdered);

        $enitityManager->persist($order);
        $enitityManager->flush();
    }
}