<?php

namespace Back\Service;
use Back\Entities\OrderedItem;
use Back\Entities\Order;
use Back\Entities\Item;
class OrderedItemService
{
    public static function createOrderedItem($entityManager, Order $order, Item $item, int $quantity)
    {
        $orderedItem = new OrderedItem();
        $orderedItem->setOrder($order);
        $orderedItem->setQuantity($quantity);
        $orderedItem->setItem($item);

        $entityManager->persist($orderedItem);
        $entityManager->flush();
    }

    public static function getAllByOrderId($enitityManager, int $orderId)
    {
        return $enitityManager->getRepository(OrderedItem::class)->findBy(array("OrderId"=>$orderId));
    }
}