<?php

declare(strinct_types=1);

namespace App\Livewire\Expenses;

use App\Models\Expense;
use LivewireUI\Modal\ModalComponent;

class DeleteExpense extends ModalComponent
{
    public Expense $expense;

    public function mount(int $expenseId)
    {
        $this->expense = Expense::findOrFail($expenseId);
    }

    public function render()
    {
        return view('livewire.expenses.delete-expense');
    }

    public function deleteExpense()
    {
        Expense::find($this->expense->id)->delete();
        
        $this->closeModal();
        $this->dispatch('refreshList');
    }
}
