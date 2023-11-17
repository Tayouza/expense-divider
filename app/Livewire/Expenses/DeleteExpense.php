<?php

declare(strinct_types=1);

namespace App\Livewire\Expenses;

use App\Models\Expense;
use Livewire\Attributes\Locked;
use LivewireUI\Modal\ModalComponent;
use WireUi\Traits\Actions;

class DeleteExpense extends ModalComponent
{
    use Actions;

    #[Locked]
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
        $this->notification()->success('Deletada', 'Despesa deletada com sucesso');
    }
}
