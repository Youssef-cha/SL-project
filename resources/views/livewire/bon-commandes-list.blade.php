@php
    if ($count == 0) {
        redirect()->route('bonCommandes.create');
    }
@endphp
<div>
    <section class="bg-gray-50 dark:bg-gray-900 p-3 sm:p-5">
        <div class="mx-auto max-w-screen-xl px-4 lg:px-12">
            <div class="bg-white dark:bg-gray-800 relative shadow-md sm:rounded-lg ">
                <div
                    class="flex flex-col lg:flex-row items-center justify-between space-y-3 md:space-y-0 md:space-x-4 p-4">
                    <div class="w-full md:w-1/2">
                        {{-- search bar --}}
                        <form class="flex items-center">
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

                            <select wire:model.live='perPage' id="bonCommandesPerPage"
                                class="w-full md:w-auto flex items-center justify-center py-2 px-4 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-full border border-gray-200 hover:bg-gray-100 hover:text-primary-700 focus:z-10 focus:ring-4 focus:ring-gray-200 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700 focus:border-gray-600">
                                <option value="5">5</option>
                                <option value="10">10</option>
                                <option value="25">25</option>
                                <option value="50">50</option>
                                <option value="100">100</option>
                            </select>
                        </div>

                        {{-- add item button --}}
                        <a href="{{ route('bonCommandes.create') }}" <a href="{{ route('bonCommandes.create') }}"
                            class="flex items-center justify-center text-white bg-primary-700 hover:bg-primary-800 focus:ring-4 focus:ring-primary-300 font-medium rounded-lg text-sm px-4 py-2 dark:bg-primary-600 dark:hover:bg-primary-700 focus:outline-none dark:focus:ring-primary-800">
                            <svg class="h-3.5 w-3.5 mr-2" fill="currentColor" viewbox="0 0 20 20"
                                xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                                <path clip-rule="evenodd" fill-rule="evenodd"
                                    d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z" />
                            </svg>
                            bon commande
                        </a>
                        <div class="flex items-center space-x-3 w-full md:w-auto">
                            <x-sort-select :sortColumns="$sortColumns" />



                            <x-filter-button :inputFilters="$inputFilters"></x-filter-button>
                        </div>
                    </div>
                </div>
                <div class="overflow-x-auto">
                    <table class="text-nowrap w-full text-sm text-left text-gray-500 dark:text-gray-400">
                        <thead
                            class="text-xs text-nowrap text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                            <tr>
                                <th scope="col" class="px-4 w-fit py-3"></th>
                                <th scope="col" class="px-4 w-fit py-3">bon commande</th>
                                <th scope="col" class="px-4 w-fit py-3">Avis achat</th>
                                <th scope="col" class="px-4 w-fit py-3">Type budget</th>
                                <th scope="col" class="px-4 w-fit py-3">Objet achat</th>
                                <th scope="col" class="px-4 w-fit py-3">Reference rubrique</th>
                                <th scope="col" class="px-4 w-fit py-3">Fournisseur</th>
                                <th scope="col" class="px-4 w-fit py-3">Delai livraison</th>
                                <th scope="col" class="px-4 w-fit py-3">Garantie</th>
                                <th scope="col" class="px-4 w-fit py-3">Retenue garantie</th>
                                <th scope="col" class="px-4 w-fit py-3">Exercice</th>
                                <th scope="col" class="px-4 w-fit py-3">Date commande</th>
                                <th scope="col" class="px-4 w-fit py-3">Responsable dossier</th>
                                <th scope="col" class="px-4 w-fit py-3">Date livraison</th>
                                <th scope="col" class="px-4 w-fit py-3">Status livraison</th>
                                <th scope="col" class="px-4 w-fit py-3">Lieu livraison</th>
                                <th scope="col" class="px-4 w-fit py-3">Status reception</th>
                                <th scope="col" class="px-4 w-fit py-3">Date verification reception</th>
                                <th scope="col" class="px-4 w-fit py-3">Date depot SL</th>
                                <th scope="col" class="px-4 w-fit py-3">Numero facture</th>
                                <th scope="col" class="px-4 w-fit py-3">Date facture</th>
                                <th scope="col" class="px-4 w-fit py-3">HT</th>
                                <th scope="col" class="px-4 w-fit py-3">TTC</th>
                                <th scope="col" class="px-4 w-fit py-3">Taux TVA</th>
                                <th scope="col" class="px-4 w-fit py-3">Montant TVA</th>
                                <th scope="col" class="px-4 w-fit py-3">Date depot SC</th>
                                <th scope="col" class="px-4 w-fit py-3">Status paiement</th>
                                <th scope="col" class="px-4 w-fit py-3">ov</th>
                                <th scope="col" class="px-4 w-fit py-3">op</th>
                                <th scope="col" class="px-4 w-fit py-3">Montant paye</th>
                                <th scope="col" class="px-4 w-fit py-3">Date paiement</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($bonCommandes as $bonCommande)
                                <tr class="border-b dark:border-gray-700">
                                    {{-- actions --}}
                                    <td class="px-2 py-3 flex items-center justify-end border-r dark:border-gray-700">
                                        <button id="{{ $bonCommande->id }}-button"
                                            class="dropdown-button inline-flex items-center p-0.5 text-sm font-medium text-center text-gray-500 hover:text-gray-800 rounded-lg focus:outline-none dark:text-gray-400 dark:hover:text-gray-100"
                                            type="button">
                                            <svg class="w-5 h-5" aria-hidden="true" fill="currentColor"
                                                viewbox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                                <path
                                                    d="M6 10a2 2 0 11-4 0 2 2 0 014 0zM12 10a2 2 0 11-4 0 2 2 0 014 0zM16 12a2 2 0 100-4 2 2 0 000 4z" />
                                            </svg>
                                        </button>
                                        <div id="{{ $bonCommande->id }}"
                                            class="dropdown-menu absolute translate-y-10 translate-x-44 hidden h-auto z-40 w-44 bg-white rounded divide-y divide-gray-100 shadow dark:bg-gray-700 dark:divide-gray-600">
                                            <ul class="py-1 text-sm text-gray-700 dark:text-gray-200">

                                                <li>
                                                    <a href="{{ route('bonCommandes.edit', $bonCommande->id) }}"
                                                        class="block py-2 px-4 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">modifier bon
                                                        commande</a>
                                                </li>
                                                <li>

                                                    <a href="{{ route('bonCommandes.edit', ['bonCommande' => $bonCommande->id, 'section' => 'livraison']) }}"
                                                        class="block py-2 px-4 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">modifier
                                                        livraison</a>
                                                </li>
                                                <li>
                                                    <a href="{{ route('bonCommandes.edit', ['bonCommande' => $bonCommande->id, 'section' => 'reception']) }}"
                                                        class="block py-2 px-4 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">modifier
                                                        reception</a>
                                                </li>
                                                <li>
                                                    <a href="{{ route('bonCommandes.edit', ['bonCommande' => $bonCommande->id, 'section' => 'depot']) }}"
                                                        class="block py-2 px-4 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">modifier
                                                        depot</a>
                                                </li>

                                                @if ($bonCommande->STATUT_PAIEMENT !== 'non payee')
                                                    <li>
                                                        <a href="{{ route('bonCommandes.edit', ['bonCommande' => $bonCommande->id, 'section' => 'paiement']) }}"
                                                            class="block py-2 px-4 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">modifier
                                                            paiement</a>
                                                    </li>
                                                @endif

                                                <li>
                                                    <a href="{{ route('bonCommandes.bonRetours.create', $bonCommande->id) }}"
                                                        class="block py-2 px-4 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">créer
                                                        un retour</a>
                                                </li>


                                                



                                            </ul>

                                        </div>
                                    </td>
                                    <td class="px-4 w-auto py-3"> {{ $bonCommande->numero_bon_commandes }} </td>
                                    <td class="px-4 w-auto py-3"> {{ $bonCommande->AVIS_ACHAT }} </td>
                                    <td class="px-4 w-auto py-3"> {{ $bonCommande->TYPE_BUDGET }} </td>
                                    <td class="px-4 w-auto py-3"> {{ $bonCommande->OBJET_ACHAT }} </td>
                                    <td class="px-4 w-auto py-3"> {{ $bonCommande->rubrique->REFERENCE_RUBRIQUE }}
                                    </td>
                                    <td class="px-4 w-auto py-3"> {{ $bonCommande->fournisseur->nom_fournisseur }}
                                    </td>
                                    <td class="px-4 w-auto py-3"> {{ $bonCommande->DELAI_LIVRAISON }} </td>
                                    <td class="px-4 w-auto py-3"> {{ $bonCommande->GARANTIE }} </td>
                                    <td class="px-4 w-auto py-3"> {{ $bonCommande->RETENUE_GARANTIE }}</td>
                                    <td class="px-4 w-auto py-3"> {{ $bonCommande->EXERCICE }} </td>
                                    <td class="px-4 w-auto py-3"> {{ $bonCommande->DATE_COMMANDE }} </td>
                                    <td class="px-4 w-auto py-3"> {{ $bonCommande->user->name }} </td>
                                    <td class="px-4 w-auto py-3"> {{ $bonCommande->DATE_LIVRAISON }} </td>
                                    <td class="px-4 w-auto py-3"> {{ $bonCommande->STATUT_LIVRAISON }} </td>
                                    <td class="px-4 w-auto py-3"> {{ $bonCommande->LIEU_LIVRAISON }} </td>
                                    <td class="px-4 w-auto py-3"> {{ $bonCommande->STATUT_RECEPTION }} </td>
                                    <td class="px-4 w-auto py-3"> {{ $bonCommande->DATE_VERIFICATION_RECEPTION }}
                                    </td>
                                    <td class="px-4 w-auto py-3"> {{ $bonCommande->DATE_DEPOT_SL }} </td>
                                    <td class="px-4 w-auto py-3"> {{ $bonCommande->NUM_FACTURE }} </td>
                                    <td class="px-4 w-auto py-3"> {{ $bonCommande->DATE_FACTURE }} </td>
                                    <td class="px-4 w-auto py-3"> {{ $bonCommande->HT }} </td>
                                    <td class="px-4 w-auto py-3"> {{ $bonCommande->TTC }} </td>
                                    <td class="px-4 w-auto py-3"> {{ $bonCommande->TAUX_TVA }} </td>
                                    <td class="px-4 w-auto py-3"> {{ $bonCommande->MONTANT_TVA }} </td>
                                    <td class="px-4 w-auto py-3"> {{ $bonCommande->DATE_DEPOT_SC }} </td>
                                    <td class="px-4 w-auto py-3"> {{ $bonCommande->STATUT_PAIEMENT }} </td>
                                    <td class="px-4 w-auto py-3"> {{ $bonCommande->ov }} </td>
                                    <td class="px-4 w-auto py-3"> {{ $bonCommande->op }} </td>

                                    <td class="px-4 w-auto py-3"> {{ $bonCommande->MONTANT_PAYE }} </td>
                                    <td class="px-4 w-auto py-3"> {{ $bonCommande->DATE_PAIEMENT }} </td>
                                </tr>
                            @endforeach

                        </tbody>
                    </table>
                </div>
                <div class="p-4">
                    {{ $bonCommandes->links('vendor.livewire.tailwind') }}
                </div>

            </div>
        </div>
    </section>
</div>
