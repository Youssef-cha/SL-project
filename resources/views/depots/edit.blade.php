@extends('layouts.app')
@section('content')
    <x-session-success />
    <div class="py-8 px-4 mx-auto max-w-2xl lg:py-16">
        <h2 class="mb-4 text-xl font-bold text-gray-900 dark:text-white">Modifier le depot :
            {{ $commande->NUM_COMMANDE }}</h2>
        <form method="POST" action="{{ route('depots.update', $commande->NUM_COMMANDE) }}" class="form-container">
            @csrf
            @method('PUT')
            <x-form-fields-container>
                <x-form-input value="deposee" name="STATUT_PAIEMENT" type="hidden"/>
                <x-form-input name="DATE_DEPOT_SC" type="date" label="Date Depot Service Comptabilite :"/>
            </x-form-fields-container>
            <x-form-button>
                Enregistrer
            </x-form-button>
        </form>
    </div>
@endsection
