<?php

namespace App\Entities;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
#[ORM\Table(name:"Customer")]
class Customer {
    #[ORM\Id]
    #[ORM\GeneratedValue()]
    #[ORM\Column(type:"integer")]
    private int $CustomerId;
    #[ORM\Column(type:"string")]
    private string $FirstName;
    #[ORM\Column(type:"string")]
    private string $LastName;
    #[ORM\Column(type:"string")]
    private string $Email;
    #[ORM\Column(type:"string")]
    private string $Password;

    public function getCustomerId(): int 
    {
        return $this->CustomerId;
    }

    public function getFirstName(): string   
    {
        return $this->FirstName;
    }

    public function setFirstName(string $FirstName): void 
    {
        $this->FirstName = $FirstName;
    }

    public function getLastName(): string
    {
        return $this->LastName;        
    }

    public function setLastName(string $LastName): void
    {
        $this->LastName = $LastName;
    }
    public function getEmail(): string
    {
        return $this->Email;        
    }

    public function setEmail(string $Email): void
    {
        $this->Email = $Email;
    }

    public function getPassword(): string
    {
        return $this->Password;        
    }

    public function setPassword(string $Password): void
    {
        $this->Password = $Password;
    }
}