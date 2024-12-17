<aside id="sidebar"
    class="w-64 fixed top-16 border-t transition-transform duration-300 -translate-x-full  z-40 bottom-0 pt-1  bg-white border-r border-gray-200 dark:bg-gray-800 dark:border-gray-700">
    <div
        class="divide-y divide-slate-700 overflow-y-auto flex flex-col justify-between py-5 px-3 h-full bg-white dark:bg-gray-800">
        <ul class="space-y-2">
            <x-side-group fclass="fa-solid fa-chart-simple" aria="etats" title="Suivi">
                <x-side-link :active="request()->is('suiviCommandes')" href="{{ route('suiviCommandes.index') }}">Suivi des
                    Commandes</x-side-link>
                <x-side-link :active="request()->is('suiviRubriques')" href="{{ route('suiviRubriques.index') }}">Suivi des
                    Rubriques</x-side-link>
                <x-side-link :active="request()->is('suiviRaps')" href="{{ route('suiviRaps.index') }}">Suivi des raps</x-side-link>
            </x-side-group>
            <x-side-group fclass="fa-solid fa-chart-simple" aria="info" title="info">
                <x-side-link :active="request()->is('commandes')" href="{{ route('commandes.index') }}  ">commandes</x-side-link>
                <x-side-link :active="request()->is('rubriques')" href="{{ route('rubriques.index') }}  ">rubriques</x-side-link>
                <x-side-link :active="request()->is('fournisseurs')" href="{{ route('fournisseurs.index') }}  ">fournisseurs</x-side-link>
                <x-side-link :active="request()->is('complexes')" href="{{ route('complexes.index') }}  ">complexes / efps</x-side-link>
            </x-side-group>
            
        </ul>
        <div>
            @can('add-users')
                <a href="{{ route('users.create') }}"
                    class="dark:text-gray-300 hover:text-primary-500 hover:bg-white bg-gray-200 dark:hover:bg-gray-900 dark:bg-gray-700 transition-colors duration-300  rounded-full mt-3  p-4 flex items-center justify-between ring ring-green-500  ">
                    <div class="flex items-center space-x-3 text-md text-inherit">
                        <i class="fa-solid fa-plus"></i>
                        <span class=" font-semibold text-inherit">ajouter un responsable</span>
                    </div>
                </a>
            @endcan
            <div
                class="rounded-full mt-3 overflow-hidden h-16 relative  p-4 flex items-center justify-between ring ring-green-500  ">
                <div class="flex items-center space-x-3 text-lg dark:text-gray-300">
                    <i class="fa-solid fa-user"></i>
                    <span class=" font-semibold ">{{ Auth::user()->name }}</span>
                </div>
                <button form="logout" type="submit"
                    class=" absolute w-16 text-xl right-0 inset-y-0 block dark:text-white text-gray-900 hover:bg-white bg-gray-200 dark:hover:bg-gray-900 dark:bg-gray-700 focus:outline-none focus:ring-4 focus:ring-red-300 capitalize  hover:text-primary-500 transition-colors px-5 py-2.5 text-center font-semibold dark:bg-gray-600 dark:hover:bg-gray-900 dark:focus:ring-gray-800">
                    <i class="fa-solid fa-arrow-right-from-bracket "></i>
                </button>
                <form id="logout" class="hidden" action="{{ route('sessions.destroy') }}" method="POST">
                    @csrf
                </form>
            </div>
        </div>
    </div>
</aside>
