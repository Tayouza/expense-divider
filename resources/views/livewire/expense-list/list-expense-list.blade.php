<div>
    @if($expenseLists->isEmpty())
    {{ __('There is no listing linked to your home, add one!') }}
    @else
    <div class="overflow-x-scroll flex flex-col gap-4">
        @foreach ($expenseLists as $expenseList)
        <div class="flex flex-col gap-2">
            <h3 class="flex gap-1 text-2xl capitalize">
                {{ $expenseList->name }}
                <div>
                    <button onclick="Livewire.dispatch('openModal', {component: 'expense-list.rename-expense-list', arguments: {expenseListId: {{ $expenseList->id }}}})"
                        data-te-toggle="tooltip"
                        title="{{ __('Rename list') }}"><x-icon name="pencil" class="w-4 h-4 opacity-50" /><button>
                    <button onclick="Livewire.dispatch('openModal', {component: 'expense-list.delete-expense-list', arguments: {expenseListId: {{ $expenseList->id }}}})"
                        data-te-toggle="tooltip"
                        title="{{ __('Delete list') }}"><x-icon name="trash" class="w-4 h-4 opacity-50 text-red-500" /><button>
                </div>
            </h3>
            <livewire:expenses.list-expense expenseListId="{{ $expenseList->id }}" key="{{ $expenseList->id }}" />
        </div>
        @endforeach
    </div>
    @endif
</div>