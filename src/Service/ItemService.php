<?php

namespace App\Service;
use App\Entities\Item;
use App\Entities\Category;
use App\Entities\Fit;
class ItemService
{
    public static function getAllItems($entityManager)
    {
        return $entityManager->getRepository(Item::class)->findAll();
    }

    public static function getItemById($entityManager, int $itemId)
    {
        return $entityManager->find(Item::class, $itemId);
    }

    public static function getAllByFit($entityManager, int $fitId)
    {
        return $entityManager->getRepository(Item::class)->findBy(array("FitId"=>$fitId));
    }

    public static function getAllByCategory($entityManager, int $categoryId)
    {
        return $entityManager->getRepository(Item::class)->findBy(array("CategoryId"=>$categoryId));
    }

    public static function createItem($entityManager, string $itemName, Category $category, Fit $fit, float $price)
    {
        $item = new Item();
        $item->setItemName($itemName);
        $item->setCategory($category);
        $item->setFit($fit);
        $item->setPrice($price);
        $item->setCategoryId($category->getCategoryId());
        $item->setFitId($fit->getFitId());

        $entityManager->persist($item);
        $entityManager->flush();

        return ItemService::getItemById($entityManager, $item->getItemId());
    }
}