<div>
    @if($expenseLists->isEmpty())
    {{ __('There is no listing linked to your home, add one!') }}
    @else
    <div class="overflow-x-scroll flex flex-col gap-2">
        @foreach ($expenseLists as $expenseList)
        <details class="flex flex-col gap-2 cursor-pointer">
            <summary class="flex items-center gap-2 text-2xl capitalize cursor-pointer">
                {{ $expenseList->name }}
                <div>
                    <button
                        onclick="Livewire.dispatch('openModal', {component: 'expense-list.rename-expense-list', arguments: {expenseListId: {{ $expenseList->id }}}})"
                        data-te-toggle="tooltip" title="{{ __('Rename list') }}">
                        <x-icon name="pencil" class="w-5 h-5 opacity-50" />
                    </button>
                    <button
                        onclick="Livewire.dispatch('openModal', {component: 'expense-list.delete-expense-list', arguments: {expenseListId: {{ $expenseList->id }}}})"
                        data-te-toggle="tooltip" title="{{ __('Delete list') }}">
                        <x-icon name="trash" class="w-5 h-5 opacity-50 text-red-500" />
                    </button>
                    <button
                        onclick="Livewire.dispatch('openModal', {component: 'expense-list.duplicate-expense-list', arguments: {expenseListId: {{ $expenseList->id }}}})"
                        data-te-toggle="tooltip" title="{{ __('Duplicate list') }}">
                        <x-icon name="document-duplicate" class="w-5 h-5 opacity-50 text-blue-500" />
                    </button>
                </div>
            </summary>
            <div>
                <livewire:expenses.list-expense expenseListId="{{ $expenseList->id }}" wire:key="{{ rand() }}" />
            </div>
        </details>
        @endforeach
    </div>
    @endif
</div>