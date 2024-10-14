<?php

namespace App\Service;
use App\Entities\Fit;
class FitService
{
    public static function getAllFits($enitityManager)
    {
        return $enitityManager->getRepository(Fit::class)->findAll();
    }

}