<aside id="sidebar"
    class="w-64 absolute transition-transform duration-300 -translate-x-full  z-40 h-screen pt-1  bg-white border-r border-gray-200 dark:bg-gray-800 dark:border-gray-700" >
    <div class="overflow-y-auto py-5 px-3 h-full bg-white dark:bg-gray-800">
        <ul class="space-y-2">
            <x-side-group fclass="fa-solid fa-chart-simple" aria="etats" title="etats">
                <x-side-link href="{{ route('commandes.index') }}">search</x-side-link>
            </x-side-group>
        </ul>
    </div>
</aside>
