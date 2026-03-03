<?php

declare(strict_types=1);

namespace App\Livewire\ExpenseList;

use App\Models\ExpenseList;
use Livewire\Attributes\Locked;
use LivewireUI\Modal\ModalComponent;
use WireUi\Traits\WireUiActions;

class RenameExpenseList extends ModalComponent
{
    use WireUiActions;

    #[Locked]
    public ExpenseList $expenseList;

    public $name;

    public function mount(int $expenseListId): void
    {
        $this->expenseList = ExpenseList::find($expenseListId);
        $this->name = $this->expenseList->name;
    }

    public function render(): \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
    {
        return view('livewire.expense-list.rename-expense-list');
    }

    public function renameExpenseList(): void
    {
        $this->validate([
            'name' => 'required|string',
        ]);

        ExpenseList::find($this->expenseList->id)->update([
            'name' => $this->name,
        ]);

        $this->closeModal();
        $this->notification()->success('Renomeado', 'A lista foi renomeada para '.$this->name);
        $this->dispatch('refreshExpenseList');
    }
}
