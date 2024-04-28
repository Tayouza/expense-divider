<div class="p-4">
    <form wire:submit.prevent="createExpense" method="post" class="flex flex-col gap-y-2">
        @csrf
        <x-inputs.text :label="__('Name')" name="name" wire:model="name" required />
        <x-inputs.money :label="__('Value')" name="value" wire:model="value" required />
        <x-inputs.date :label="__('Duedate')" name="duedate" wire:model="duedate" required />
        <div>
            <span class="text-xs"><i>Quem pertence essa despesa: (deixe vazio para todos)</i></span>
            @foreach ($users as $user)
            <div class="flex gap-2 items-center">
                <input type="checkbox" onchange="changeChecked(this)" class="users checkbox"
                    id="user-{{ $user->id }}" value="{{ $user->id }}"
                    wire:model.defer="selectedUsers" />
                <label for="user-{{ $user->id }}" class="block text-sm font-medium text-gray-700 dark:text-gray-400">{{ $user->name }}</label>
            </div>
            @endforeach
        </div>
        <div class="flex justify-end">
            <x-secondary-button type="submit">{{ __('Create') }}</x-secondary-button>
        </div>
    </form>
</div>