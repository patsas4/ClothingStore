<?php


namespace App\Entity;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
#[ORM\Table(name: "Item")]
class Item {

    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: "integer", name: "ItemId")]
    private int $ItemId;

    #[ORM\Column(type: "string", name: "ItemName")]
    private string $ItemName;

    #[ORM\Column(type: "float", name:"Price")]
    private float $Price;

    #[ORM\ManyToOne(targetEntity: Category::class,)]
    #[ORM\JoinColumn(name: "CategoryId", referencedColumnName: "CategoryId")]
    private Category $Category;

    #[ORM\ManyToOne(targetEntity: Fit::class)]
    #[ORM\JoinColumn(name: "FitId", referencedColumnName: "FitId", nullable: true)]
    private ?Fit $Fit;
    #[ORM\Column(name: 'ImagePath', type:'string')]
    private string $ImagePath;

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

    public function getFit(): ?Fit
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

    public function setFit(?Fit $Fit): void
    {
        $this->Fit = $Fit;
    }

    public function getImagePath()
    {
        return $this->ImagePath;
    }

    public function setImagePath(string $imagePath)
    {
        $this->ImagePath = $imagePath;  
    }
}