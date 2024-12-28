{{-- @dd($bonRetour->bonCommande->id)  --}}
@extends('layouts.app')
@section('content')
    <x-session-success />


    <div class="py-8 px-4 mx-auto max-w-2xl lg:py-16">
        <h2 class="mb-4 text-xl font-bold text-gray-900 dark:text-white">Créer un Retour</h2>
        <form method="POST" action={{ route('bonRetours.update', $bonRetour->id) }} class="form-container">

            @csrf
            @method('PUT')
            <x-form-fields-container>
                <x-form-text-area :update="$bonRetour" label="Motif" name="motif" />
                <x-form-input :update="$bonRetour" type="date" label="Date retour" name="date_retour" />

                <label class="col-span-2 inline-flex items-center cursor-pointer">
                    <input name="STATUT_RETOUR" value="resolue" type="checkbox" @checked((old('STATUT_RETOUR') ?? $bonRetour->STATUT_RETOUR) == 'resolue')
                        class="sr-only peer">
                    <div
                        class="relative w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-green-300 dark:peer-focus:ring-green-800 rounded-full peer dark:bg-gray-700 peer-checked:after:translate-x-full rtl:peer-checked:after:-translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:start-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all dark:border-gray-600 peer-checked:bg-green-600">
                    </div>
                    <span class="ms-3 text-sm font-medium text-gray-900 dark:text-gray-300">resolue</span>
                </label>


            </x-form-fields-container>
            <x-form-button :param="$bonRetour->bonCommande->id" route="bonCommandes.bonRetours.index">
                Enregistrer
            </x-form-button>

        </form>
    </div>
@endsection
