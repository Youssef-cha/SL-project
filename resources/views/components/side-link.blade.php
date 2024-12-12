@props(['active' => false])
<li>
    <a {{ $attributes->merge(['class' => 'flex items-center transition-all ease-out duration-200 p-2 pl-11 w-full text-base font-medium text-gray-900 rounded-lg transition duration-75 group hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700 focus:bg-gradient-to-t focus:from-primary-600 focus:to-primary-400 focus:font-semibold focus:text-gray-100 ' . ($active ? 'bg-gradient-to-t font-semibold from-primary-600 to-primary-400 text-gray-100  cursor-default pointer-events-none' : '') ]) }}
        >{{ $slot }}</a>
</li>