@extends('layouts.app')
@section('content')
    <x-session-success />
    <div class="py-8 px-4 mx-auto max-w-2xl lg:py-16">
        <h2 class="mb-4 text-xl font-bold text-gray-900 dark:text-white">Modifier la livraison :
            {{ $commande->NUM_COMMANDE }}</h2>
        <form method="POST" action="{{ route('livraisons.update', $commande->NUM_COMMANDE) }}" class="form-container">
            @csrf
            @method('PUT')
            <x-form-fields-container>
                <x-form-input :update="$commande" value="Livrée" name="STATUT_LIVRAISON" type="hidden" />
                <x-form-input :update="$commande" name="DATE_LIVRAISON" type="date" label="Date De Livraison"/>
                <x-form-text-area :update="$commande" name="LIEU_LIVRAISON" label="Lieu De Livraison"/>
            </x-form-fields-container>
            <x-form-button route="commandes.index" :param="$commande->NUM_COMMANDE" >
                Enregistrer
            </x-form-button>
        </form>
    </div>
@endsection
