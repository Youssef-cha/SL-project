@extends('layouts.app')
@section('content')
    <div class="box-form">
        <h1>Reception</h1>
        @session('success')
            <div class="p-4 bg-green-100">
                {{ $value }}
            </div>
        @endsession

        <form method="post" action="{{ route('receptions.update', $commande->NUM_COMMANDE) }}" class="form-container">
            @csrf
            @method('PUT')
            <input value="réceptionnée" name="STATUT_RECEPTION" type="hidden">

            <div class="inputBx">
                <input id="datever"
                    value="{{ old('DATE_VERIFICATION_RECEPTION') ? old('DATE_VERIFICATION_RECEPTION') : $commande->DATE_VERIFICATION_RECEPTION }}"
                    name="DATE_VERIFICATION_RECEPTION" type="date" placeholder=" ">
                <label for="datever" class="label-title unique-label" id="autre_label_unique">Date de vérification
                    reception:</label>
                @error('DATE_VERIFICATION_RECEPTION')
                    <p style="color: red;">{{ $message }}</p>
                @enderror
            </div>

            <div class="inputBx">
                <input id="datedepo" value="{{ old('DATE_DEPOT_SL') ? old('DATE_DEPOT_SL') : $commande->DATE_DEPOT_SL }}"
                    name="DATE_DEPOT_SL" type="date" placeholder=" ">
                <label for="datedepo" class="label-title unique-label" id="autre_label_unique">Date depot SL:</label>
                @error('DATE_DEPOT_SL')
                    <p style="color: red;">{{ $message }}</p>
                @enderror
            </div>

            <div class="inputBx">
                <input id="numeroFacture" value="{{ old('NUM_FACTURE') ? old('NUM_FACTURE') : $commande->NUM_FACTURE }}"
                    name="NUM_FACTURE" type="text" placeholder=" ">
                <label for="numeroFacture">Numéro de Facture:</label>
                @error('NUM_FACTURE')
                    <p style="color: red;">{{ $message }}</p>
                @enderror
            </div>

            <div class="inputBx">
                <input id="datefacture" value="{{ old('DATE_FACTURE') ? old('DATE_FACTURE') : $commande->DATE_FACTURE }}"
                    name="DATE_FACTURE" type="date" placeholder=" ">
                <label for="datefacture" class="label-title unique-label" id="autre_label_unique">Date facture:</label>
                @error('DATE_FACTURE')
                    <p style="color: red;">{{ $message }}</p>
                @enderror
            </div>

            <div class="inputBx">
                <input id="ht" value="{{ old('HT') ? old('HT') : $commande->HT }}" name="HT" type="number"
                    min="0" placeholder=" ">
                <label for="ht">HT:</label>
                @error('HT')
                    <p style="color: red;">{{ $message }}</p>
                @enderror
            </div>

            <div class="inputBx">
                <input id="ttc" value="{{ old('TTC') ? old('TTC') : $commande->TTC }}" name="TTC" type="number"
                    min="0" placeholder=" ">
                <label for="ttc">TTC:</label>
                @error('TTC')
                    <p style="color: red;">{{ $message }}</p>
                @enderror
            </div>

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
@endsection
