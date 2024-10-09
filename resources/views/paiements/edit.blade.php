@extends('layouts.app')
@section('content')
    <div class="box-form">
        <h1>Paiement</h1>
        @session('success')
            <div class="p-4 bg-green-100">
                {{ $value }}
            </div>
        @endsession
        <form method="post" action="{{route('paiements.update', $commande->NUM_COMMANDE)}}" class="form-container">
            @csrf
            @method("PUT")
            <div class="inputBx">
                <input id="dateLI" value="{{old('DATE_PAIEMENT') ? old('DATE_PAIEMENT') : $commande->DATE_PAIEMENT}}" name="DATE_PAIEMENT" type="date"
                    placeholder=" ">
                <label for="dateLI" class="label-title unique-label" id="autre_label_unique">DATE PAIEMENT</label>
                @error('DATE_PAIEMENT')
                    <p style="color: red;">{{ $message }}</p>
                @enderror
            </div>
            
            <div class="inputBx">
                <input id="dateLI" value="{{old('MONTANT_PAYE') ? old('MONTANT_PAYE') : $commande->MONTANT_PAYE}}" name="MONTANT_PAYE" type="number"
                    placeholder=" ">
                <label for="dateLI" class="label-title unique-label" id="autre_label_unique">montant paye</label>
                @error('MONTANT_PAYE')
                    <p style="color: red;">{{ $message }}</p>
                @enderror
            </div>

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
@endsection
