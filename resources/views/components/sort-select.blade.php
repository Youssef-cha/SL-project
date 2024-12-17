{{-- sort button --}}
<div class="flex space-x-5 justify-end items-center p-4 dark:bg-gray-800">

    <select wire:model.live='sort'
        class=" md:w-32 flex items-center justify-center py-2 px-4 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-primary-700 focus:z-10 focus:ring-4 focus:ring-gray-200 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700 focus:border-gray-600">
        <option value="created_at">normal</option>
        @foreach ($sortColumns as $label => $value)
            <option value="{{ $value }}">{{ $label }}</option>
        @endforeach
    </select>
    <label class="dark:text-gray-400">
        asc
        <input class="checked:bg-primary-600 dark:checked:bg-primary-600 focus:ring-primary-600" checked
            wire:model.live='sortDirection' type="radio" value="asc"
            name="sortDirection">
    </label>
    <label class="dark:text-gray-400">
        desc
        <input class="checked:bg-primary-600 dark:checked:bg-primary-600  focus:ring-primary-600" type="radio"
            wire:model.live='sortDirection' value="desc" name="sortDirection">
    </label>
</div>