<div class="p-4">
    <form wire:submit.prevent="renameExpenseList" method="post" class="flex flex-col gap-y-2">
        @csrf
        <x-inputs.text :label="__('Name')" name="name" wire:model="name" value="{{ $this->name }}" required />
        <div class="flex justify-end">
            <x-secondary-button type="submit">{{ __('Rename') }}</x-secondary-button>
        </div>
    </form>
</div>
