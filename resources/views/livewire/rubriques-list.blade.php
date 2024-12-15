<div>
    <section class="bg-gray-50 dark:bg-gray-900 p-3 sm:p-5">
        <div class="mx-auto max-w-screen-xl px-4 lg:px-12">
            <!-- Start coding here -->
            <div class="bg-white dark:bg-gray-800 relative shadow-md sm:rounded-lg ">
                <div
                    class="flex flex-col lg:flex-row items-center justify-between space-y-3 md:space-y-0 md:space-x-4 p-4">
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

                        {{-- add button --}}
                        <a href="{{ route('rubriques.create') }}"
                            class="flex items-center justify-center text-white bg-primary-700 hover:bg-primary-800 focus:ring-4 focus:ring-primary-300 font-medium rounded-lg text-sm px-4 py-2 dark:bg-primary-600 dark:hover:bg-primary-700 focus:outline-none dark:focus:ring-primary-800">
                            <svg class="h-3.5 w-3.5 mr-2" fill="currentColor" viewbox="0 0 20 20"
                                xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                                <path clip-rule="evenodd" fill-rule="evenodd"
                                    d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z" />
                            </svg>
                            Rubrique
                        </a>

                    </div>
                </div>
                <div class="overflow-x-auto">
                    <table class="text-nowrap w-full text-sm text-left text-gray-500 dark:text-gray-400">
                        <thead
                            class="text-xs text-nowrap text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                            <tr>
                                <th scope="col" class="px-4 w-3 py-3"></th>
                                <th scope="col" class="px-4 w-fit py-3">Reference Rubrique</th>
                                <th scope="col" class="px-4 w-fit py-3">Annee Budgetaire</th>
                                <th scope="col" class="px-4 w-fit py-3">Budget</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($rubriques as $rubrique)
                                <tr class="border-b dark:border-gray-700">
                                    {{-- actions --}}
                                    <td class="px-2 py-3 flex items-center justify-end border-r border-gray-700">
                                        <button id="{{ $rubrique->id }}-button"
                                            class="dropdown-button inline-flex items-center p-0.5 text-sm font-medium text-center text-gray-500 hover:text-gray-800 rounded-lg focus:outline-none dark:text-gray-400 dark:hover:text-gray-100"
                                            type="button">
                                            <svg class="w-5 h-5" aria-hidden="true" fill="currentColor"
                                                viewbox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                                <path
                                                    d="M6 10a2 2 0 11-4 0 2 2 0 014 0zM12 10a2 2 0 11-4 0 2 2 0 014 0zM16 12a2 2 0 100-4 2 2 0 000 4z" />
                                            </svg>
                                        </button>
                                        <div id="{{ $rubrique->id }}"
                                            class="dropdown-menu absolute translate-y-10 translate-x-44 hidden h-auto z-40 w-44 bg-white rounded divide-y divide-gray-100 shadow dark:bg-gray-700 dark:divide-gray-600">
                                            <ul class="py-1 text-sm text-gray-700 dark:text-gray-200">

                                                <li>
                                                    <a href="{{ route("rubriques.edit",$rubrique->id) }}"
                                                        class="block py-2 px-4 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">modifier
                                                        la</a>
                                                </li>

                                            </ul>
                                        </div>
                                    </td>
                                    <th class="px-4 w-auto py-3"> {{ $rubrique->REFERENCE_RUBRIQUE }} </td>
                                    <th class="px-4 w-auto py-3"> {{ $rubrique->ANNEE_BUDGETAIRE }} </td>
                                    <td class="px-4 w-auto py-3"> {{ $rubrique->BUDGET }} </td>

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
