<?php

declare(strict_types=1);

namespace App\Livewire\Expenses;

use App\Models\Expense;
use App\Models\User;
use Livewire\Attributes\Locked;
use Livewire\Component;

class ListExpense extends Component
{
    #[Locked]
    public int $expenseListId;

    protected $listeners = ['refreshList' => '$refresh'];

    public function mount(int $expenseListId)
    {
        $this->expenseListId = $expenseListId;
    }

    public function render()
    {
        $houseId = auth()->user()->house_id;
        $houseUsers = User::where('house_id', $houseId)->get();
        $expenses = Expense::where('expense_list_id', $this->expenseListId)->get();

        return view('livewire.expenses.list-expense', [
            'houseId' => $houseId,
            'expenses' => $expenses,
            'houseUsers' => $houseUsers,
            'expenseListId' => $this->expenseListId,
        ]);
    }
}
