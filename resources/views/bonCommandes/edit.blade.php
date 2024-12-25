@extends('layouts.app')
@section('content')
    <x-session-success></x-session-success>
    <div class="py-8 px-4 mx-auto max-w-2xl lg:py-16">
        <h2 class="mb-4 text-xl font-bold text-gray-900 dark:text-white">Modifier bon commande :
            {{ $bonCommande->numero_bon_commandes }}
        </h2>
        <form method="post" action="{{ route('bonCommandes.update', $bonCommande->id) }}" class="form-container">
            @csrf
            @method('PUT')
            <x-form-fields-container>
                @if (request()->section == 'livraison')
                    <x-form-input value="livraison" name="update" type="hidden" />
                    <x-form-input :update="$bonCommande" value="Livrée" name="STATUT_LIVRAISON" type="hidden" />
                    <x-form-input :update="$bonCommande" name="DATE_LIVRAISON" type="date" label="Date De Livraison" />
                    <x-form-text-area :update="$bonCommande" name="LIEU_LIVRAISON" label="Lieu De Livraison" />
                @elseif (request()->section == 'reception')
                    {{-- reception --}}
                    <x-form-input value="reception" name="update" type="hidden" />
                    <x-form-input :update="$bonCommande" value="réceptionnée" name="STATUT_RECEPTION" type="hidden" />
                    <x-form-input :update="$bonCommande" name="DATE_VERIFICATION_RECEPTION" type="date"
                        label="Date de vérification reception :" />
                    <x-form-input :update="$bonCommande" name="DATE_DEPOT_SL" type="date"
                        label="Date depot service logistique :" />
                    <x-form-input :update="$bonCommande" name="NUM_FACTURE" type="text" label="Numero de facture :" />
                    <x-form-input :update="$bonCommande" name="DATE_FACTURE" type="date" label="Date de facture :" />
                    <x-form-input :update="$bonCommande" name="HT" type="number" min="0" label="HT :" />
                    <x-form-input :update="$bonCommande" name="TTC" type="number" min="0" label="TTC :" />
                    <x-form-input :update="$bonCommande" name="TAUX_TVA" type="number" min="0" label="TAUX TVA :" />
                    <x-form-input :update="$bonCommande" name="MONTANT_TVA" type="number" min="0"
                        label="Montant TVA :" />
                @elseif (request()->section == 'depot')
                    {{-- depot --}}
                    <x-form-input value="depot" name="update" type="hidden" />
                    <x-form-input :update="$bonCommande" value="deposee" name="STATUT_PAIEMENT" type="hidden" />
                    <x-form-input :update="$bonCommande" name="DATE_DEPOT_SC" type="date"
                        label="Date Depot Service Comptabilite :" />
                @elseif (request()->section == 'paiement')
                    {{-- paiement  --}}
                    <x-form-input value="paiement" name="update" type="hidden" />
                    <x-form-input :update="$bonCommande" name="ov" label="Numero OV :" />
                    <x-form-input :update="$bonCommande" name="op" label="Numero OP :" />
                    <x-form-input :update="$bonCommande" name="DATE_PAIEMENT" type="date" label="Date De Paiement :" />
                    <x-form-input :update="$bonCommande" name="MONTANT_PAYE" type="number" label="Montant Payee :" />
                    <label class="col-span-2 inline-flex items-center cursor-pointer">
                        <input name="STATUT_PAIEMENT" value="payee" type="checkbox" @checked((old('STATUT_PAIEMENT') ?? $bonCommande->STATUT_PAIEMENT) == 'payee')
                            class="sr-only peer">
                        <div
                            class="relative w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-green-300 dark:peer-focus:ring-green-800 rounded-full peer dark:bg-gray-700 peer-checked:after:translate-x-full rtl:peer-checked:after:-translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:start-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all dark:border-gray-600 peer-checked:bg-green-600">
                        </div>
                        <span class="ms-3 text-sm font-medium text-gray-900 dark:text-gray-300">payee</span>
                    </label>
                @else
                    {{-- commandes --}}
                    <x-form-input :update="$bonCommande" label="avis achat" name="AVIS_ACHAT" />
                    <x-form-text-area :update="$bonCommande" label="Objet d'achat" name="OBJET_ACHAT" />
                    <x-form-select  label="Type Budget" name="TYPE_BUDGET">
                        @foreach ($budgetTypes as $budgetType)
                            <option @selected((old('TYPE_BUDGET') ?? $bonCommande->TYPE_BUDGET) == $budgetType) value="{{ $budgetType }}">{{ $budgetType }}</option>
                        @endforeach
                    </x-form-select>
                    <x-form-select :half="true" label="Référence Rubrique" name="rubrique_id">
                        @foreach ($rubriques as $rubrique)
                            <option @selected((old('rubrique_id') ?? $bonCommande->rubrique_id) == $rubrique->id) value="{{ $rubrique->id }}">
                                {{ $rubrique->REFERENCE_RUBRIQUE }}</option>
                        @endforeach
                    </x-form-select>
                    <x-form-select :half="true" label="efp" name="efp_id">
                        @foreach ($efps as $efp)
                            <option @selected((old('efp_id') ?? $bonCommande->efp_id) == $efp->id) value="{{ $efp->id }}">
                                {{ $efp->nom_efp }}</option>
                        @endforeach
                    </x-form-select>
                    <x-form-select :half="true" label="fournisseur" name="fournisseur_id">
                        @foreach ($fournisseurs as $fournisseur)
                            <option @selected((old('fournisseur_id') ?? $bonCommande->fournisseur_id) == $fournisseur->id) value="{{ $fournisseur->id }}">
                                {{ $fournisseur->nom_fournisseur }}</option>
                        @endforeach
                    </x-form-select>
                    <x-form-input :update="$bonCommande" :half="true" type="number" min="0"
                        label="Délai de livraison" name="DELAI_LIVRAISON" />
                    <div class="flex flex-col  justify-start space-y-1">

                        <label class=" inline-flex items-center cursor-pointer">
                            <input id="garantie" name="GARANTIE" type="checkbox" value="oui"
                                @checked((old('GARANTIE') ?? $bonCommande->GARANTIE) == 'oui') class="sr-only peer">
                            <div
                                class="relative w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-green-300 dark:peer-focus:ring-green-800 rounded-full peer dark:bg-gray-700 peer-checked:after:translate-x-full rtl:peer-checked:after:-translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:start-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all dark:border-gray-600 peer-checked:bg-green-600">
                            </div>
                            <span class="ms-3 text-sm font-medium text-gray-900 dark:text-gray-300">Garantie</span>
                        </label>
                        <x-form-input :update="$bonCommande" id="retenue" type="number" min="0"
                            name="RETENUE_GARANTIE" placeholder="Retenue Garantie" />

                    </div>
                    <x-form-input :update="$bonCommande" :half="true" type="number" min="" label="Exercice"
                        name="EXERCICE" />
                    <x-form-input :update="$bonCommande" type="date" label="Date commande" name="DATE_COMMANDE" />
                    {{-- <label class="col-span-2 inline-flex items-center cursor-pointer">
                        <input name="STATUT_COMMANDE" type="checkbox" value="annulee" @checked((old('STATUT_COMMANDE') ?? $bonCommande->STATUT_COMMANDE) == 'annulee')
                            class="sr-only peer">
                        <div
                            class="relative w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-green-300 dark:peer-focus:ring-green-800 rounded-full peer dark:bg-gray-700 peer-checked:after:translate-x-full rtl:peer-checked:after:-translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:start-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all dark:border-gray-600 peer-checked:bg-green-600">
                        </div>
                        <span class="ms-3 text-sm font-medium text-gray-900 dark:text-gray-300">commande annulee</span>
                    </label> --}}
                @endif
            </x-form-fields-container>
            <x-form-button route="bonCommandes.index">
                Enregistrer
            </x-form-button>
        </form>
    </div>
@endsection
