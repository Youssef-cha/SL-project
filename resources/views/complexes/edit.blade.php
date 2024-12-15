@extends('layouts.app')
@section('content')
    <x-session-success />


    <!-- nom fournisseur -->
    <div class="py-8 px-4 mx-auto max-w-2xl lg:py-16">
        <h2 class="mb-4 text-xl font-bold text-gray-900 dark:text-white">modifier le Complexe: {{ $complexe->nom_complexe }}</h2>
        <form method="POST" action="{{ route('complexes.update' , $complexe->id) }}" class="form-container">
            @csrf
            @method('put')
            <x-form-fields-container>
                <x-form-input :update="$complexe" label="nom de complexe" name="nom_complexe" />
            </x-form-fields-container>
            <x-form-button>
                Enregistrer
            </x-form-button>
        </form>
        <x-delete-confirmation resource="complexes" :id="$complexe->id" >
            supprimer le complexe 
        </x-delete-confirmation>
    </div>
@endsection
