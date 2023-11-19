<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-zinc-800 dark:text-zinc-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-zinc-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-zinc-900 dark:text-zinc-100">
                    <div class="flex justify-between">
                        <div class="flex gap-1 items-center" x-data="{ show: true }">
                            <h2 class="text-3xl font-bold pb-2">{{ $house->name }}</h2>
                            <em class="opacity-50 text-base italic" x-show="show" >#{{ $house->code }}</em>
                            <x-icon name="eye-off" class="w-5 h-5 opacity-50 cursor-pointer"
                                x-on:click="show = ! show" 
                                data-te-toggle="tooltip" title="{{ __('Hide house code') }}" x-show="show" />
                            <x-icon name="eye" class="w-5 h-5 opacity-50 cursor-pointer"
                                x-on:click="show = ! show" 
                                data-te-toggle="tooltip" title="{{ __('Show house code') }}" x-show="! show" />
                        </div>
                        <x-success-button onclick="Livewire.dispatch('openModal', {component: 'expense-list.create-expense-list'})"
                            data-te-toggle="tooltip" title="{{ __('Add list') }}">(+)</x-success-button>
                    </div>
                    <livewire:expense-list.list-expense-list />
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
