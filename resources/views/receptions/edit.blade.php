{{-- @extends('layouts.app')
@section('content')
    <div class="box-form">
        <h1>Reception</h1>
        @session('success')
            <div class="pop-up">
                {{ $value }}
            </div>
        @endsession

        <form method="post" action="{{ route('receptions.update', $commande->NUM_COMMANDE) }}" class="form-container">
            @csrf
            @method('PUT')

            <div class="inputBx">
                <input id="ttva" value="{{ old('TAUX_TVA') ? old('TAUX_TVA') : $commande->TAUX_TVA }}" name="TAUX_TVA"
                    type="number" min="0" placeholder=" ">
                <label for="ttva">Taux TVA:</label>
                @error('TAUX_TVA')
                    <p style="color: red;">{{ $message }}</p>
                @enderror
            </div>

            <div class="inputBx">
                <input id="montanttva" value="{{ old('MONTANT_TVA') ? old('MONTANT_TVA') : $commande->MONTANT_TVA }}"
                    name="MONTANT_TVA" type="number" min="0" placeholder=" ">
                <label for="montanttva">Montant TVA:</label>
                @error('MONTANT_TVA')
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
        <h2 class="mb-4 text-xl font-bold text-gray-900 dark:text-white">Modifier la reception :
            {{ $commande->NUM_COMMANDE }}</h2>
        <form method="POST" action="{{ route('receptions.update', $commande->NUM_COMMANDE) }}" class="form-container">
            @csrf
            @method('PUT')
            <x-form-fields-container>
                <x-form-input value="réceptionnée" name="STATUT_RECEPTION" type="hidden" />
                <x-form-input name="DATE_VERIFICATION_RECEPTION" type="date"
                    label="Date de vérification
                    reception :" />
                <x-form-input name="DATE_DEPOT_SL" type="date" label="Date depot service logistique :" />
                <x-form-input name="NUM_FACTURE" type="text" label="Numero de facture :" />
                <x-form-input name="DATE_FACTURE" type="date" label="Date de facture :" />
                <x-form-input name="HT" type="number" min="0" label="HT :" />
                <x-form-input name="TTC" type="number" min="0" label="TTC :" />
                <x-form-input name="TAUX_TVA" type="number" min="0" label="TAUX TVA :" />
                <x-form-input name="MONTANT_TVA" type="number" min="0" label="Montant TVA :" />
            </x-form-fields-container>
            <x-form-button>
                Enregistrer
            </x-form-button>
        </form>
    </div>
@endsection
