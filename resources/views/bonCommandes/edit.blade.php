@extends('layouts.app')
@section('content')
    <x-session-success></x-session-success>
    <div class="py-8 px-4 mx-auto max-w-2xl lg:py-16">
        <h2 class="mb-4 text-xl font-bold text-gray-900 dark:text-white">Modifier La Commande : {{ $commande->NUM_COMMANDE }}
        </h2>
        <form method="post" action="{{ route('commandes.update', $commande->NUM_COMMANDE) }}" class="form-container">
            @csrf
            @method('PUT')
            <x-form-fields-container>
                @if (request()->section == 'livraison')
                    <x-form-input value="livraison" name="update" type="hidden" />
                    <x-form-input :update="$commande" value="Livrée" name="STATUT_LIVRAISON" type="hidden" />
                    <x-form-input :update="$commande" name="DATE_LIVRAISON" type="date" label="Date De Livraison" />
                    <x-form-text-area :update="$commande" name="LIEU_LIVRAISON" label="Lieu De Livraison" />
                @elseif (request()->section == 'reception')
{{-- reception --}}
                    <x-form-input value="reception" name="update" type="hidden" />
                    <x-form-input :update="$commande" value="réceptionnée" name="STATUT_RECEPTION" type="hidden" />
                    <x-form-input :update="$commande" name="DATE_VERIFICATION_RECEPTION" type="date"
                        label="Date de vérification reception :" />
                    <x-form-input :update="$commande" name="DATE_DEPOT_SL" type="date"
                        label="Date depot service logistique :" />
                    <x-form-input :update="$commande" name="NUM_FACTURE" type="text" label="Numero de facture :" />
                    <x-form-input :update="$commande" name="DATE_FACTURE" type="date" label="Date de facture :" />
                    <x-form-input :update="$commande" name="HT" type="number" min="0" label="HT :" />
                    <x-form-input :update="$commande" name="TTC" type="number" min="0" label="TTC :" />
                    <x-form-input :update="$commande" name="TAUX_TVA" type="number" min="0" label="TAUX TVA :" />
                    <x-form-input :update="$commande" name="MONTANT_TVA" type="number" min="0"
                        label="Montant TVA :" />
                @elseif (request()->section == 'depot')
{{-- depot --}}
                    <x-form-input value="depot" name="update" type="hidden" />
                    <x-form-input :update="$commande" value="deposee" name="STATUT_PAIEMENT" type="hidden" />
                    <x-form-input :update="$commande" name="DATE_DEPOT_SC" type="date"
                        label="Date Depot Service Comptabilite :" />
                @elseif (request()->section == 'paiement')
{{-- paiement  --}}
                    <x-form-input :update="$commande" name="oz" label="Numero OV :" />
                    <x-form-input value="paiement" name="update" type="hidden" />
                    <x-form-input :update="$commande" name="oz" label="Numero OZ :" />
                    <x-form-input :update="$commande" name="DATE_PAIEMENT" type="date" label="Date De Paiement :" />
                    <x-form-input :update="$commande" name="MONTANT_PAYE" type="number" label="Montant Payee :" />
                    <label class="col-span-2 inline-flex items-center cursor-pointer">
                        <input name="STATUT_PAIEMENT" value="payee" type="checkbox" @checked((old('STATUT_PAIEMENT') ?? $commande->STATUT_PAIEMENT) == 'payee')
                            class="sr-only peer">
                        <div
                            class="relative w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-green-300 dark:peer-focus:ring-green-800 rounded-full peer dark:bg-gray-700 peer-checked:after:translate-x-full rtl:peer-checked:after:-translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:start-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all dark:border-gray-600 peer-checked:bg-green-600">
                        </div>
                        <span class="ms-3 text-sm font-medium text-gray-900 dark:text-gray-300">payee</span>
                    </label>
                @else
                    {{-- commandes --}}
                    <x-form-select :half="true" label="Type Achat" name="TYPE_ACHAT">
                        @foreach ($achatTypes as $achatType)
                            <option @selected((old('TYPE_ACHAT') ?? $commande->TYPE_ACHAT) == $achatType) value="{{ $achatType }}">{{ $achatType }}</option>
                        @endforeach
                    </x-form-select>
                    <x-form-select :half="true" label="Type Budget" name="TYPE_BUDGET">
                        @foreach ($budgetTypes as $budgetType)
                            <option @selected((old('TYPE_BUDGET') ?? $commande->TYPE_BUDGET) == $budgetType) value="{{ $budgetType }}">{{ $budgetType }}</option>
                        @endforeach

                    </x-form-select>
                    <x-form-text-area :update="$commande" label="Objet d'achat" name="OBJET_ACHAT" />
                    <x-form-select :update="$commande" label="Numéro appel d'offre" name="numero_appel_offre">
                        @foreach ($appelOffres as $appelOffres)
                            <option @selected((old('numero_appel_offre') ?? $commande->numero_appel_offre) == $appelOffres->numero_appel_offre) value="{{ $appelOffres->numero_appel_offre }}">
                                {{ $appelOffres->numero_appel_offre }}</option>
                        @endforeach

                    </x-form-select> <x-form-select :half="true" label="Référence Rubrique" name="rubrique_id">
                        @foreach ($rubriques as $rubrique)
                            <option @selected((old('rubrique_id') ?? $commande->rubrique_id) == $rubrique->id) value="{{ $rubrique->id }}">
                                {{ $rubrique->REFERENCE_RUBRIQUE }}</option>
                        @endforeach
                    </x-form-select>
                    <x-form-select :half="true" label="efp" name="efp_id">
                        @foreach ($efps as $efp)
                            <option @selected((old('efp_id') ?? $commande->efp_id) == $efp->id) value="{{ $efp->id }}">
                                {{ $efp->nom_efp }}</option>
                        @endforeach
                    </x-form-select>
                    <x-form-select :half="true" label="fournisseur" name="fournisseur_id">
                        @foreach ($fournisseurs as $fournisseur)
                            <option @selected((old('fournisseur_id') ?? $commande->fournisseur_id) == $fournisseur->id) value="{{ $fournisseur->id }}">
                                {{ $fournisseur->nom_fournisseur }}</option>
                        @endforeach
                    </x-form-select>
                    <x-form-input :update="$commande" :half="true" type="number" min="0"
                        label="Délai de livraison" name="DELAI_LIVRAISON" />
                    <div class="flex flex-col  justify-start space-y-1">

                        <label class=" inline-flex items-center cursor-pointer">
                            <input id="garantie" name="GARANTIE" type="checkbox" value="oui"
                                @checked((old('GARANTIE') ?? $commande->GARANTIE) == 'oui') class="sr-only peer">
                            <div
                                class="relative w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-green-300 dark:peer-focus:ring-green-800 rounded-full peer dark:bg-gray-700 peer-checked:after:translate-x-full rtl:peer-checked:after:-translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:start-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all dark:border-gray-600 peer-checked:bg-green-600">
                            </div>
                            <span class="ms-3 text-sm font-medium text-gray-900 dark:text-gray-300">Garantie</span>
                        </label>
                        <x-form-input :update="$commande" id="retenue" type="number" min="0"
                            name="RETENUE_GARANTIE" placeholder="Retenue Garantie" />

                    </div>
                    <x-form-input :update="$commande" :half="true" type="number" min="" label="Exercice"
                        name="EXERCICE" />
                    <x-form-input :update="$commande" type="date" label="Date commande" name="DATE_COMMANDE" />
                    <label class="col-span-2 inline-flex items-center cursor-pointer">
                        <input name="STATUT_COMMANDE" type="checkbox" value="annulee" @checked((old('STATUT_COMMANDE') ?? $commande->STATUT_COMMANDE) == 'annulee')
                            class="sr-only peer">
                        <div
                            class="relative w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-green-300 dark:peer-focus:ring-green-800 rounded-full peer dark:bg-gray-700 peer-checked:after:translate-x-full rtl:peer-checked:after:-translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:start-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all dark:border-gray-600 peer-checked:bg-green-600">
                        </div>
                        <span class="ms-3 text-sm font-medium text-gray-900 dark:text-gray-300">commande annulee</span>
                    </label>
                @endif
            </x-form-fields-container>
            <x-form-button route="commandes.index">
                Enregistrer
            </x-form-button>
        </form>
    </div>
@endsection
