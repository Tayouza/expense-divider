<?php

declare(strinct_types=1);

namespace App\Livewire\Expenses;

use App\Models\Expense;
use Carbon\Carbon;
use LivewireUI\Modal\ModalComponent;

class AddExpense extends ModalComponent
{
    public $name;

    public $value;

    public $duedate;

    protected $rules = [
        'name' => ['required', 'string'],
        'value' => ['required', 'integer'],
        'duedate' => ['required', 'date'],
    ];

    public function render()
    {
        return view('livewire.expenses.add-expense');
    }

    public function createExpense()
    {
        $this->validate();

        $expense = app(Expense::class);

        $duedate = Carbon::parse($this->duedate);

        $status = $duedate->greaterThanOrEqualTo(today()) ? 'NEW' : 'DUEDATE';

        $expense->create([
            'house_id' => auth()->user()->house->id,
            'name' => $this->name,
            'value' => $this->value,
            'duedate' => $this->duedate,
            'status' => $status,
        ]);

        $this->closeModal();
        $this->dispatch('refreshList');
    }
}
