@php
    use Carbon\Carbon;
@endphp
<div>
    <section class="bg-gray-50 dark:bg-gray-900 p-3 sm:p-5">
        <div class="mx-auto max-w-screen-xl px-4 lg:px-12">
            <!-- Start coding here -->
            <div class="bg-white dark:bg-gray-800 relative shadow-md sm:rounded-lg ">
                <div
                    class="flex flex-col lg:flex-row items-center justify-between space-y-3 md:space-y-0 md:space-x-4 p-4 pb-1">
                    <div class="w-full md:w-1/2">
                        {{-- search bar --}}
                        <form class="flex items-center">
                            <label for="simple-search" class="sr-only"></label>
                            <div class="relative w-full">
                                <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                                    <svg aria-hidden="true" class="w-5 h-5 text-gray-500 dark:text-gray-400"
                                        fill="currentColor" viewbox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                        <path fill-rule="evenodd"
                                            d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z"
                                            clip-rule="evenodd" />
                                    </svg>
                                </div>
                                <input wire:model.live.debounce.300ms='search' type="text" id="simple-search"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full pl-10 p-2 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                    placeholder="Recherche" required="">
                            </div>
                        </form>
                    </div>
                    <div
                        class="w-full md:w-auto flex flex-col md:flex-row space-y-2 md:space-y-0 items-stretch md:items-center justify-end md:space-x-3 flex-shrink-0">
                        {{-- per page select  --}}
                        <div class="flex justify-end items-center space-x-2 p-4 dark:bg-gray-800 ">

                            <select wire:model.live='perPage' id="commandesPerPage"
                                class="w-full md:w-auto flex items-center justify-center py-2 px-4 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-full border border-gray-200 hover:bg-gray-100 hover:text-primary-700 focus:z-10 focus:ring-4 focus:ring-gray-200 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700 focus:border-gray-600">
                                <option value="5">5</option>
                                <option value="10">10</option>
                                <option value="25">25</option>
                                <option value="50">50</option>
                                <option value="100">100</option>
                            </select>
                        </div>
                        <div class="flex items-center space-x-3 w-full md:w-auto">
                            {{-- sort button --}}
                            <x-sort-select :sortColumns="$sortColumns" />
                            {{-- filter button --}}
                            <x-filter-button :inputFilters="$inputFilters" />

                        </div>
                    </div>
                </div>
                <div class="flex  items-start justify-around py-2 mb-2 text-gray-600">
                    <h4 class="dark:text-gray-400">Total reste à payer : <span class="text-gray-800 dark:text-gray-200 font-semibold">{{ $totalC }}</span> </h4>
                    <h4 class="dark:text-gray-400">Total reste du budget : <span class="text-gray-800 dark:text-gray-200 font-semibold">{{ $totalB }}</span>
                    </h4>
                </div>
                <div class="overflow-x-auto">
                    <table class="text-nowrap w-full text-sm text-left text-gray-500 dark:text-gray-400">
                        <thead
                            class="text-xs text-nowrap text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                            <tr>
                                <th scope="col" class="px-4 w-fit py-3">REFERENCE RUBRIQUE</th>
                                <th scope="col" class="px-4 w-fit py-3">annee</th>
                                <th scope="col" class="px-4 w-fit py-3">BUDGET</th>
                                <th scope="col" class="px-4 w-fit py-3">total ttc</th>
                                <th scope="col" class="px-4 w-fit py-3">Nombre de Commandes</th>
                                <th scope="col" class="px-4 w-fit py-3">reste</th>
                            </tr>
                        </thead>
                        <tbody>

                            @foreach ($rubriques as $rubrique)
                                <tr class="border-b dark:border-gray-700">

                                    <td class="px-4 w-auto py-3"> {{ $rubrique->REFERENCE_RUBRIQUE }} </td>
                                    <td class="px-4 w-auto py-3"> {{ $rubrique->ANNEE_BUDGETAIRE }} </td>
                                    <td class="px-4 w-auto py-3"> {{ $rubrique->BUDGET }} </td>
                                    <td class="px-4 w-auto py-3"> {{ $rubrique->total_ttc }} </td>
                                    <td class="px-4 w-auto py-3"> {{ $rubrique->commandes->count() }} </td>
                                    <td class="px-4 w-auto py-3">
                                        {{ $rubrique->BUDGET - $rubrique->total_ttc }} </td>

                                </tr>
                            @endforeach

                        </tbody>
                    </table>
                </div>
                <div class="p-4">

                    {{ $rubriques->links('vendor.livewire.tailwind') }}
                </div>

            </div>
        </div>
    </section>
</div>
