<?php

namespace App\Entity;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;

#[ORM\Entity]
#[ORM\Table(name:"Customer")]
class Customer implements UserInterface, PasswordAuthenticatedUserInterface
{
    #[ORM\Id]
    #[ORM\GeneratedValue()]
    #[ORM\Column(type:"integer", name: 'CustomerId')]
    private int $CustomerId;
    #[ORM\Column(type:"string", name: 'FirstName')]
    private string $FirstName;
    #[ORM\Column(type:"string", name: 'LastName')]
    private string $LastName;
    #[ORM\Column(type:"string", name: 'Email')]
    private string $Email;
    #[ORM\Column(type:"string", name: 'Password')]
    private string $Password;

    private $roles = [];

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

    public function eraseCredentials(): void
    {

    }
    
    public function getRoles(): array
    {
        $roles = $this->roles;
        $roles[] = 'ROLE_USER';
        
        return array_unique($roles);
    }
    
    public function getUserIdentifier(): string
    {
        return $this->Email;
    }

    public function setRoles($roles)
    {
        $this->roles = $roles;
    }
}