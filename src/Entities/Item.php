<?php


namespace Back\Entities;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
#[ORM\Table(name:"Item")]
class Item {

    #[ORM\Id]
    #[ORM\GeneratedValue(strategy: "AUTO")]
    #[ORM\Column(type:"integer")]
    private int $ItemId;

    #[ORM\Column(type:"string")]
    private string $ItemName;

    #[ORM\Column(type:"float")]
    private float $Price;

    #[ORM\ManyToOne(targetEntity: Category::class,)]
    #[ORM\JoinColumn(name: "CategoryId", referencedColumnName: "CategoryId")]
    private Category $Category;

    #[ORM\ManyToOne(targetEntity: Fit::class)]
    #[ORM\JoinColumn(name:"FitId", referencedColumnName:"FitId")]
    private Fit $Fit;

    public function getItemId(): int 
    {
        return $this->ItemId;
    }

    public function getItemName(): string 
    {
        return $this->ItemName;
    }

    public function getPrice(): float 
    {
        return $this->Price;
    }

    public function getCategory(): Category
    {
        return $this->Category;
    }

    public function getFit(): Fit
    {
        return $this->Fit;
    }

    public function setItemName(string $ItemName): void
    {
        $this->ItemName = $ItemName;
    }

    public function setPrice(float $Price): void
    {
        $this->Price = $Price;
    }

    public function setCategory(Category $Category): void
    {
        $this->Category = $Category;
    }

    public function setFit(Fit $Fit): void
    {
        $this->Fit = $Fit;
    }

    public function setCategoryId(int $CategoryId): void
    {
        $this->CategoryId = $CategoryId;
    }

    public function setFitId(int $FitId): void
    {
        $this->FitId = $FitId;
    }
}