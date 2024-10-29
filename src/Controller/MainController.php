<?php

namespace App\Controller;
use App\Service\ItemService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\ErrorHandler\ErrorHandler;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Link;
use Doctrine\ORM\EntityManagerInterface;

class MainController extends AbstractController
{
    private EntityManagerInterface $em;
  
    public $links;
    
    public function __construct(EntityManagerInterface $em)
    {
        $this->links = [
            new Link("/", "Home"),
            new Link("/products","Products"),
            new Link("/account","Account")
        ];
        $this->em = $em;
    }

    public function filterLinks(string $name)
    {
        return array_filter($this->links, function (Link $link) use ($name) {
            return $link->getName() != $name;
        });
    }

    #[Route(path:"", name:"HomePage")]
    public function HomePage() 
    {
        try
        {
            $items = ItemService::getAllItems($this->em);
            $items = array($items[0], $items[1], $items[2], $items[2]);
            return $this->render("Main/home.html.twig", ["links" => $this->filterLinks("Home"), "items"=>$items], response: new Response());
        }
        catch(\Exception $e)
        {
            return new Response($e, Response::HTTP_INTERNAL_SERVER_ERROR);
        }        
    }

    #[Route(path:"/products", name:"Products")]
    public function ProductsPage()
    {
        try
        {
            return $this->render("Main/products.html.twig", ["links" => $this->filterLinks("Products")], response: new Response());
        }
        catch(\Exception $e)
        {
            return new Response($e, Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}