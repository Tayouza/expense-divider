<?php

declare(strict_types=1);

namespace App\Livewire\Expenses;

use App\Models\Expense;
use App\Models\User;
use Livewire\Component;

class ListExpense extends Component
{
    protected $listeners = ['refreshList' => '$refresh'];

    public function render()
    {
        $houseId = auth()
            ->user()
            ->house
            ?->id;

        $expenses = null;

        if (! $houseId) {
            return view('livewire.expenses.list-expense');
        }

        $houseUsers = User::where('house_id', $houseId)->get();
        $expenses = Expense::where('house_id', $houseId)->get();

        return view('livewire.expenses.list-expense', [
            'houseId' => $houseId,
            'expenses' => $expenses,
            'houseUsers' => $houseUsers,
        ]);
    }
}
