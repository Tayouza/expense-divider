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
        'duedate' => ['date'],
        'status' => ['string'],
    ];

    public function mount(int $expenseId)
    {
        $this->expense = Expense::find($expenseId);
        $this->name = $this->expense->name;
        $this->value = number_format($this->expense->value / 100, 2, ',', '.');
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
        $value = str($this->value)->remove('.')->remove(',')->toInteger();

        $this->expense->update([
            'name' => $this->name,
            'value' => $value,
            'duedate' => $this->duedate,
            'status' => $this->status,
        ]);

        $this->closeModal();
        $this->dispatch('refreshList');
    }
}
