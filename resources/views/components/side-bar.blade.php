<aside id="sidebar"
    class="w-64 absolute transition-transform duration-300 -translate-x-full  z-40 h-screen pt-1  bg-white border-r border-gray-200 dark:bg-gray-800 dark:border-gray-700" >
    <div class="overflow-y-auto py-5 px-3 h-full bg-white dark:bg-gray-800">
        <ul class="space-y-2">
            <x-side-group fclass="fa-solid fa-chart-simple" aria="etats" title="etats">
                <x-side-link :active="request()->is('suiviCommandes')" href="{{ route('suiviCommandes.index') }}">Suivi des Commandes</x-side-link>
                <x-side-link :active="request()->is('suiviRubriques')" href="{{ route('suiviRubriques.index') }}">Suivi des Rubriques</x-side-link>
                <x-side-link :active="request()->is('suiviRaps')" href="{{ route('suiviRaps.index') }}">Suivi des raps</x-side-link>
            </x-side-group>
            <x-side-group fclass="fa-solid fa-chart-simple" aria="info" title="info">
                <x-side-link :active="request()->is('commandes')" href="{{ route('commandes.index') }}  ">Recherche</x-side-link>
            </x-side-group>
        </ul>
    </div>
</aside>
