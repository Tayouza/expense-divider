<div class="p-4">
    <form wire:submit.prevent="createExpense" method="post" class="flex flex-col gap-y-2">
        @csrf
        <x-inputs.text :label="__('Name')" name="name" wire:model="name" required />
        <x-inputs.money :label="__('Value')" name="value" wire:model="value" required />
        <x-inputs.date :label="__('Duedate')" name="duedate" wire:model="duedate" required />
        <x-toggle :label="__('Personal')" wire:model.defer="personal"  />
        <div class="flex justify-end">
            <x-secondary-button type="submit">{{ __('Create') }}</x-secondary-button>
        </div>
    </form>
</div>