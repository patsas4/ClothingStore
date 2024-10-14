<?php


namespace App\Entities;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
#[ORM\Table(name:"OrderedItem")]
class OrderedItem {
    #[ORM\Id]
    #[ORM\GeneratedValue()]
    #[ORM\Column(type:"integer")]
    private int $OrderedItemId;
    #[ORM\ManyToOne(targetEntity: Order::class)]
    #[ORM\JoinColumn(name: "OrderId", referencedColumnName:"OrderId")]
    private Order $Order;
    #[ORM\ManyToOne(targetEntity: Item::class)]
    #[ORM\JoinColumn(name: "ItemId", referencedColumnName:"ItemId")]
    private Item $Item;
    #[ORM\Column(type:"integer")]
    private int $Quantity;

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
}