@extends('layouts.app')
@section('content')
    <x-session-success />
    <div class="py-8 px-4 mx-auto max-w-2xl lg:py-16">
        <h2 class="mb-4 text-xl font-bold text-gray-900 dark:text-white">modifier le Fournisseur :
            {{ $fournisseur->nom_fournisseur }}</h2>
        <form method="POST" action="{{ route('fournisseurs.update', $fournisseur->id) }}" class="form-container">
            @csrf
            @method('PATCH')
            <x-form-fields-container>
                <x-form-input :update="$fournisseur" label="nom de fournisseur" name="nom_fournisseur" />
            </x-form-fields-container>
            <x-form-button route="fournisseurs.index">
                Enregistrer
            </x-form-button>
        </form>
        <!-- Modal toggle -->


        <!-- Main modal -->
        <x-delete-confirmation resource="fournisseurs" :id="$fournisseur->id">
            supprimer le founisseur
        </x-delete-confirmation>
    </div>
@endsection
