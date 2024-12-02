<?php

namespace App\Controller;

use App\Entity\Category;
use App\Service\CategoryService;
use App\Service\ItemService;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ProductController extends AbstractController
{
    #[Route('/filter_products', methods:['post'])]
    public function filterProducts(Request $request, EntityManagerInterface $entityManagerInterface)
    {
        try
        {            
            if(!$categories = $request->getSession()->get('categories'))
            {
                $categories = CategoryService::getAllCategories($entityManagerInterface);
                $request->getSession()->set('categories', $categories);
            }
            if(!$priceRanges = $request->getSession()->get('price_ranges'))
            {
                $priceRanges = ItemService::$priceRanges;
                $request->getSession()->set('price_ranges', $priceRanges);
            }
            
            $selectedCategoryId = $_POST['category'] ?? null;
            $selectedPriceRange = $_POST['price'] ?? null;                        
            $filteredItems = ItemService::getFilteredItems($entityManagerInterface, $selectedCategoryId, $selectedPriceRange);                    

            if(!$links = $request->getSession()->get('links'))
            {
                $links = [];
            }

            return $this->render('Main/products.html.twig', ['items' => $filteredItems, 
            'links' => $links, 
            'categories' => $categories, 
            'price_ranges' => $priceRanges, 
            'selectedCategoryId' => $selectedCategoryId
            ]);
        }
        catch (\Exception $e)
        {
            return new Response($e, Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    #[Route(path:"/products", name:"Products")]
    public function ProductsPage(Request $request, EntityManagerInterface $entityManagerInterface)
    {
        try
        {
            if(!$categories = $request->getSession()->get('categories'))
            {
                $categories = CategoryService::getAllCategories($entityManagerInterface);
                $request->getSession()->set('categories', $categories);
            }
            if(!$priceRanges = $request->getSession()->get('price_ranges'))
            {
                $priceRanges = ItemService::$priceRanges;
                $request->getSession()->set('price_ranges', $priceRanges);
            }
            if(!$links = $request->getSession()->get('links'))
            {
                $links = [];
            }            

            return $this->render("Main/products.html.twig", [
                "links" => $links, 
                'categories' => $categories, 
                'price_ranges' => $priceRanges, 
                'items' => ItemService::getAllItems($entityManagerInterface), 
                'selectedCategoryId' => Category::None
            ]);
        }
        catch(\Exception $e)
        {
            return new Response($e, Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}