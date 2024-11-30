<?php

namespace App\Entity;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
#[ORM\Table(name: "Category")]
class Category {

    public const None = 9;

    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type:"integer", name: "CategoryId")]
    private int $CategoryId;

    #[ORM\Column(type:"string", length: 50, name: "CategoryName")]
    private string $CategoryName;

    public function getCategoryId(): int 
    {
        return $this->CategoryId;
    }

    public function setCategoryName(string $CategoryName): void
    {
        $this->CategoryName = $CategoryName;
    }

    public function getCategoryName(): string
    {
        return $this->CategoryName;
    }
}