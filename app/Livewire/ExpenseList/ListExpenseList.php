<?php

declare(strict_types=1);

namespace App\Livewire\ExpenseList;

use App\Models\ExpenseList;
use Livewire\Component;

class ListExpenseList extends Component
{
    protected $listeners = ['refreshDashboard' => '$refresh'];

    public function render()
    {
        $expenseLists = ExpenseList::orderByDesc('created_at')
            ->where('house_id', auth()->user()->house_id)
            ->get();

        return view('livewire.expense-list.list-expense-list', [
            'expenseLists' => $expenseLists,
        ]);
    }
}
