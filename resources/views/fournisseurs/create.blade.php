@extends('layouts.app')
@section('content')
    <div class="box-form">
        <h1>fournisseur</h1>
        @session('success')
            <div class="p-4 bg-green-100">
                {{ $value }}
            </div>
        @endsession

        <form method="post" action="{{ route('fournisseurs.store') }}" class="form-container">
            @csrf

            <div class="inputBx">
                <input id="datever" value="{{ old('nom_fournisseur') }}" name="nom_fournisseur" type="text"
                    placeholder=" ">
                <label for="datever" class="label-title unique-label" id="autre_label_unique">nom fournisseur</label>
                @error('nom_fournisseur')
                    <p style="color: red;">{{ $message }}</p>
                @enderror
            </div>

            <button type="submit" class="btn">Enregistrer</button>


        </form>
    </div>
    <script src="{{ asset('js/script.js') }}"></script>
@endsection
