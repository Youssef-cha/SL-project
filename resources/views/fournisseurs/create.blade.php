@extends('layouts.app')
@section('content')

<x-session-success />


    <!-- nom fournisseur -->
    <div class="py-8 px-4 mx-auto max-w-2xl lg:py-16">
        <h2 class="mb-4 text-xl font-bold text-gray-900 dark:text-white">Créer un Fournisseur</h2>
        <form method="POST" action="{{ route('fournisseurs.store') }}" class="form-container">
            @csrf
            <x-form-fields-container>
                <x-form-input label="nom de fournisseur" name="nom_fournisseur" />
            </x-form-fields-container>
            <x-form-button>
                Enregistrer
            </x-form-button>
        </form>
    </div>
@endsection
