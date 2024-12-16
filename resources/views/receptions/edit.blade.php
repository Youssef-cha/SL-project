
@extends('layouts.app')
@section('content')
    <x-session-success />
    <div class="py-8 px-4 mx-auto max-w-2xl lg:py-16">
        <h2 class="mb-4 text-xl font-bold text-gray-900 dark:text-white">Modifier la reception :
            {{ $commande->NUM_COMMANDE }}</h2>
        <form method="POST" action="{{ route('receptions.update', $commande->NUM_COMMANDE) }}" class="form-container">
            @csrf
            @method('PUT')
            <x-form-fields-container>
                <x-form-input :update="$commande" value="réceptionnée" name="STATUT_RECEPTION" type="hidden" />
                <x-form-input :update="$commande" name="DATE_VERIFICATION_RECEPTION" type="date"
                    label="Date de vérification
                    reception :" />
                <x-form-input :update="$commande" name="DATE_DEPOT_SL" type="date" label="Date depot service logistique :" />
                <x-form-input :update="$commande" name="NUM_FACTURE" type="text" label="Numero de facture :" />
                <x-form-input :update="$commande" name="DATE_FACTURE" type="date" label="Date de facture :" />
                <x-form-input :update="$commande" name="HT" type="number" min="0" label="HT :" />
                <x-form-input :update="$commande" name="TTC" type="number" min="0" label="TTC :" />
                <x-form-input :update="$commande" name="TAUX_TVA" type="number" min="0" label="TAUX TVA :" />
                <x-form-input :update="$commande" name="MONTANT_TVA" type="number" min="0" label="Montant TVA :" />
            </x-form-fields-container>
            <x-form-button route="commandes.index" :param="$commande->NUM_COMMANDE">
                Enregistrer
            </x-form-button>
        </form>
    </div>
@endsection
