<?php


namespace App\Entity;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
#[ORM\Table(name:"OrderedItem")]
class OrderedItem {
    #[ORM\Id]
    #[ORM\GeneratedValue()]
    #[ORM\Column(type:"integer", name:'OrderedItemId')]
    private int $OrderedItemId;
    #[ORM\ManyToOne(targetEntity: Order::class, inversedBy: 'OrderedItems')]
    #[ORM\JoinColumn(name: "OrderId", referencedColumnName:"OrderId")]
    private Order $Order;
    #[ORM\ManyToOne(targetEntity: Item::class)]
    #[ORM\JoinColumn(name: "ItemId", referencedColumnName:"ItemId")]
    private Item $Item;
    #[ORM\Column(type:"integer", name:'Quantity')]
    private int $Quantity;
    #[ORM\Column(type:"float", name:'Price')]
    private float $Price;

    public function getOrderedItemId(): int 
    {
        return $this->OrderedItemId;
    }

    public function setOrder(Order $Order): void
    {
        $this->Order = $Order;
    }

    public function getOrder(): Order
    {
        return $this->Order;
    }

    public function setItem(Item $Item): void
    {
        $this->Item = $Item;
    }

    public function getItem(): Item
    {
        return $this->Item;
    }

    public function setQuantity(int $Quantity): void
    {
        $this->Quantity = $Quantity;
    }

    public function getQuantity(): int
    {
        return $this->Quantity;
    }

    public function getPrice()
    {
        return $this->Price;
    }

    public function setPrice(float $price)
    {
        $this->Price = $price;
    }
}