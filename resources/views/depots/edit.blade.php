@extends('layouts.app')
@section('content')
    <div class="box-form">
        <h1>depot</h1>
        @session('success')
            <div class="p-4 bg-green-100">
                {{ $value }}
            </div>
        @endsession

        <form method="post" action="{{ route('depots.update', $commande->NUM_COMMANDE) }}" class="form-container">
            @csrf
            @method('PUT')

            <input value="deposee" name="STATUT_PAIEMENT" type="hidden">

            <div class="inputBx">
                <input id="datever" value="{{ old('DATE_DEPOT_SC') ? old('DATE_DEPOT_SC') : $commande->DATE_DEPOT_SC }}"
                    name="DATE_DEPOT_SC" type="date" placeholder=" ">
                <label for="datever" class="label-title unique-label" id="autre_label_unique">DATE DEPOT SC</label>
                @error('DATE_DEPOT_SC')
                    <p style="color: red;">{{ $message }}</p>
                @enderror
            </div>

            <button type="submit" class="btn">Enregistrer</button>
            <a href="{{route("commandesUpdate.index")}}" class="btn2">retour</a>

        </form>
    </div>
    <script src="{{ asset('js/script.js') }}"></script>
@endsection
