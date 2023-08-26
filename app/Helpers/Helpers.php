<?php

declare(strict_types=1);

namespace App\Helpers;

class Helpers
{
    public static function ruleOfThree(float $value, float $total): float
    {
        return $value * 100 / $total;
    }
}
