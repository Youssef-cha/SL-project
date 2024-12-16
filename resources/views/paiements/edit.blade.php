{{-- @extends('layouts.app')
@section('content')
    <div class="box-form">
        <h1>Paiement</h1>
        @session('success')
            <div class="pop-up">
                {{ $value }}
            </div>
        @endsession
        <form method="post" action="{{route('paiements.update', $commande->NUM_COMMANDE)}}" class="form-container">
            @csrf
            @method("PUT")
            
            
            <div class="inputBx2">
                <p class="label-title">payee</p>
                <div class="radio-group">
                    <div>
                        <input id="STATUT_PAIEMENToui" @checked($commande->STATUT_PAIEMENT == 'payee') name="STATUT_PAIEMENT" type="radio" value="payee">
                        <label for="STATUT_PAIEMENToui" class="radio-label">Oui</label>
                    </div>
                    <div>
                        <input id="STATUT_PAIEMENTnon" name="STATUT_PAIEMENT" type="radio" @checked($commande->STATUT_PAIEMENT == 'deposee') value="deposee">
                        <label for="STATUT_PAIEMENTnon" class="radio-label">Non</label>
                    </div>
                </div>
                @error('STATUT_PAIEMENT')
                    <p style="color: red;">{{ $message }}</p>
                @enderror
            </div>

            

            <button type="submit" class="btn">Enregistrer</button>
            <a href="{{route("commandesUpdate.index")}}" class="btn2">retour</a>
        </form>
    </div>
    <script src="{{ asset('js/script.js') }}"></script>
@endsection --}}


@extends('layouts.app')
@section('content')
    <x-session-success />
    <div class="py-8 px-4 mx-auto max-w-2xl lg:py-16">
        <h2 class="mb-4 text-xl font-bold text-gray-900 dark:text-white">Modifier le paiement :
            {{ $commande->NUM_COMMANDE }}</h2>
        <form method="POST" action="{{ route('paiements.update', $commande->NUM_COMMANDE) }}" class="form-container">
            @csrf
            @method('PUT')
            <x-form-fields-container>
                <x-form-input name="oz" label="Numero OZ :" />
                <x-form-input name="DATE_PAIEMENT" type="date" label="Date De Paiement :" />
                <x-form-input name="MONTANT_PAYE" type="number" label="Montant Payee :" />
                <label class="col-span-2 inline-flex items-center cursor-pointer">
                    <input name="STATUT_PAIEMENT" value="payee" type="checkbox" @checked((old('STATUT_PAIEMENT') ?? $commande->STATUT_PAIEMENT) == 'payee')
                        class="sr-only peer">
                    <div
                        class="relative w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-green-300 dark:peer-focus:ring-green-800 rounded-full peer dark:bg-gray-700 peer-checked:after:translate-x-full rtl:peer-checked:after:-translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:start-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all dark:border-gray-600 peer-checked:bg-green-600">
                    </div>
                    <span class="ms-3 text-sm font-medium text-gray-900 dark:text-gray-300">payee</span>
                </label>
            </x-form-fields-container>
            <x-form-button>
                Enregistrer
            </x-form-button>
        </form>
    </div>
@endsection
