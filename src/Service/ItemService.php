<?php

namespace App\Service;
use App\Entity\Item;
use App\Entity\Category;
use App\Entity\Fit;
use Doctrine\ORM\EntityManagerInterface;
class ItemService
{
    public static $PriceRangeIds = [
        'None' => 0,
        'LowToHigh' => 1,
        'HighToLow' => 2
    ];

    public static $priceRanges = array(
        ['Id' => 0, 'Value' => 'None'],
        ['Id' => 1, 'Value' => 'Low to High'],  
        ['Id' => 2, 'Value' => 'High to Low']  
    );

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
        $item->setCategory($category);
        $item->setFit($fit);

        $entityManager->persist($item);
        $entityManager->flush();

        return ItemService::getItemById($entityManager, $item->getItemId());
    }

    public static function getFilteredItems(EntityManagerInterface $entityManagerInterface, int|null $selectedCategoryId, int|null $selectedPriceRange)
    {

        $filter = null;
        switch ($selectedPriceRange)
        {
            case ItemService::$PriceRangeIds['None']:
                $filter = null;
                break;

            case ItemService::$PriceRangeIds['LowToHigh']:
                $filter = array('Price' => 'ASC');
                break;
            
            case ItemService::$PriceRangeIds['HighToLow']:
                $filter = array('Price' => 'DESC');
                break;
        }

        if ($selectedCategoryId == Category::None)
        {
            return $entityManagerInterface->getRepository(Item::class)->findBy(array(), $filter);
        }

        return $entityManagerInterface->getRepository(Item::class)->findBy(array('Category' => $selectedCategoryId), $filter);
    }   
}