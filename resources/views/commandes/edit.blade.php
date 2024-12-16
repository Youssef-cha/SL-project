@extends('layouts.app')
@section('content')

    <x-session-success></x-session-success>
    <!-- numéro de commande -->
    <div class="py-8 px-4 mx-auto max-w-2xl lg:py-16">
        <h2 class="mb-4 text-xl font-bold text-gray-900 dark:text-white">Modifier Commande</h2>
        <form method="post" action="{{ route('commandes.update', $commande->NUM_COMMANDE) }}" class="form-container">
            @csrf
            @method('PUT')
            <x-form-fields-container>

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
                <x-form-input :update="$commande" label="Numéro appel d'offre" name="AVIS_ACHAT" />
                <x-form-select :half="true" label="Référence Rubrique" name="rubrique_id">
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
                <x-form-input :update="$commande" :half="true" type="number" min="0" label="Délai de livraison"
                    name="DELAI_LIVRAISON" />
                <div class="flex flex-col  justify-start space-y-1">

                    <label class=" inline-flex items-center cursor-pointer">
                        <input id="garantie" name="GARANTIE" type="checkbox" value="oui" @checked((old('GARANTIE') ?? $commande->GARANTIE) == 'oui')
                            class="sr-only peer">
                        <div
                            class="relative w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-green-300 dark:peer-focus:ring-green-800 rounded-full peer dark:bg-gray-700 peer-checked:after:translate-x-full rtl:peer-checked:after:-translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:start-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all dark:border-gray-600 peer-checked:bg-green-600">
                        </div>
                        <span class="ms-3 text-sm font-medium text-gray-900 dark:text-gray-300">Garantie</span>
                    </label>
                    <x-form-input :update="$commande" id="retenue" type="number" min="0" name="RETENUE_GARANTIE"
                        placeholder="Retenue Garantie" />

                </div>
                <x-form-input :update="$commande" :half="true" label="Numéro de marché" name="NUM_MARCHE" />
                <x-form-input :update="$commande" :half="true" type="date" label="Date commande"
                    name="DATE_COMMANDE" />
                <x-form-input :update="$commande" :half="true" type="number" min="" label="Exercice"
                    name="EXERCICE" />
                <label class="col-span-2 inline-flex items-center cursor-pointer">
                    <input name="STATUT_COMMANDE" type="checkbox" value="annulee" @checked((old('STATUT_COMMANDE') ?? $commande->STATUT_COMMANDE) == 'annulee')
                        class="sr-only peer">
                    <div
                        class="relative w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-green-300 dark:peer-focus:ring-green-800 rounded-full peer dark:bg-gray-700 peer-checked:after:translate-x-full rtl:peer-checked:after:-translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:start-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all dark:border-gray-600 peer-checked:bg-green-600">
                    </div>
                    <span class="ms-3 text-sm font-medium text-gray-900 dark:text-gray-300">commande annulee</span>
                </label>
            </x-form-fields-container>
            <x-form-button route="commandes.index">
                Enregistrer
            </x-form-button>
        </form>
    </div>
@endsection
