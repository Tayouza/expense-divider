<div class="p-4">
    <form wire:submit.prevent="createExpenseList" method="post" class="flex flex-col gap-y-2">
        @csrf
        <x-inputs.text :label="__('Name')" name="name" wire:model="name" required />
        <div class="flex justify-end">
            <x-secondary-button type="submit">{{ __('Create') }}</x-secondary-button>
        </div>
    </form>
</div>