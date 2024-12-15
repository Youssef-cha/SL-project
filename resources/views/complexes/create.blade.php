@extends('layouts.app')
@section('content')
    <x-session-success />


    <!-- nom fournisseur -->
    <div class="py-8 px-4 mx-auto max-w-2xl lg:py-16">
        <h2 class="mb-4 text-xl font-bold text-gray-900 dark:text-white">Créer un Complexe</h2>
        <form method="POST" action="{{ route('complexes.store') }}" class="form-container">
            @csrf
            <x-form-fields-container>
                <x-form-input label="nom complexe" name="nom_complexe" />
            </x-form-fields-container>
            <x-form-button>
                Enregistrer
            </x-form-button>
        </form>
    </div>
@endsection
