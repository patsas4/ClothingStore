<?php

namespace App\Entity;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
#[ORM\Table(name:"Cart")]
class Cart {
    #[ORM\Id]
    #[ORM\GeneratedValue()]
    #[ORM\Column(type:"integer")]
    private int $CartId;
    #[ORM\ManyToOne(targetEntity: Customer::class)]
    #[ORM\JoinColumn(name:"CustomerId", referencedColumnName:"CustomerId")]
    private Customer $Customer;

    public function getCartId(): int 
    {
        return $this->CartId;
    }

    public function getCustomer(): Customer   
    {
        return $this->Customer;
    }

    public function setCustomer(Customer $customer): void 
    {
        $this->Customer = $customer;
    }
}