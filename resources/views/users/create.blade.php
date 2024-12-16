@extends('layouts.app')
@section('content')
    <x-session-success />
    <div class="py-8 px-4 mx-auto max-w-2xl lg:py-16">
        <h2 class="mb-4 text-xl font-bold text-gray-900 dark:text-white">Créer un responsable</h2>
        <form method="POST" action="{{ route('users.store') }}" class="form-container">
            @csrf
            <x-form-fields-container>
                <x-form-input  label="nom responsable" name="name" />
                <x-form-input type="email" label="email" name="email" />
                <x-form-input type="password" label="mot de passe" name="password" />
                <x-form-input type="password" label="confirmer le mot de passe" name="password_confirmation" />
            </x-form-fields-container>
            <x-form-button route="home">
                Créer le Compte
            </x-form-button>
        </form>
    </div>
@endsection
