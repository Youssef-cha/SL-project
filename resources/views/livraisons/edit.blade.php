@extends('layouts.app')
@section('content')
    <div class="box-form">
        <h1>Livraison</h1>
        @session('success')
            <div class="pop-up">
                {{ $value }}
            </div>
        @endsession
        <form method="post" action="{{route('livraisons.update', $commande->NUM_COMMANDE)}}" class="form-container">
            @csrf
            @method("PUT")
            <input value="Livrée" name="STATUT_LIVRAISON" type="hidden">

            <div class="inputBx">
                <input id="dateLI" value="{{old('DATE_LIVRAISON') ? old('DATE_LIVRAISON') : $commande->DATE_LIVRAISON}}" name="DATE_LIVRAISON" type="date"
                    placeholder=" ">
                <label for="dateLI" class="label-title unique-label" id="autre_label_unique">DATE LIVRAISON</label>
                @error('DATE_LIVRAISON')
                    <p style="color: red;">{{ $message }}</p>
                @enderror
            </div>


            <div class="inputBx">
                <textarea name="LIEU_LIVRAISON" id="lieuLivraison" placeholder=" ">{{old('LIEU_LIVRAISON') ? old('LIEU_LIVRAISON') : $commande->LIEU_LIVRAISON}}</textarea>
                <label for="lieuLivraison" class="label-title">Lieu de livraison</label>
                @error('LIEU_LIVRAISON')
                    <p style="color: red;">{{ $message }}</p>
                @enderror
            </div>

            <button type="submit" class="btn">Enregistrer</button>
            <a href="{{route("commandesUpdate.index")}}" class="btn2">retour</a>
        </form>
    </div>
    <script src="{{ asset('js/script.js') }}"></script>
@endsection
