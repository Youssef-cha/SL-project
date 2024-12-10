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

                        {{-- add product button --}}
                        <a href="{{ route('commandes.create') }}"
                            class="flex items-center justify-center text-white bg-primary-700 hover:bg-primary-800 focus:ring-4 focus:ring-primary-300 font-medium rounded-lg text-sm px-4 py-2 dark:bg-primary-600 dark:hover:bg-primary-700 focus:outline-none dark:focus:ring-primary-800">
                            <svg class="h-3.5 w-3.5 mr-2" fill="currentColor" viewbox="0 0 20 20"
                                xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                                <path clip-rule="evenodd" fill-rule="evenodd"
                                    d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z" />
                            </svg>
                            Add commande
                        </a>
                        <div class="flex items-center space-x-3 w-full md:w-auto">
                            {{-- sort button --}}
                            <div class="flex justify-end items-center space-x-2 p-4 dark:bg-gray-800 ">

                                <select wire:model.live='sort'
                                    class="w-full md:w-auto flex items-center justify-center py-2 px-4 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-primary-700 focus:z-10 focus:ring-4 focus:ring-gray-200 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700 focus:border-gray-600">
                                    <option value="NUM_COMMANDE">Numero de Commande</option>
                                    <option value="DATE_COMMANDE">Date Commande</option>
                                    <option value="DATE_VERIFICATION_RECEPTION">Date Verification</option>
                                    <option value="DATE_LIVRAISON">Date Livraison</option>
                                    <option value="EXERCICE">Exercice</option>
                                    <option value="HT">HT</option>
                                </select>
                            </div>


                            {{-- filter button --}}
                            <button id="filterDropdownButton" data-dropdown-toggle="filterDropdown"
                                class="w-full md:w-auto flex items-center justify-center py-2 px-4 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-primary-700 focus:z-10 focus:ring-4 focus:ring-gray-200 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700"
                                type="button">
                                <svg xmlns="http://www.w3.org/2000/svg" aria-hidden="true"
                                    class="h-4 w-4 mr-2 text-gray-400" viewbox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd"
                                        d="M3 3a1 1 0 011-1h12a1 1 0 011 1v3a1 1 0 01-.293.707L12 11.414V15a1 1 0 01-.293.707l-2 2A1 1 0 018 17v-5.586L3.293 6.707A1 1 0 013 6V3z"
                                        clip-rule="evenodd" />
                                </svg>
                                Filter
                                <svg class="-mr-1 ml-1.5 w-5 h-5" fill="currentColor" viewbox="0 0 20 20"
                                    xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                                    <path clip-rule="evenodd" fill-rule="evenodd"
                                        d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" />
                                </svg>
                            </button>
                            <div id="filterDropdown"
                                class="z-10 hidden w-80 p-3 bg-white rounded-lg shadow dark:bg-gray-700">
                                <h6 class="mb-3 text-sm font-medium text-gray-900 dark:text-white">filter</h6>
                                <ul class="space-y-2 text-sm" aria-labelledby="filterDropdownButton">
                                    @foreach ($inputFilters as $label => $filter)
                                        <li class="flex items-center">
                                            <label for="{{ $label }}"
                                                class="mr-4 text-sm font-medium text-gray-900 dark:text-gray-100">{{ $label }}</label>
                                            <select wire:model.defer="filters.{{ array_key_first($filter[0]->toArray()) }}"
                                                class="w-full md:w-auto flex items-center justify-center py-2 px-4 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-primary-700 focus:z-10 focus:ring-4 focus:ring-gray-200 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700 focus:border-gray-600">
                                                <option value="">tous</option>
                                                @foreach ($filter as $value)
                                                <option value="{{ $value[array_key_first($value->toArray())] }}">
                                                    {{ $value[array_key_first($value->toArray())] }}</option>
                                                @endforeach
                                            </select>
                                        </li>
                                    @endforeach
                                </ul>
                                <div class="w-full flex justify-center pt-5">
                                    <button wire:click="filter" type="button" class=" text-white bg-green-700 hover:bg-green-800 focus:outline-none focus:ring-4 focus:ring-green-300 font-medium rounded-full text-sm px-5 py-2.5 text-center me-2 mb-2 dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800">filter</button>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
                <div class="overflow-x-auto">
                    <table class="text-nowrap w-full text-sm text-left text-gray-500 dark:text-gray-400">
                        <thead class="text-xs text-nowrap text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                            <tr>
                                <th scope="col" class="px-4 w-fit py-3">Numero de commande</th>
                                <th scope="col" class="px-4 w-fit py-3">Avis achat</th>
                                <th scope="col" class="px-4 w-fit py-3">Type achat</th>
                                <th scope="col" class="px-4 w-fit py-3">Type budget</th>
                                <th scope="col" class="px-4 w-fit py-3">Objet achat</th>
                                <th scope="col" class="px-4 w-fit py-3">Reference rubrique</th>
                                <th scope="col" class="px-4 w-fit py-3">Fournisseur</th>
                                <th scope="col" class="px-4 w-fit py-3">Delai livraison</th>
                                <th scope="col" class="px-4 w-fit py-3">Garantie</th>
                                <th scope="col" class="px-4 w-fit py-3">Retenue garantie</th>
                                <th scope="col" class="px-4 w-fit py-3">Numero marche</th>
                                <th scope="col" class="px-4 w-fit py-3">Exercice</th>
                                <th scope="col" class="px-4 w-fit py-3">Date commande</th>
                                <th scope="col" class="px-4 w-fit py-3">Responsable dossier</th>
                                <th scope="col" class="px-4 w-fit py-3">Statut commande</th>
                                <th scope="col" class="px-4 w-fit py-3">Date livraison</th>
                                <th scope="col" class="px-4 w-fit py-3">Statut livraison</th>
                                <th scope="col" class="px-4 w-fit py-3">Lieu livraison</th>
                                <th scope="col" class="px-4 w-fit py-3">Date verification reception</th>
                                <th scope="col" class="px-4 w-fit py-3">Statut reception</th>
                                <th scope="col" class="px-4 w-fit py-3">Date depot SL</th>
                                <th scope="col" class="px-4 w-fit py-3">Numero facture</th>
                                <th scope="col" class="px-4 w-fit py-3">Date facture</th>
                                <th scope="col" class="px-4 w-fit py-3">HT</th>
                                <th scope="col" class="px-4 w-fit py-3">TTC</th>
                                <th scope="col" class="px-4 w-fit py-3">Taux TVA</th>
                                <th scope="col" class="px-4 w-fit py-3">Montant TVA</th>
                                <th scope="col" class="px-4 w-fit py-3">Date depot SC</th>
                                <th scope="col" class="px-4 w-fit py-3">Statut paiement</th>
                                <th scope="col" class="px-4 w-fit py-3">Montant paye</th>
                                <th scope="col" class="px-4 w-fit py-3">Date paiement</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($commandes as $commande)
                                <tr class="border-b dark:border-gray-700">

                                    <th class="px-4 w-auto py-3"> {{ $commande->NUM_COMMANDE }} </td>
                                    <td class="px-4 w-auto py-3"> {{ $commande->AVIS_ACHAT }} </td>
                                    <td class="px-4 w-auto py-3"> {{ $commande->TYPE_ACHAT }} </td>
                                    <td class="px-4 w-auto py-3"> {{ $commande->TYPE_BUDGET }} </td>
                                    <td class="px-4 w-auto py-3"> {{ $commande->OBJET_ACHAT }} </td>
                                    <td class="px-4 w-auto py-3"> {{ $commande->rubrique->REFERENCE_RUBRIQUE }} </td>
                                    <td class="px-4 w-auto py-3"> {{ $commande->fournisseur->nom_fournisseur }} </td>
                                    <td class="px-4 w-auto py-3"> {{ $commande->DELAI_LIVRAISON }} </td>
                                    <td class="px-4 w-auto py-3"> {{ $commande->GARANTIE }} </td>
                                    <td class="px-4 w-auto py-3"> {{ $commande->RETENUE_GARATIE }}</td>
                                    <td class="px-4 w-auto py-3"> {{ $commande->NUM_MARCHE }} </td>
                                    <td class="px-4 w-auto py-3"> {{ $commande->EXERCICE }} </td>
                                    <td class="px-4 w-auto py-3"> {{ $commande->DATE_COMMANDE }} </td>
                                    <td class="px-4 w-auto py-3"> {{ $commande->user->name }} </td>
                                    <td class="px-4 w-auto py-3"> {{ $commande->STATUT_COMMANDE }} </td>
                                    <td class="px-4 w-auto py-3"> {{ $commande->DATE_LIVRAISON }} </td>
                                    <td class="px-4 w-auto py-3"> {{ $commande->STATUT_LIVRAISON }} </td>
                                    <td class="px-4 w-auto py-3"> {{ $commande->LIEU_LIVRAISON }} </td>
                                    <td class="px-4 w-auto py-3"> {{ $commande->DATE_VERIFICATION_RECEPTION }} </td>
                                    <td class="px-4 w-auto py-3"> {{ $commande->STATUT_RECEPTION }} </td>
                                    <td class="px-4 w-auto py-3"> {{ $commande->DATE_DEPOT_SL }} </td>
                                    <td class="px-4 w-auto py-3"> {{ $commande->NUM_FACTURE }} </td>
                                    <td class="px-4 w-auto py-3"> {{ $commande->DATE_FACTURE }} </td>
                                    <td class="px-4 w-auto py-3"> {{ $commande->HT }} </td>
                                    <td class="px-4 w-auto py-3"> {{ $commande->TTC }} </td>
                                    <td class="px-4 w-auto py-3"> {{ $commande->TAUX_TVA }} </td>
                                    <td class="px-4 w-auto py-3"> {{ $commande->MONTANT_TVA }} </td>
                                    <td class="px-4 w-auto py-3"> {{ $commande->DATE_DEPOT_SC }} </td>
                                    <td class="px-4 w-auto py-3"> {{ $commande->STATUT_PAIEMENT }} </td>
                                    <td class="px-4 w-auto py-3"> {{ $commande->MONTANT_PAYE }} </td>
                                    <td class="px-4 w-auto py-3"> {{ $commande->DATE_PAIEMENT }} </td>
                                </tr>
                            @endforeach

                        </tbody>
                    </table>
                </div>
                <div class="p-4">

                    {{ $commandes->links('vendor.livewire.tailwind') }}
                </div>

            </div>
        </div>
    </section>
</div>
