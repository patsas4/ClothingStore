<?php

namespace Back\Entities;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
#[ORM\Table(name:"Fit")]
class Fit {
    #[ORM\Id]
    #[ORM\GeneratedValue()]
    #[ORM\Column(type:"integer")]
    private int $FitId;
    #[ORM\Column(type:"string")]
    private string $FitType;

    public function getFitId(): int 
    {
        return $this->FitId;
    }

    public function getFitType(): string   
    {
        return $this->FitType;
    }

    public function setFitType(string $FitType): void 
    {
        $this->FitType = $FitType;
    }
}