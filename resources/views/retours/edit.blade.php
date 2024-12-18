
@extends('layouts.app')
@section('content')
    <x-session-success />


    <div class="py-8 px-4 mx-auto max-w-2xl lg:py-16">
        <h2 class="mb-4 text-xl font-bold text-gray-900 dark:text-white">Créer un Retour</h2>
        <form method="POST" action="{{ route("retours.update", $retour->id) }}" class="form-container">
            @csrf
            @method('PUT')
            <x-form-fields-container>
                <x-form-text-area :update="$retour" label="Motif" name="motif" />
                <x-form-input :update="$retour" type="date" label="Date retour" name="date_retour" />
            </x-form-fields-container>
            <x-form-button :param="$retour->commande->NUM_COMMANDE" route="commandes.retours.index">
                Enregistrer
            </x-form-button>
            
        </form>
        <x-delete-confirmation resource="retours" :id="$retour->id">
            supprimer la retour
        </x-delete-confirmation>
    </div>
@endsection
