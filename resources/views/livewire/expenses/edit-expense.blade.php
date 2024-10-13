<div class="p-4">
    <form wire:submit.prevent="editExpense" method="post" class="flex flex-col gap-y-2">
        @csrf
        <x-inputs.text :label="__('Name')" name="name" wire:model="name" />
        <x-inputs.money :label="__('Value')" name="value" wire:model="value" />
        <x-inputs.date :label="__('Duedate')" name="duedate" wire:model="duedate" />
        <x-inputs.select :label="__('Status')" name="status" wire:model="status" :options="$expenseStatus" />
        <div>
            <span class="text-xs"><i>Quem pertence essa despesa: (deixe vazio para todos)</i></span>
            @foreach ($users as $user)
                @if(!$this->expense->user_id)
                <div class="flex gap-2 items-center">
                    <input type="checkbox" onchange="changeChecked(this)"
                        class="users checkbox" id="user-{{ $user->id }}" value="{{ $user->id }}"
                        wire:model.defer="selectedUsers" />
                    <label for="user-{{ $user->id }}" class="block text-sm font-medium text-gray-700 dark:text-gray-400">{{ $user->name }}</label>
                </div>
                @elseif($this->expense->user_id === $user->id)
                <div class="flex gap-2 items-center">
                    <input type="checkbox" onchange="changeChecked(this)" checked
                        class="users checkbox line-through" id="user-{{ $user->id }}" value="{{ $user->id }}"
                        wire:model.defer="selectedUsers" />
                    <label for="user-{{ $user->id }}" class="block text-sm font-medium text-gray-700 dark:text-gray-400">{{ $user->name }}</label>
                </div>
                @else
                <div class="flex gap-2 items-center">
                    <input type="checkbox" onchange="changeChecked(this)" disabled
                        class="users checkbox" id="user-{{ $user->id }}" value="{{ $user->id }}"
                        wire:model.defer="selectedUsers" />
                    <label for="user-{{ $user->id }}" class="block text-sm font-medium text-gray-700 line-through dark:text-gray-400">{{ $user->name }}</label>
                </div>
                @endif
            @endforeach
        </div>
        <div class="flex justify-end">
            <x-secondary-button type="submit">{{ __('Edit') }}</x-secondary-button>
        </div>
    </form>
</div>