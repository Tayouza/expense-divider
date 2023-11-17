<?php

declare(strict_types=1);

namespace App\Models\Traits;

trait UserMethods
{
    public function getTotalExpensesToPay(int $expenseLisIid): float
    {
        $expenseList = $this->house
            ->expenseList
            ->where('id', $expenseLisIid)
            ->first();

        $expenses = $expenseList->expenses;
        $totalExpenses = $expenses->sum('value');

        return $totalExpenses * ($this->house_participation / 100);
    }
}
