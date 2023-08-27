<div class="p-4">
    <form wire:submit.prevent="editExpense" method="post" class="flex flex-col gap-y-2">
        @csrf
        <x-inputs.text :label="__('Name')" name="name"  wire:model="name" />
        <x-inputs.text :label="__('Value')" name="value"  wire:model="value" />
        <x-inputs.date :label="__('Duedate')" name="duedate"  wire:model="duedate" />
        <x-inputs.select :label="__('Status')" name="status" wire:model="status" :options="$expenseStatus"/>
        <div class="flex justify-end">
            <x-secondary-button type="submit">Editar</x-secondary-button>
        </div>
    </form>
</div>