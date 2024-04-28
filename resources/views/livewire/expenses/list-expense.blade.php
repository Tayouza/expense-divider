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
    <div class="overflow-x-scroll">
        <table class="table border border-collapse w-full min-w-[720px]">
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
                    <td class="border p-2">{{__ ('Total') }}</td>
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
            </tbody>
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