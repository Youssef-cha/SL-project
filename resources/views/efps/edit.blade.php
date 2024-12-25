@extends('layouts.app')
@section('content')
    <x-session-success />
    <div class="py-8 px-4 mx-auto max-w-2xl lg:py-16">
        <h2 class="mb-4 text-xl font-bold text-gray-900 dark:text-white">modifier l'efp :
            {{ $efp->nom_efp }}</h2>
        <form method="POST" action="{{ route('efps.update', $efp->id) }}" class="form-container">
            @csrf
            @method('PUT')
            <x-form-fields-container>
                <x-form-input :update="$efp" label="nom d'efp" name="nom_efp" />
            </x-form-fields-container>
            <x-form-button route="complexes.efps.index" :param="$efp->complexe_id">
                Enregistrer
            </x-form-button>
        </form>
        <x-delete-confirmation resource="efps" :id="$efp->id">
            supprimer l'efp
        </x-delete-confirmation>
    </div>
@endsection
