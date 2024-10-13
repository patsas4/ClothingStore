<?php


namespace Back\Entities;
use Doctrine\ORM\Mapping as ORM;
use DateTime;

#[ORM\Entity]
#[ORM\Table(name:"Order")]
class Order {
    #[ORM\Id]
    #[ORM\GeneratedValue()]
    #[ORM\Column(type:"integer")]
    private int $OrderId;
    #[ORM\ManyToOne(targetEntity: Customer::class)]
    #[ORM\JoinColumn(name: "CustomerId", referencedColumnName:"CustomerId")]
    private Customer $Customer;
    private DateTime $DateOrdered;

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
}