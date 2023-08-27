<div class="p-4">
    <div class="flex flex-col gap-y-2">
        @csrf
        <span>Você tem certeza que deseja excluir a despesa <strong>{{ $this->expense->name }}</strong>?</span>
        <div class="flex justify-end gap-2">
            <x-secondary-button onclick="Livewire.dispatch('closeModal')">Fechar</x-secondary-button>
            <x-danger-button wire:click="deleteExpense">Excluir</x-danger-button>
        </div>
    </d>
</div>