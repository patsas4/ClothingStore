<?php

namespace App\Service;
use App\Entity\Customer;
use App\Entity\OrderedItem;
use App\Entity\Order;
use App\Entity\Item;
use Doctrine\ORM\EntityManagerInterface;
class OrderedItemService
{
    public static function createOrderedItem($entityManager, Order $order, Item $item, int $quantity)
    {
        $orderedItem = new OrderedItem();
        $orderedItem->setOrder($order);
        $orderedItem->setQuantity($quantity);
        $orderedItem->setItem($item);
        $orderedItem->setPrice((float) $quantity * $item->getPrice());

        $entityManager->persist($orderedItem);
        $entityManager->flush();

        return $orderedItem;
    }

    public static function getAllByOrderId(EntityManagerInterface $enitityManager, int $orderId)
    {
        return $enitityManager->getRepository(OrderedItem::class)->findBy(array('Order' => $orderId));
    }

    public static function orderItems(EntityManagerInterface $enitityManager, Customer $customer, Order $order)
    {
        $cartItems = CartItemService::getCartItemsByCustomerId($enitityManager, $customer->getCustomerId());
        foreach ($cartItems as $cartItem) 
        {
            OrderedItemService::createOrderedItem($enitityManager, $order, $cartItem->getItem(), $cartItem->getQuantity());
        }

        return OrderedItemService::getAllByOrderId($enitityManager, $order->getOrderId());
    }
}