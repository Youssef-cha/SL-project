@extends('layouts.app')
@section('content')
    <div class="box-form">
        <h1>complexe</h1>
        @session('success')
            <div class="p-4 bg-green-100">
                {{ $value }}
            </div>
        @endsession

        <form method="post" action="{{ route('complexes.store') }}" class="form-container">
            @csrf

            <div class="inputBx">
                <input id="datever" value="{{ old('nom_complexe') }}" name="nom_complexe" type="text"
                    placeholder=" ">
                <label for="datever" class="label-title unique-label" id="autre_label_unique">nom complexe</label>
                @error('nom_complexe')
                    <p style="color: red;">{{ $message }}</p>
                @enderror
            </div>

            <button type="submit" class="btn">Enregistrer</button>
            <a href="{{route("complexes.index")}}" class="btn2">retour</a>



        </form>
    </div>
    <script src="{{ asset('js/script.js') }}"></script>
@endsection
