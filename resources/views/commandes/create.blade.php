@extends('layouts.app')
@section('content')
    <div class="box-form">
        <h1>Créer Une Commande</h1>
        @session('success')
            <div class="pop-up">
                {{ $value }}
            </div>
        @endsession
        <form method="post" action="{{ route('commandes.store') }}" class="form-container">
            @csrf
            <!-- numéro de commande -->
            <div class="inputBx">
                <input id="num_commande" value="{{ old('NUM_COMMANDE') }}" name="NUM_COMMANDE" type="text" placeholder=" ">
                <label for="num_commande">numéro de commande</label>
                @error('NUM_COMMANDE')
                    <p style="color: red;">{{ $message }}</p>
                @enderror
            </div>
            <!-- Numéro appel d'offre -->
            <div class="inputBx">
                <input value="{{ old('AVIS_ACHAT') }}" id="avis_achat" name="AVIS_ACHAT" type="text" placeholder=" ">
                <label for="avis_achat">Numéro appel d'offre </label>
                @error('AVIS_ACHAT')
                    <p style="color: red;">{{ $message }}</p>
                @enderror
            </div>
            <!-- Type Commande -->
            <div class="inputBx">
                <select name="TYPE_ACHAT" id="">
                    <option value="" hidden></option>
                    @foreach ($achatTypes as $achatType)
                        <option @selected($achatType == old('TYPE_ACHAT')) value="{{ $achatType }}">{{ $achatType }}</option>
                    @endforeach
                </select>
                <label for="typeAchat">Type Achat</label>
                @error('TYPE_ACHAT')
                    <p style="color: red;">{{ $message }}</p>
                @enderror
            </div>
            <!-- type budget -->
            <div class="inputBx">
                <select name="TYPE_BUDGET" id="">
                    <option value="" hidden></option>
                    @foreach ($budgetTypes as $budgetType)
                        <option @selected($budgetType == old('TYPE_BUDGET')) value="{{ $budgetType }}">{{ $budgetType }}</option>
                    @endforeach
                </select>
                <label for="typeAchat">type budget</label>
                @error('TYPE_BUDGET')
                    <p style="color: red;">{{ $message }}</p>
                @enderror
            </div>
            <!-- Objet d'achat -->
            <div class="inputBx">
                <input value="{{ old('OBJET_ACHAT') }}" id="objet_achat" name="OBJET_ACHAT" type="text" placeholder=" ">
                <label for="objet_achat">Objet d'achat</label>
                @error('OBJET_ACHAT')
                    <p style="color: red;">{{ $message }}</p>
                @enderror
            </div>
            <!-- Référence Rubrique -->
            <div class="inputBx">
                <select name="REFERENCE_RUBRIQUE" id="rubrique">
                    <option value="" hidden></option>
                    @foreach ($rubriques as $rubrique)
                        <option @selected($rubrique->REFERENCE_RUBRIQUE == old('REFERENCE_RUBRIQUE')) value="{{ $rubrique->REFERENCE_RUBRIQUE }}">
                            {{ $rubrique->REFERENCE_RUBRIQUE }}</option>
                    @endforeach
                </select>
                <label for="rubrique">Référence Rubrique</label>
                @error('REFERENCE_RUBRIQUE')
                    <p style="color: red;">{{ $message }}</p>
                @enderror
            </div>
            <!-- Fournisseur -->
            <div class="inputBx">
                <select name="FOURNISSEUR" id="FOURNISSEUR">
                    <option value="" hidden></option>
                    @foreach ($fournisseurs as $fournisseur)
                        <option @selected($fournisseur->id == old('FOURNISSEUR')) value="{{ $fournisseur->id }}">
                            {{ $fournisseur->nom_fournisseur }}</option>
                    @endforeach
                </select>
                <label for="rubrique">fournisseur</label>
                @error('FOURNISSEUR')
                    <p style="color: red;">{{ $message }}</p>
                @enderror
            </div>
            
            <!-- Délai de livraison -->
            <div class="inputBx">
                <input value="{{ old('DELAI_LIVRAISON') }}" id="DELAI_LIVRAISON" name="DELAI_LIVRAISON" type="number"
                    min="0" placeholder=" ">
                <label for="DELAI_LIVRAISON">Délai de livraison</label>
                @error('DELAI_LIVRAISON')
                    <p style="color: red;">{{ $message }}</p>
                @enderror
            </div>
            <!-- Garantie -->
            <div class="inputBx2">
                <p class="label-title">Garantie</p>
                <div class="radio-group">
                    <div>
                        <input id="GARANTIEoui" @checked(old('GARANTIE') == 'oui') name="GARANTIE" type="radio" value="oui">
                        <label for="GARANTIEoui" class="radio-label">Oui</label>
                    </div>
                    <div>
                        <input id="GARANTIEnon" @checked(old('GARANTIE') == 'non') name="GARANTIE" type="radio" value="non">
                        <label for="GARANTIEnon" class="radio-label">Non</label>
                    </div>
                </div>
                @error('GARANTIE')
                    <p style="color: red;">{{ $message }}</p>
                @enderror
            </div>
            <!-- Retenue garantie -->
            <div class="inputBx dropped">
                <input value="{{ old('RETENUE_GARANTIE') }}" id="RETENUE_GARANTIE" name="RETENUE_GARANTIE" type="number"
                    placeholder=" ">
                <label for="RETENUE_GARANTIE">Retenue garantie</label>
                @error('RETENUE_GARANTIE')
                    <p style="color: red;">{{ $message }}</p>
                @enderror
            </div>
            <!-- Numéro de marché -->
            <div class="inputBx">
                <input value="{{ old('NUM_MARCHE') }}" id="NUM_MARCHE" name="NUM_MARCHE" type="text" placeholder=" ">
                <label for="NUM_MARCHE">Numéro de marché</label>
                @error('NUM_MARCHE')
                    <p style="color: red;">{{ $message }}</p>
                @enderror
            </div>
            <!-- Exercice -->
            <div class="inputBx">
                <input value="{{ old('EXERCICE') }}" id="EXERCICE" name="EXERCICE" type="number" min="0"
                    placeholder=" ">
                <label for="EXERCICE">Exercice</label>
                @error('EXERCICE')
                    <p style="color: red;">{{ $message }}</p>
                @enderror
            </div>
            <!-- Date commande -->
            <div class="inputBx">
                <input value="{{ old('DATE_COMMANDE') }}" id="DATE_COMMANDE" name="DATE_COMMANDE" type="date"
                    placeholder=" ">
                <label for="DATE_COMMANDE" class="label-title unique-label" id="autre_label_unique">Date commande</label>
                @error('DATE_COMMANDE')
                    <p style="color: red;">{{ $message }}</p>
                @enderror
            </div>
            <!-- Responsable dossier -->
            <div class="inputBx">
                <select name="RESPONSABLE_DOSSIER" id="RESPONSABLE_DOSSIER">
                    <option value="" hidden></option>
                    @foreach ($responsables as $responsable)
                        <option @selected($responsable->id == old('RESPONSABLE_DOSSIER')) value="{{ $responsable->id }}">
                            {{ $responsable->nom_responsable }}</option>
                    @endforeach
                </select>
                <label for="RESPONSABLE_DOSSIER">responsable</label>
                @error('RESPONSABLE_DOSSIER')
                    <p style="color: red;">{{ $message }}</p>
                @enderror
            </div>
            
           
            <!-- Enregistrer btn -->
            <button type="submit" class="btn">Enregistrer</button>
        </form>
    </div>
    <script src="{{ asset('js/script.js') }}"></script>
@endsection
