@extends('layouts.app')
@section('content')
    <x-session-success />


    <div class="py-8 px-4 mx-auto max-w-2xl lg:py-16">
        <h2 class="mb-4 text-xl font-bold text-gray-900 dark:text-white">Créer un efp</h2>
        <form method="POST" action="{{ route('complexes.efps.store', $complexe->id) }}" class="form-container">
            @csrf
            <x-form-fields-container>
                <x-form-input label="nom efp" name="nom_efp" />
            </x-form-fields-container>

            <x-form-button route="complexes.index">
                Enregistrer
            </x-form-button>

        </form>

    </div>
@endsection
