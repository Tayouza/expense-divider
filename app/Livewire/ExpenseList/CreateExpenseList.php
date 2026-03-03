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

    public function render(): \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
    {
        return view('livewire.expense-list.create-expense-list');
    }

    public function createExpenseList(): void
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
        $this->dispatch('refreshDashboard');
        $this->notification()->success('Sucesso', 'Lista criada com sucesso!');
    }
}
