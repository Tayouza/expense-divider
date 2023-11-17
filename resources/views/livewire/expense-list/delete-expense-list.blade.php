<div class="p-4">
    <div class="flex flex-col gap-y-2">
        @csrf
        <span>{{ __('Are you sure you want to delete') }} {{ __('the list') }} <strong>{{ $this->expenseList->name }}</strong>?</span>
        <div class="flex justify-end gap-2">
            <x-secondary-button onclick="Livewire.dispatch('closeModal')">{{ __('Close') }}</x-secondary-button>
            <x-danger-button wire:click="deleteExpenseList">{{ __('Delete') }}</x-danger-button>
        </div>
    </d>
</div>