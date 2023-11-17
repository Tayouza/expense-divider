<?php

declare(strict_types=1);

namespace App\Livewire\ExpenseList;

use App\Models\ExpenseList;
use Livewire\Component;

class ListExpenseList extends Component
{
    protected $listeners = ['refreshList' => '$refresh'];

    public function render()
    {
        $expenseLists = ExpenseList::all();

        return view('livewire.expense-list.list-expense-list', [
            'expenseLists' => $expenseLists,
        ]);
    }
}
