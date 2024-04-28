<?php

declare(strinct_types=1);

namespace App\Livewire\Expenses;

use App\Models\Expense;
use App\Models\User;
use Carbon\Carbon;
use Livewire\Attributes\Locked;
use LivewireUI\Modal\ModalComponent;
use WireUi\Traits\Actions;

class AddExpense extends ModalComponent
{
    use Actions;

    #[Locked]
    public int $expenseListId;

    #[Locked]
    public $users;

    public $name;

    public $value;

    public $duedate;

    public $selectedUsers = [];

    protected $listerners = ['money' => 'setValue'];

    public function mount($expenseListId)
    {
        $this->expenseListId = $expenseListId;
        $this->users = User::select(['id', 'name'])->where('house_id', auth()->user()->house_id)->get();
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
            'selectedUsers' => 'nullable|array',
        ]);

        $value = str($this->value)->remove('.')->remove(',')->toInteger();
        $duedate = Carbon::parse($this->duedate);
        $status = $duedate->greaterThanOrEqualTo(today()) ? 'NEW' : 'DUEDATE';
        $selectedUserId = ! empty($this->selectedUsers) ? $this->selectedUsers[0] : null;

        Expense::create([
            'expense_list_id' => $this->expenseListId,
            'user_id' => $selectedUserId,
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
