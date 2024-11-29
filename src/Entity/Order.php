<?php


namespace App\Entity;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use DateTime;

#[ORM\Entity]
#[ORM\Table(name:"[Order]")]
class Order {
    #[ORM\Id]
    #[ORM\GeneratedValue()]
    #[ORM\Column(type:"integer", name:'OrderId')]
    private int $OrderId;
    #[ORM\ManyToOne(targetEntity: Customer::class)]
    #[ORM\JoinColumn(name: "CustomerId", referencedColumnName:"CustomerId")]
    private Customer $Customer;
    #[ORM\Column(type:"datetime", name:'DateOrdered')]
    private DateTime $DateOrdered;
    #[ORM\Column(type:"float", name:'Total', nullable: true)]
    private float $Total;
    #[ORM\OneToMany(targetEntity: OrderedItem::class, mappedBy: 'Order')]
    private Collection $OrderedItems;
    public function getOrderId(): int 
    {
        return $this->OrderId;
    }

    public function setCustomer(Customer $Customer): void
    {
        $this->Customer = $Customer;
    }

    public function getCustomer(): Customer
    {
        return $this->Customer;
    }

    public function setDateOrdered(DateTime $DateOrdered): void
    {
        $this->DateOrdered = $DateOrdered;
    }

    public function getDateOrdered(): DateTime 
    {
        return $this->DateOrdered;
    }

    public function getTotal()
    {
        return $this->Total;
    }

    public function setTotal(float $total)
    {
        $this->Total = $total;
    }

    public function getOrderedItems()
    {
        return $this->OrderedItems;
    }
}