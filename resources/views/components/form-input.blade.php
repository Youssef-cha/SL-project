@props(['half' => false, 'label' => '', 'update' => ''])
@php
    if($update){
        $oldValue = $update[$attributes['name']];
    }else {
        $oldValue = '';
    }
@endphp
<div class="{{ $half ?: 'sm:col-span-2' }}">

   @if ($label) 
     <label for="{{ $label }}"
         class=" block mb-2 text-sm font-medium text-gray-900 dark:text-white  @error($attributes['name']) !text-red-500 font-semibold  @enderror">{{ $label }}</label>
   @endif
    <input {{ $attributes->merge(['type' => 'text']) }}
        class='bg-gray-50  border transition-all disabled:opacity-50 border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500 @error($attributes['name']) text-red-500 border border-red-500 dark:text-red-500 dark:border dark:border-red-500 @enderror '
        id="{{ $label }}" value="{{ old($attributes['name']) ?? $oldValue }}" required>
        <p class="text-red-500 h-2">
            @error($attributes['name'])
                {{ $message }}
            @enderror
        </p>
</div>
