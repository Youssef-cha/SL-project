@props(['param' => '', 'route' => ''])
<div class="flex items-center space-x-4 mt-4">
    <x-retourn-button :param="$param" :route="$route" />
    <button type="submit"
        {{ $attributes->merge(['class' => 'w-full text-center px-5 py-2.5 w-1/2 text-sm font-medium text-center text-white bg-primary-700 rounded-lg focus:ring-4 focus:ring-primary-200 dark:focus:ring-primary-900 hover:bg-primary-800']) }}>
        {{ $slot }}
    </button>
</div>
