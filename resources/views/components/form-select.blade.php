@props(['label' => 'labeeeeeeeel', 'half' => false])
<div class="{{ $half ?: 'col-span-2' }}">
    <label for="{{ $label }}"
        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">{{ $label }}</label>
    <select id="{{ $label }}"
        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500 @error($attributes['name']) text-red-500 border border-red-500 @enderror"
        {{ $attributes }}>
        {{ $slot }}
    </select>
    <p class="text-red-500 h-2">
        @error($attributes['name'])
            {{ $message }}
        @enderror
    </p>
</div>
