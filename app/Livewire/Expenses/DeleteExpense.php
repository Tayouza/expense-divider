<?php

declare(strinct_types=1);

namespace App\Livewire\Expenses;

use App\Models\Expense;
use Livewire\Attributes\Locked;
use LivewireUI\Modal\ModalComponent;
use WireUi\Traits\WireUiActions;

class DeleteExpense extends ModalComponent
{
    use WireUiActions;

    #[Locked]
    public Expense $expense;

    public function mount(int $expenseId): void
    {
        $this->expense = Expense::findOrFail($expenseId);
    }

    public function render(): \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
    {
        return view('livewire.expenses.delete-expense');
    }

    public function deleteExpense(): void
    {
        Expense::find($this->expense->id)->delete();

        $this->closeModal();
        $this->dispatch('refreshList');
        $this->notification()->success('Deletada', 'Despesa deletada com sucesso');
    }
}
