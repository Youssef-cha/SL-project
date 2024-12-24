@extends('layouts.app')
@section('content')
    <x-session-success />

    <div class="py-8 px-4 mx-auto max-w-2xl lg:py-16">
        <h2 class="mb-4 text-xl font-bold text-gray-900 dark:text-white">Créer un Marche</h2>
        <form method="POST" action="{{ route('marches.update', $marche->id) }}"
            class="form-container">
            @csrf
            @method('PUT')
            <x-form-fields-container>
                <x-form-input :update="$marche" label="numero de marche" name="numero_marche" />
                <x-form-select name="TYPE_ACHAT" label="Type de marche">
                    <option @selected((old('TYPE_ACHAT') ?? $marche->TYPE_ACHAT ) == 'Marche') value="Marche">Marche</option>
                    <option @selected((old('TYPE_ACHAT') ?? $marche->TYPE_ACHAT ) == 'Marche Cadre') value="Marche Cadre">Marche Cadre</option>
                    <option @selected((old('TYPE_ACHAT') ?? $marche->TYPE_ACHAT ) == 'Marche Recondictible') value="Marche Recondictible">Marche Recondictible</option>
                    <option @selected((old('TYPE_ACHAT') ?? $marche->TYPE_ACHAT ) == 'Contrat/Convention') value="Contrat/Convention">Contrat/Convention</option>
                </x-form-select>
            </x-form-fields-container>
            <x-form-button route="appelOffres.marches.index" :param="$marche->numero_appel_offre">
                Enregistrer
            </x-form-button>
        </form>
        <x-delete-confirmation resource="marches" :id="$marche->id">
            supprimer le marche
        </x-delete-confirmation>
    </div>
@endsection