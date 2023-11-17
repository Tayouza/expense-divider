<?php

declare(strinct_types=1);

namespace App\Livewire\ExpenseList;

use App\Models\ExpenseList;
use Livewire\Attributes\Locked;
use LivewireUI\Modal\ModalComponent;
use WireUi\Traits\Actions;

class DeleteExpenseList extends ModalComponent
{
    use Actions;

    #[Locked]
    public ExpenseList $expenseList;

    public function mount(int $expenseListId)
    {
        $this->expenseList = ExpenseList::findOrFail($expenseListId);
    }

    public function render()
    {
        return view('livewire.expense-list.delete-expense-list');
    }

    public function deleteExpenseList()
    {
        $expenseList = ExpenseList::find($this->expenseList->id);

        if ($expenseList->expenses->isEmpty()) {
            $expenseList->delete();

            $this->closeModal();
            $this->dispatch('refreshList');
            $this->notification()->success('Deletado', 'Lista deletado com sucesso');
        } else {
            $this->closeModal();
            $this->notification()->error('Não foi possível deletar', 'A lista de despesas não está vazia, exclua as despesas desta lista e tente novamente.');
        }
    }
}
