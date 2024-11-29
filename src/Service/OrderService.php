<?php

namespace App\Service;
use App\Entity\Customer;
use App\Entity\Order;
use DateTime;
use Doctrine\ORM\EntityManagerInterface;
class OrderService
{
    public static function getOrderByOrderId(EntityManagerInterface $enitityManager, int $orderId)
    {
        return $enitityManager->getRepository(Order::class)->find($orderId);
    }

    public static function createOrder(EntityManagerInterface $enitityManager, Customer $customer)
    {
        $order = new Order();
        $order->setCustomer($customer);
        $order->setDateOrdered(new DateTime());
        $enitityManager->persist($order);
        $enitityManager->flush();

        $orderedItems = OrderedItemService::orderItems($enitityManager, $customer, $order);
        $total = 0.00;
        foreach ($orderedItems as $orderedItem)
        {
            $total += $orderedItem->getPrice();
        }

        $order->setTotal($total);
        $enitityManager->persist($order);
        $enitityManager->flush();

        CartItemService::removeItemsOrdered($enitityManager, $customer);

        return;
    }

    public static function getAllForCustomer(EntityManagerInterface $entityManagerInterface, Customer $customer)
    {
        return $entityManagerInterface->getRepository(Order::class)->findBy(array('Customer' => $customer), array('DateOrdered' => 'DESC'));
    }
}