@extends('layouts.app')
@section('content')
    <div class="box-form">
        <h1>Créer Une retour :</h1>
        @session('success')
        <p style="color: green"> {{ $value }} </p>
        @endsession
        <form method="post" action=" {{route("commandes.retours.store", $commande->NUM_COMMANDE)}} " class="form-container">
            @csrf
            <div class="inputBx">
                <input value="{{ old('RESPONSABLE') }}" id="avis_achat" name="RESPONSABLE" type="text" placeholder=" ">
                <label for="avis_achat">RESPONSABLE</label>
                @error('RESPONSABLE')
                    <p style="color: red"> {{ $message }} </p>
                @enderror
            </div>

            <div class="inputBx">
                <textarea name="MOTIF" id="MOTIF" placeholder=" ">{{ old('MOTIF') }}</textarea>
                <label for="MOTIF" class="label-title">MOTIF</label>
                @error('MOTIF')
                    <p style="color: red"> {{ $message }} </p>
                @enderror
            </div>

            <div class="inputBx">
                <input value="{{ old('DEBUT') }}" id="DEBUT" name="DEBUT" type="date" placeholder=" ">
                <label for="DEBUT" class="label-title unique-label" id="autre_label_unique">Date DEBUT</label>
                @error('DEBUT')
                    <p style="color: red"> {{ $message }} </p>
                @enderror
            </div>

            <div class="inputBx">
                <input value=" {{ old("FIN") }}" id="FIN" name="FIN" type="date" placeholder=" ">
                <label for="FIN" class="label-title unique-label" id="autre_label_unique">Date FIN</label>
                @error('FIN')
                    <p style="color: red"> {{ $message }} </p>
                @enderror
            </div>

            <button type="submit" class="btn">Enregistrer</button>
            <a href="{{route("commandes.retours")}}" class="btn2">retour</a>

        </form>
    </div>
@endsection

