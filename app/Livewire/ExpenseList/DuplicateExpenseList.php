<?php

declare(strict_types=1);

namespace App\Livewire\ExpenseList;

use App\Models\Expense;
use App\Models\ExpenseList;
use Illuminate\Support\Facades\DB;
use LivewireUI\Modal\ModalComponent;
use WireUi\Traits\WireUiActions;

class DuplicateExpenseList extends ModalComponent
{
    use WireUiActions;

    public $name;

    public $expenseList;

    public function mount(int $expenseListId): void
    {
        $this->expenseList = ExpenseList::findOrFail($expenseListId);
    }

    public function render(): \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
    {
        return view('livewire.expense-list.duplicate-expense-list');
    }

    public function duplicateExpenseList(): void
    {
        $this->validate([
            'name' => 'required|string',
        ]);

        DB::beginTransaction();

        try {
            $expenseList = ExpenseList::create([
                'name' => $this->name,
                'house_id' => auth()->user()->house_id,
            ]);

            $this->expenseList->expenses->each(function ($expense) use ($expenseList): void {
                Expense::create([
                    'name' => $expense->name,
                    'value' => $expense->value,
                    'user_id' => $expense->user_id,
                    'duedate' => $expense->duedate->addMonth(),
                    'status' => $expense->status,
                    'expense_list_id' => $expenseList->id,
                ]);
            });

            DB::commit();
            $this->closeModal();
            $this->dispatch('refreshList');
            $this->dispatch('refreshDashboard');
            $this->notification()->success('Sucesso', 'Lista criada com sucesso!');
        } catch (\Throwable) {
            DB::rollBack();
            $this->notification()->error('Erro', 'Erro ao duplicar a lista');
        }
    }
}
