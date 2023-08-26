<?php

declare(strict_types=1);

namespace App\Models\Traits;

trait UserMethods
{
    public function getTotalExpensesToPay(): float
    {
        $expenses = $this->house
            ->expenses;

        $totalExpenses = $expenses->sum('value');

        return $totalExpenses * ($this->house_participation / 100);
    }
}
