<div class="p-4">
    <form wire:submit.prevent="createExpense" method="post" class="flex flex-col gap-y-2">
        @csrf
        <x-inputs.text :label="__('Name')" name="name"  wire:model="name" />
        <x-inputs.text :label="__('Value')" name="value"  wire:model="value" />
        <x-inputs.date :label="__('Duedate')" name="duedate"  wire:model="duedate" />
        <div class="flex justify-end">
            <x-secondary-button type="submit">Criar</x-secondary-button>
        </div>
    </form>
</div>