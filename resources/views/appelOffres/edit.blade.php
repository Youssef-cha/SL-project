@extends('layouts.app')
@section('content')
    <x-session-success />
    <div class="py-8 px-4 mx-auto max-w-2xl lg:py-16">
        <h2 class="mb-4 text-xl font-bold text-gray-900 dark:text-white">Créer un appel d'offre</h2>
        <form method="POST" action="{{ route('appelOffres.update', $appelOffre->numero_appel_offre) }}" class="form-container">
            @csrf
            @method('PUT')
            <x-form-fields-container>
                <x-form-input :update="$appelOffre" label="numero de marche" name="numero_marche" />
            </x-form-fields-container>
            <x-form-button route="appelOffres.index">
                Enregistrer
            </x-form-button>
        </form>
        <x-delete-confirmation resource="appelOffres" :id="$appelOffre->numero_appel_offre" >
            supprimer l'appel d'offre
        </x-delete-confirmation>
    </div>
@endsection