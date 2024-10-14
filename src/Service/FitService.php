<?php

namespace App\Service;
use App\Entity\Fit;
class FitService
{
    public static function getAllFits($enitityManager)
    {
        return $enitityManager->getRepository(Fit::class)->findAll();
    }

}