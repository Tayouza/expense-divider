<?php

declare(strinct_types=1);

namespace App\Livewire\Expenses;

use App\Models\Expense;
use Carbon\Carbon;
use Livewire\Attributes\Locked;
use LivewireUI\Modal\ModalComponent;
use WireUi\Traits\Actions;

class AddExpense extends ModalComponent
{
    use Actions;

    #[Locked]
    public int $expenseListId;

    public $name;

    public $value;

    public $duedate;

    protected $listerners = ['money' => 'setValue'];

    public function mount($expenseListId)
    {
        $this->expenseListId = $expenseListId;
    }

    public function render()
    {
        return view('livewire.expenses.add-expense');
    }

    public function createExpense()
    {
        $this->validate([
            'name' => 'required|string',
            'duedate' => 'required|date',
        ]);

        $value = str($this->value)->remove('.')->remove(',')->toInteger();
        $duedate = Carbon::parse($this->duedate);
        $status = $duedate->greaterThanOrEqualTo(today()) ? 'NEW' : 'DUEDATE';

        Expense::create([
            'expense_list_id' => $this->expenseListId,
            'name' => $this->name,
            'value' => $value,
            'duedate' => $this->duedate,
            'status' => $status,
        ]);

        $this->closeModal();
        $this->dispatch('refreshList');
        $this->notification()->success('Sucesso', 'Despesa adicionada à lista com sucesso!');
    }
}
