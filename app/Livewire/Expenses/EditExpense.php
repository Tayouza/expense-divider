<?php

declare(strinct_types=1);

namespace App\Livewire\Expenses;

use App\Enums\ExpenseStatus;
use App\Models\Expense;
use Livewire\Attributes\Locked;
use LivewireUI\Modal\ModalComponent;
use WireUi\Traits\Actions;

class EditExpense extends ModalComponent
{
    use Actions;

    #[Locked]
    public Expense $expense;

    public $name;

    public $value;

    public $duedate;

    public $status;

    public $personal;

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
        $this->personal = $this->expense->user_id !== null;
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
            'user_id' => $this->personal ? auth()->user()->id : null,
            'duedate' => $this->duedate,
            'status' => $this->status,
        ]);

        $this->closeModal();
        $this->dispatch('refreshList');
        $this->notification()->success('Editada', 'Despesa editada com sucesso');
    }
}
