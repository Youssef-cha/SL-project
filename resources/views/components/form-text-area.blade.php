@props(['label' => 'labeeeeeeeel', 'half' => false, 'update' => ''])
@php
    if($update){
        $oldValue = $update[$attributes['name']];
    }else {
        $oldValue = '';
    }
@endphp
<div class="{{ $half ?: 'col-span-2' }}">
    <label for="{{ $label }}"
        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white @error($attributes['name']) text-red-500 dark:text-red-500  @enderror">{{ $label }}</label>
    <textarea id="{{ $label }}" rows="3"
        class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-primary-500 focus:border-primary-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500 @error($attributes['name']) text-red-500 border border-red-500 dark:text-red-500 dark:border dark:border-red-500 @enderror"
        {{ $attributes }}>{{ (old($attributes['name']) ?? $oldValue) }}</textarea>
    <p class="text-red-500 h-2">
        @error($attributes['name'])
            {{ $message }}
        @enderror
    </p>
</div>
