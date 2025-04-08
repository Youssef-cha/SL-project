@extends('layouts.app')
@section('content')
    <x-session-success />


    <!-- nom fournisseur -->
    <div class="py-8 px-4 mx-auto max-w-2xl lg:py-16">
        <h2 class="mb-4 text-xl font-bold text-gray-900 dark:text-white">Créer une Rubrique</h2>
        <form method="POST" action="{{ route('rubriques.store') }}" class="form-container">
            @csrf
            <x-form-fields-container>
                <x-form-input label="Référence Rubrique" name="REFERENCE_RUBRIQUE" />
                <x-form-input label="Année Budgétaire" type="number" min="4" name="ANNEE_BUDGETAIRE" />
                <x-form-input type="number" label="Budget" name="BUDGET" />
            </x-form-fields-container>
            <x-form-button route="rubriques.index">
                Enregistrer
            </x-form-button>
        </form>
    </div>
@endsection
