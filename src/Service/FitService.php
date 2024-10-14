<?php

namespace Back\Service;
use Back\Entities\Fit;
class FitService
{
    public static function getAllFits($enitityManager)
    {
        return $enitityManager->getRepository(Fit::class)->findAll();
    }

}