<div>
    <button onclick="Livewire.dispatch('openModal', {component: 'expenses.add-expense'})">Adicionar despesa (+)</button>
    @if($expenses->isEmpty())
    Não há nenhuma despesa vinculada a sua casa, adicione uma!
    @else
    <div class="overflow-x-scroll">
        <table class="table border border-collapse w-full min-w-[720px]">
            <thead>
                <tr>
                    <th class="border p-2">Despesa</th>
                    <th class="border p-2">Valor</th>
                    <th class="border p-2">Vencimento</th>
                    <th class="border p-2">Status</th>
                    <th class="border p-2">Adicionada em</th>
                    @foreach ($houseUsers as $houseUser)
                    <th class="border p-2 text-center">{{ $houseUser->name }}</th>
                    @endforeach
                    <th class="border p-2">Ações</th>
                </tr>
            </thead>
            <tbody>
                @foreach($expenses as $expense)
                <tr>
                    <td class="border p-2">{{ $expense->name }}</td>
                    <td class="border p-2 text-center">
                        R$ {{ number_format($expense->value / 100, 2, ',', '.') }}
                    </td>
                    <td class="border p-2 text-center">{{ $expense->duedate->format('d/m/Y') }}</td>
                    <td class="border p-2 text-center">{{ $expense->status }}</td>
                    <td class="border p-2 text-center">{{ $expense->created_at->format('d/m/Y') }}</td>
                    @foreach ($houseUsers as $houseUser)
                    <td class="border p-2 text-center">R$ {{ number_format($expense->getValueToPayForUser($houseUser) / 100, 2, ',', '.') }}</td>
                    @endforeach
                    <td class="border p-2 text-center"></td>
                </tr>
                @endforeach
                <tr>
                    <td class="border p-2">Total</td>
                    <td class="border p-2 text-center">
                        R$ {{ number_format($expenses->sum('value') / 100, 2, ',', '.') }}
                    </td>
                    <td class="border-l p-2 text-center"></td>
                    <td class="p-2 text-center"></td>
                    <td class="border-r p-2 text-center"></td>
                    @foreach ($houseUsers as $houseUser)
                    <td class="border p-2 text-center">R$ {{ number_format($houseUser->getTotalExpensesToPay() / 100, 2, ',', '.') }}</td>
                    @endforeach
                    <td class="border-r p-2 text-center"></td>
                </tr>
            </tbody>
        </table>
    </div>
    @endif
</div>