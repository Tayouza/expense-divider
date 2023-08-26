@props([
    'disabled' => false,
    'id' => 'input-' . uniqid(),
    'label' => '',
])
@php
    $classes = 'border-zinc-300 dark:border-zinc-700 dark:bg-zinc-900 dark:text-zinc-300 focus:border-indigo-500
    dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm';

    $wireModel = $attributes->whereStartsWith('wire:model')->first();
    $hasError = $errors->has($wireModel);
@endphp

<label for="{{ $id }}" class="flex flex-col gap-y-1">
    <span @class(['text-red-500' => $hasError])>{{ $label }}</span>
    <input {{ $disabled ? 'disabled' : '' }} id="{{ $id }}" {{ $attributes }} type="date" @class([$classes, '!text-red-500' => $hasError])>
    @error($wireModel)
        <span class="text-red-500">{{ $message}}</span>
    @enderror
</label>