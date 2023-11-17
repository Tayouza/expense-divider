<?php

declare(strict_types=1);

namespace App\Livewire\ExpenseList;

use App\Models\ExpenseList;
use LivewireUI\Modal\ModalComponent;
use WireUi\Traits\Actions;

class CreateExpenseList extends ModalComponent
{
    use Actions;

    public $name;

    public function render()
    {
        return view('livewire.expense-list.create-expense-list');
    }

    public function createExpenseList()
    {
        $this->validate([
            'name' => 'required|string',
        ]);

        ExpenseList::create([
            'name' => $this->name,
            'house_id' => auth()->user()->house_id,
        ]);

        $this->closeModal();
        $this->dispatch('refreshList');
        $this->notification()->success('Sucesso', 'Lista criada com sucesso!');
    }
}
