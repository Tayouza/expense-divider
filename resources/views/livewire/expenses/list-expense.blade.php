<div>
    <div class="mb-2">
        <x-success-button
            onclick="Livewire.dispatch('openModal', {component: 'expenses.add-expense', arguments: { expenseListId: {{ $expenseListId }} }})">
            {{ __('Add income') }} (+)
        </x-success-button>
    </div>
    @if($expenses->isEmpty())
    {{ __('There are no expenses linked to this list, add one!') }}
    @else

    {{-- ========== MOBILE: Card Layout (< md) ========== --}}
    <div class="md:hidden space-y-3">
        @foreach($expenses as $expense)
        @php
            $status = match($expense->status) {
                App\Enums\ExpenseStatus::NEW->name => 'status-blue',
                App\Enums\ExpenseStatus::PAID->name => 'status-green',
                App\Enums\ExpenseStatus::DUEDATE->name => 'status-red',
            };
        @endphp
        <div class="rounded-lg border border-zinc-200 dark:border-zinc-700 bg-white dark:bg-zinc-800 p-4 shadow-sm">
            {{-- Header: Name + Status --}}
            <div class="flex items-start justify-between gap-2 mb-3">
                <div class="min-w-0 flex-1">
                    <p class="font-semibold text-zinc-900 dark:text-zinc-100 truncate">
                        {{ $expense->name }}
                    </p>
                    @if($expense->user?->username)
                    <p class="text-xs text-zinc-400">{{ $expense->user->username }}</p>
                    @endif
                </div>
                <span class="{{ $status }} whitespace-nowrap">{{ __($expense->status) }}</span>
            </div>

            {{-- Value + Duedate --}}
            <div class="flex items-center justify-between text-sm mb-3">
                <span class="text-lg font-bold text-zinc-900 dark:text-zinc-100">
                    {{ __('USD') }} {{ number_format($expense->value / 100, 2, ',', '.') }}
                </span>
                <span class="text-zinc-500 dark:text-zinc-400">
                    <x-icon name="calendar" class="w-3.5 h-3.5 inline -mt-0.5" />
                    {{ $expense->duedate->format('d/m/Y') }}
                </span>
            </div>

            {{-- Per-user breakdown --}}
            @if($houseUsers->count() > 0)
            <div class="border-t border-zinc-100 dark:border-zinc-700 pt-2 mb-3">
                <p class="text-xs text-zinc-400 uppercase tracking-wider mb-1.5">{{ __('Division') }}</p>
                <div class="space-y-1">
                    @foreach ($houseUsers as $houseUser)
                    @php
                        $expenseUser = $expense->getValueToPayForUser($houseUser);
                    @endphp
                    <div class="flex justify-between text-sm">
                        <span class="text-zinc-600 dark:text-zinc-300">{{ $houseUser->name }} <em class="text-xs text-zinc-400">({{ $houseUser->house_participation }}%)</em></span>
                        <span class="font-medium text-zinc-900 dark:text-zinc-100">{{ $expenseUser === 0 ? '-' : __('USD') . ' ' . number_format($expenseUser / 100, 2, ',', '.') }}</span>
                    </div>
                    @endforeach
                </div>
            </div>
            @endif

            {{-- Footer: Added date + Actions --}}
            <div class="flex items-center justify-between border-t border-zinc-100 dark:border-zinc-700 pt-2">
                <span class="text-xs text-zinc-400">{{ __('Added in') }}: {{ $expense->created_at->format('d/m/Y') }}</span>
                <div class="flex gap-1">
                    <x-primary-button onclick="Livewire.dispatch('openModal', {component: 'expenses.edit-expense', arguments: {expenseId: {{ $expense->id }}}})"
                        data-te-toggle="tooltip"
                        title="{{ __('Edit') }}">
                        <x-icon name="pencil" class="w-4 h-4"/>
                    </x-primary-button>
                    <x-danger-button onclick="Livewire.dispatch('openModal', {component: 'expenses.delete-expense', arguments: {expenseId: {{ $expense->id }}}})"
                        data-te-toggle="tooltip"
                        title="{{ __('Delete') }}">
                        <x-icon name="trash" class="w-4 h-4" />
                    </x-danger-button>
                </div>
            </div>
        </div>
        @endforeach

        {{-- Summary Cards --}}
        <div class="rounded-lg border border-zinc-200 dark:border-zinc-700 bg-zinc-50 dark:bg-zinc-800/50 p-4 space-y-3">
            {{-- Total --}}
            <div class="flex justify-between items-center">
                <span class="font-semibold text-zinc-900 dark:text-zinc-100">{{ __('Total') }}</span>
                <span class="font-bold text-lg text-zinc-900 dark:text-zinc-100">{{ __('USD') }} {{ number_format($expenses->sum('value') / 100, 2, ',', '.') }}</span>
            </div>
            @foreach ($houseUsers as $houseUser)
            <div class="flex justify-between text-sm">
                <span class="text-zinc-600 dark:text-zinc-300">{{ $houseUser->name }}</span>
                <span class="font-medium text-zinc-900 dark:text-zinc-100">{{ __('USD') }} {{ number_format($houseUser->getTotalExpensesToPay($expenseListId) / 100, 2, ',', '.') }}</span>
            </div>
            @endforeach

            <hr class="border-zinc-200 dark:border-zinc-700">

            {{-- Valor restante --}}
            <div class="flex justify-between items-center">
                <span class="font-semibold text-zinc-900 dark:text-zinc-100">{{ __('Valor restante') }}</span>
                <span class="font-bold text-lg text-zinc-900 dark:text-zinc-100">{{ __('USD') }} {{ number_format(($houseUsers->sum('income') - $expenses->sum('value')) / 100, 2, ',', '.') }}</span>
            </div>
            @foreach ($houseUsers as $houseUser)
            <div class="flex justify-between text-sm">
                <span class="text-zinc-600 dark:text-zinc-300">{{ $houseUser->name }}</span>
                <span class="font-medium text-zinc-900 dark:text-zinc-100">{{ __('USD') }} {{ number_format(($houseUser->income - $houseUser->getTotalExpensesToPay($expenseListId)) / 100, 2, ',', '.') }}</span>
            </div>
            @endforeach
        </div>
    </div>

    {{-- ========== DESKTOP: Table Layout (≥ md) ========== --}}
    <div class="hidden md:block overflow-x-auto">
        <table class="table border border-collapse w-full">
            <thead>
                <tr>
                    <th class="border p-2">{{ __('Expense') }}</th>
                    <th class="border p-2">{{ __('Value') }}</th>
                    <th class="border p-2">{{ __('Duedate') }}</th>
                    <th class="border p-2">{{ __('Status') }}</th>
                    <th class="border p-2">{{ __('Added in') }}</th>
                    @foreach ($houseUsers as $houseUser)
                    <th class="border p-2 text-center">{{ $houseUser->name }} <em class="text-sm font-thin">({{ $houseUser->house_participation }}%)</em></th>
                    @endforeach
                    <th class="border p-2">{{ __('Actions') }}</th>
                </tr>
            </thead>
            <tbody>
                @foreach($expenses as $expense)
                <tr>
                    <td class="border p-2">{{ $expense->name }} <span class="opacity-50 text-xs">{{ $expense->user?->username ? '(' . $expense->user->username . ')' : '' }}</span></td>
                    <td class="border p-2 text-center">
                        {{ __('USD') }} {{ number_format($expense->value / 100, 2, ',', '.') }}
                    </td>
                    <td class="border p-2 text-center">{{ $expense->duedate->format('d/m/Y') }}</td>
                    <td class="border p-2 text-center">
                        @php
                            $status = match($expense->status) {
                                App\Enums\ExpenseStatus::NEW->name => 'status-blue',
                                App\Enums\ExpenseStatus::PAID->name => 'status-green',
                                App\Enums\ExpenseStatus::DUEDATE->name => 'status-red',
                            };
                        @endphp
                        <span class="{{ $status }}">
                            {{ __($expense->status) }}
                        </span>
                    </td>
                    <td class="border p-2 text-center">{{ $expense->created_at->format('d/m/Y') }}</td>
                    @foreach ($houseUsers as $houseUser)
                    @php
                        $expenseUser = $expense->getValueToPayForUser($houseUser);
                    @endphp
                    <td class="border p-2 text-center">{{ $expenseUser === 0 ? '-' : __('USD')  . number_format($expenseUser / 100, 2, ',', '.') }}</td>
                    @endforeach
                    <td class="border p-2 text-center">
                        <x-primary-button onclick="Livewire.dispatch('openModal', {component: 'expenses.edit-expense', arguments: {expenseId: {{ $expense->id }}}})"
                            data-te-toggle="tooltip"
                            title="{{ __('Edit') }}" >
                                <x-icon name="pencil" class="w-4 h-4"/>
                        </x-primary-button>
                        <x-danger-button onclick="Livewire.dispatch('openModal', {component: 'expenses.delete-expense', arguments: {expenseId: {{ $expense->id }}}})"
                            data-te-toggle="tooltip"
                            title="{{ __('Delete') }}" >
                                <x-icon name="trash" class="w-4 h-4" />
                        </x-danger-button>
                    </td>
                </tr>
                @endforeach
                <tr>
                    <td class="border p-2">{{ __('Total') }}</td>
                    <td class="border p-2 text-center">
                        {{ __('USD') }} {{ number_format($expenses->sum('value') / 100, 2, ',', '.') }}
                    </td>
                    <td class="border-l p-2 text-center"></td>
                    <td class="p-2 text-center"></td>
                    <td class="border-r p-2 text-center"></td>
                    @foreach ($houseUsers as $houseUser)
                    <td class="border p-2 text-center">{{ __('USD') }} {{ number_format($houseUser->getTotalExpensesToPay($expenseListId) / 100, 2, ',', '.') }}</td>
                    @endforeach
                </tr>
                <tr>
                    <td class="border p-2">{{ __('Valor restante') }}</td>
                    <td class="border p-2 text-center">
                        {{ __('USD') }} {{ number_format(($houseUsers->sum('income') - $expenses->sum('value'))/ 100, 2, ',', '.') }}
                    </td>
                    <td class="border-l p-2 text-center"></td>
                    <td class="p-2 text-center"></td>
                    <td class="border-r p-2 text-center"></td>
                    @foreach ($houseUsers as $houseUser)
                    <td class="border p-2 text-center">{{ __('USD') }} {{ number_format(($houseUser->income - $houseUser->getTotalExpensesToPay($expenseListId)) / 100, 2, ',', '.') }}</td>
                    @endforeach
                </tr>
            </tbody>
        </table>
    </div>
    @endif
</div>