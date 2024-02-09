<div>
    @if($expenseLists->isEmpty())
    {{ __('There is no listing linked to your home, add one!') }}
    @else
    <div class="overflow-x-scroll flex flex-col gap-4">
        @foreach ($expenseLists as $expenseList)
        <div class="flex flex-col gap-2" x-data="{ show{{ $expenseList->id }}: false }">
            <h3 class="flex items-center gap-1 text-2xl capitalize cursor-pointer">
                <div class="flex items-center gap-1" x-on:click="show{{ $expenseList->id }} = ! show{{ $expenseList->id }}">
                    <x-icon name="chevron-right" x-bind:class="{'w-5 h-5 opacity-50': !show{{ $expenseList->id }}, 'w-5 h-5 opacity-50 rotate-90': show{{ $expenseList->id }}}" />
                    <span>{{ $expenseList->name }}</span>
                </div>
                <div>
                    <button onclick="Livewire.dispatch('openModal', {component: 'expense-list.rename-expense-list', arguments: {expenseListId: {{ $expenseList->id }}}})"
                        data-te-toggle="tooltip"
                        title="{{ __('Rename list') }}"><x-icon name="pencil" class="w-5 h-5 opacity-50" /><button>
                    <button onclick="Livewire.dispatch('openModal', {component: 'expense-list.delete-expense-list', arguments: {expenseListId: {{ $expenseList->id }}}})"
                        data-te-toggle="tooltip"
                        title="{{ __('Delete list') }}"><x-icon name="trash" class="w-5 h-5 opacity-50 text-red-500" /><button>
                </div>
            </h3>
            <div x-show="show{{ $expenseList->id }}" x-cloak>
                <livewire:expenses.list-expense expenseListId="{{ $expenseList->id }}" key="{{ $expenseList->id }}" />
            </div>
        </div>
        @endforeach
    </div>
    @endif
</div>