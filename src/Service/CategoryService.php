<?php

namespace App\Service;
use App\Entities\Category;
class CategoryService
{
    public static function getAllCategories($enitityManager)
    {
        return $enitityManager->getRepository(Category::class)->findAll();
    }

    public static function createCategory($enitityManager, string $categoryName)
    {
        $category = new Category();
        $category->setCategoryName($categoryName);

        $enitityManager->persist($category);
        $enitityManager->flush();
    }
}