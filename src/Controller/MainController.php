<?php

namespace App\Controller;
use App\Service\ItemService;
use Psr\Log\LoggerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\ErrorHandler\ErrorHandler;
use Symfony\Component\HttpFoundation\Request;
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
            new Link("/account","Account"),
            new Link("/cart","Cart"),
            new Link('/show_order', 'Orders')
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
    public function HomePage(Request $request, LoggerInterface $loggerInterface) 
    {
        try
        {
            if (!$request->hasSession())
            {
                session_start();
            }

            if (!$request->getSession()->get('links'))
            {
                $request->getSession()->set('links' , $this->links);
            }

            if(!$items = $request->getSession()->get('featured'))
            {
                $items = ItemService::getAllItems($this->em);
                $items = array($items[0], $items[1], $items[2], $items[2]);
                $request->getSession()->set('featured', $items);
            }  

            return $this->render("Main/home.html.twig", ["links" => $this->filterLinks("Home"), "items"=>$items]);
        }
        catch(\Exception $e)
        {
            return new Response($e, Response::HTTP_INTERNAL_SERVER_ERROR);
        }        
    }    

    #[Route(path:"/item/{itemId}", name:"ShowItem", requirements: ["itemId" => "\d+"])]
    public function ShowItem(int $itemId)
    {
        try
        {
            $item = ItemService::getItemById($this->em, $itemId);
            return $this->render("Main/item.html.twig", ["links" => $this->links, "item" => $item]);
        }
        catch(\Exception $e)
        {
            return new Response($e, Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }




    #[Route('/{path}', name: 'catch_all', requirements: ['path' => '.*'], priority: -1)]
    public function catchAll(): Response
    {
        return $this->render('security/notfound.html.twig', ['links' => $this->links]);
    }
}