@extends('layouts.app')
@section('content')
    <div class="box-form">
        <h1>efp</h1>
        @session('success')
            <div class="pop-up">
                {{ $value }}
            </div>
        @endsession

        <form method="post" action="{{ route('complexes.efps.store',$complexe) }}" class="form-container">
            @csrf

            <div class="inputBx">
                <input id="datever" value="{{ old('nom_efp') }}" name="nom_efp" type="text"
                    placeholder=" ">
                <label for="datever" class="label-title unique-label" id="autre_label_unique">nom efp</label>
                @error('nom_efp')
                    <p style="color: red;">{{ $message }}</p>
                @enderror
            </div>

            <button type="submit" class="btn">Enregistrer</button>
            <a href="{{route("complexes.index")}}" class="btn2">retour</a>



        </form>
    </div>
    <script src="{{ asset('js/script.js') }}"></script>
@endsection
