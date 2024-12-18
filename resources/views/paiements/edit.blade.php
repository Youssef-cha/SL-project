

@extends('layouts.app')
@section('content')
    <x-session-success />
    <div class="py-8 px-4 mx-auto max-w-2xl lg:py-16">
        <h2 class="mb-4 text-xl font-bold text-gray-900 dark:text-white">Modifier le paiement :
            {{ $commande->NUM_COMMANDE }}</h2>
        <form method="POST" action="{{ route('commandes.update', $commande->NUM_COMMANDE) }}" class="form-container">
            @csrf
            @method('PUT')
            <x-form-fields-container>
                <x-form-input value="paiement" name="update" type="hidden" />

                <x-form-input :update="$commande" name="oz" label="Numero OZ :" />
                <x-form-input :update="$commande" name="DATE_PAIEMENT" type="date" label="Date De Paiement :" />
                <x-form-input :update="$commande" name="MONTANT_PAYE" type="number" label="Montant Payee :" />
                <label class="col-span-2 inline-flex items-center cursor-pointer">
                    <input name="STATUT_PAIEMENT" value="payee" type="checkbox" @checked((old('STATUT_PAIEMENT') ?? $commande->STATUT_PAIEMENT) == 'payee')
                        class="sr-only peer">
                    <div
                        class="relative w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-green-300 dark:peer-focus:ring-green-800 rounded-full peer dark:bg-gray-700 peer-checked:after:translate-x-full rtl:peer-checked:after:-translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:start-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all dark:border-gray-600 peer-checked:bg-green-600">
                    </div>
                    <span class="ms-3 text-sm font-medium text-gray-900 dark:text-gray-300">payee</span>
                </label>
            </x-form-fields-container>
            <x-form-button route="commandes.index" :param="$commande->NUM_COMMANDE">
                Enregistrer
            </x-form-button>
        </form>
    </div>
@endsection
