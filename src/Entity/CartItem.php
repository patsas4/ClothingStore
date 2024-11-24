<?php

namespace App\Entity;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
#[ORM\Table(name:"CartItem")]
class CartItem {
    #[ORM\Id]
    #[ORM\GeneratedValue()]
    #[ORM\Column(type:"integer", name:'CartItemId')]
    private int $CartItemId;
    #[ORM\ManyToOne(targetEntity: Cart::class)]
    #[ORM\JoinColumn(name:"CartId", referencedColumnName:"CartId")]
    private Cart $Cart;
    #[ORM\ManyToOne(targetEntity: Item::class)]
    #[ORM\JoinColumn(name:"ItemId", referencedColumnName:"ItemId")]
    private Item $Item;
    #[ORM\Column(type:"integer", name:'Quantity')]
    private int $Quantity;
    #[ORM\Column(type:"float", name:'Price')]
    private float $Price; 

    public function getCartItemId(): int 
    {
        return $this->CartItemId;
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

    public function getCart(): Cart
    {
        return $this->Cart;
    }

    public function setCart(Cart $Cart): void
    {
        $this->Cart = $Cart;
    }

    public function setPrice(float $price)
    {
        $this->Price = $price;
    }

    public function getPrice()
    {
        return $this->Price;
    }
}