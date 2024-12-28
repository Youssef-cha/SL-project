@extends('layouts.app')
@section('content')
    <x-session-success />


    <div class="py-8 px-4 mx-auto max-w-2xl lg:py-16">
        <h2 class="mb-4 text-xl font-bold text-gray-900 dark:text-white">Créer un Retour</h2>
        <form method="POST" action="{{ route("bonCommandes.bonRetours.store", $bonCommande->id) }}" class="form-container">
            @csrf
            <x-form-fields-container>
                <x-form-text-area label="Motif" name="motif" />
                <x-form-input value="a resoudre" name="STATUT_RETOUR" type="hidden" />
                <x-form-input type="date" label="Date retour" name="date_retour" />
            </x-form-fields-container>
            <x-form-button :param="$bonCommande->id" route="bonCommandes.bonRetours.index">
                Enregistrer
            </x-form-button>
        </form>
    </div>
@endsection
