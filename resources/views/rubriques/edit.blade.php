@extends('layouts.app')
@section('content')
    <x-session-success />
    <div class="py-8 px-4 mx-auto max-w-2xl lg:py-16">
        <h2 class="mb-4 text-xl font-bold text-gray-900 dark:text-white">Modifier la Rubrique: {{ $rubrique->REFERENCE_RUBRIQUE }}/{{ $rubrique->ANNEE_BUDGETAIRE }}</h2>
        <form method="POST" action="{{ route('rubriques.update', $rubrique->id) }}" class="form-container">
            @csrf
            @method('PATCH')
            <x-form-fields-container>
                <x-form-input type="number" label="Budget" name="BUDGET" />
            </x-form-fields-container>
            <x-form-button route="rubriques.index">
                Enregistrer
            </x-form-button>
        </form>
        <x-delete-confirmation resource="rubriques" :id="$rubrique->id">
            supprimer la rubrique
        </x-delete-confirmation>
    </div>
@endsection
