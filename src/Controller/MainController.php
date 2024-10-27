<?php

namespace App\Controller;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\ErrorHandler\ErrorHandler;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Link;

class MainController extends AbstractController
{
    public $links;
    
    public function __construct()
    {
        $this->links = [
            new Link("/", "Home"),
            new Link("/products","Products"),
            new Link("/account","Account")
        ];
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
            return $this->render("Main/home.html.twig", ["links" => $this->filterLinks("Home")], response: new Response());
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