<div class="p-4">
    <div class="flex flex-col gap-y-2">
        @csrf
        <span>{{ __('Are you sure you want to duplicate') }} {{ __('the list') }} <strong>{{ $this->expenseList->name }}</strong>?</span>
        <x-inputs.text :label="__('Name')" wire:model="name" required />
        <div class="flex justify-end gap-2">
            <x-secondary-button onclick="Livewire.dispatch('closeModal')">{{ __('Close') }}</x-secondary-button>
            <x-success-button wire:click="duplicateExpenseList">{{ __('Duplicate') }}</x-success-button>
        </div>
    </d>
</div>