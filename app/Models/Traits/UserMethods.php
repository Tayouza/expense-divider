<?php

declare(strict_types=1);

namespace App\Models\Traits;

use App\Models\Expense;

trait UserMethods
{
    public function getTotalExpensesToPay(int $expenseLisIid): float
    {
        $expenseList = $this->house
            ->expenseList
            ->where('id', $expenseLisIid)
            ->first();

        if (!$expenseList) {
            return 0;
        }

        $expenses = $expenseList->expenses->map(function (Expense $expense) {
            if ($expense->user_id === null) {
                return $expense;
            }
        });

        $totalExpenses = $expenses->sum('value') * ($this->house_participation / 100);

        $expenses = $expenseList->expenses->map(function (Expense $expense) {
            if ($expense->user_id === $this->id) {
                return $expense;
            }
        });

        $totalPersonalExpenses = $expenses->sum('value');

        return $totalExpenses + $totalPersonalExpenses;
    }
}
