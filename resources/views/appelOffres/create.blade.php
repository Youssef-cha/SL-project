@extends('layouts.app')
@section('content')
    <x-session-success />
    <div class="py-8 px-4 mx-auto max-w-2xl lg:py-16">
        <h2 class="mb-4 text-xl font-bold text-gray-900 dark:text-white">Créer un appel d'offre</h2>
        <form method="POST" action="{{ route('appelOffres.store') }}" class="form-container">
            @csrf
            <x-form-fields-container>
                <x-form-input label="numero d'appel d'offre" name="numero_appel_offre" />
            </x-form-fields-container>
            <x-form-button route="appelOffres.index">
                Enregistrer
            </x-form-button>
        </form>
    </div>
@endsection