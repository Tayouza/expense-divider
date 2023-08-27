<?php

declare(strinct_types=1);

namespace App\Livewire\Expenses;

use App\Enums\ExpenseStatus;
use App\Models\Expense;
use LivewireUI\Modal\ModalComponent;

class EditExpense extends ModalComponent
{
    public $expense;

    public $name;

    public $value;

    public $duedate;

    public $status;

    public $expenseStatus;

    protected $rules = [
        'name' => ['string'],
        'value' => ['integer'],
        'duedate' => ['date'],
        'status' => ['string'],
    ];

    public function mount(int $expenseId)
    {
        $this->expense = Expense::find($expenseId);
        $this->name = $this->expense->name;
        $this->value = $this->expense->value;
        $this->duedate = $this->expense->duedate->format('Y-m-d');
        $this->status = $this->expense->status;

        $this->expenseStatus = ExpenseStatus::names();
    }

    public function render()
    {
        return view('livewire.expenses.edit-expense');
    }

    public function editExpense()
    {
        $this->validate();

        $this->expense->update([
            'name' => $this->name,
            'value' => $this->value,
            'duedate' => $this->duedate,
            'status' => $this->status,
        ]);

        $this->closeModal();
        $this->dispatch('refreshList');
    }
}
