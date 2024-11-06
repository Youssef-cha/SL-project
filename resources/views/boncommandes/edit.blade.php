@extends('layouts.app')
@section('content')
    <div class="box-form">
        <h1>mettre a jour bon Commande n° {{$commande->NUM_COMMANDE}} </h1>
        @session('success')
            <div class="p-4 bg-green-100">
                {{ $value }}
            </div>
        @endsession
        <form method="post" action="{{ route('boncommandes.update', base64_encode($commande->NUM_COMMANDE)) }}" class="form-container">
            @csrf
            @method('PUT')
            <!-- numéro avis achat -->
            <div class="inputBx">
                <input value="{{ old('AVIS_ACHAT') ?? $commande->AVIS_ACHAT }}" id="avis_achat" name="AVIS_ACHAT" type="text" placeholder=" ">
                <label for="avis_achat">numéro avis achat </label>
                @error('AVIS_ACHAT')
                    <p style="color: red;">{{ $message }}</p>
                @enderror
            </div>
            <!-- type budget -->
            <div class="inputBx">
                <select name="TYPE_BUDGET" id="">
                    <option value="" hidden></option>
                    @foreach ($budgetTypes as $budgetType)
                        <option @selected($budgetType == old('TYPE_BUDGET') ? old('TYPE_BUDGET') : $commande->TYPE_BUDGET) value="{{ $budgetType }}">{{ $budgetType }}</option>
                    @endforeach
                </select>
                <label for="typeAchat">type budget</label>
                @error('TYPE_BUDGET')
                    <p style="color: red;">{{ $message }}</p>
                @enderror
            </div>
            <!-- Objet d'achat -->
            <div class="inputBx">
                <input value="{{ old('OBJET_ACHAT') ?? $commande->OBJET_ACHAT }}" id="objet_achat" name="OBJET_ACHAT" type="text" placeholder=" ">
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
                        <option @selected($rubrique->REFERENCE_RUBRIQUE == old('REFERENCE_RUBRIQUE') ? old('REFERENCE_RUBRIQUE') : $commande->REFERENCE_RUBRIQUE) value="{{ $rubrique->REFERENCE_RUBRIQUE }}">
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
                        <option @selected($fournisseur->id == old('FOURNISSEUR') ? old('FOURNISSEUR') : $commande->FOURNISSEUR) value="{{ $fournisseur->id }}">
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
                <input value="{{ old('DELAI_LIVRAISON') ?? $commande->DELAI_LIVRAISON }}" id="DELAI_LIVRAISON" name="DELAI_LIVRAISON" type="number"
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
                        <input id="GARANTIEoui" @checked(old('GARANTIE') ?? $commande->GARANTIE == 'oui') name="GARANTIE" type="radio" value="oui">
                        <label for="GARANTIEoui" class="radio-label">Oui</label>
                    </div>
                    <div>
                        <input id="GARANTIEnon" @checked(old('GARANTIE') ?? $commande->GARANTIE == 'non') name="GARANTIE" type="radio" value="non">
                        <label for="GARANTIEnon" class="radio-label">Non</label>
                    </div>
                </div>
                @error('GARANTIE')
                    <p style="color: red;">{{ $message }}</p>
                @enderror
            </div>
            <!-- Retenue garantie -->
            <div class="inputBx dropped">
                <input value="{{ old('RETENUE_GARANTIE') ?? $commande->RETENUE_GARANTIE }}" id="RETENUE_GARANTIE" name="RETENUE_GARANTIE" type="number"
                    placeholder=" ">
                <label for="RETENUE_GARANTIE">Retenue garantie</label>
                @error('RETENUE_GARANTIE')
                    <p style="color: red;">{{ $message }}</p>
                @enderror
            </div>
            <!-- Exercice -->
            <div class="inputBx">
                <input value="{{ old('EXERCICE') ?? $commande->EXERCICE }}" id="EXERCICE" name="EXERCICE" type="number" min="0"
                    placeholder=" ">
                <label for="EXERCICE">Exercice</label>
                @error('EXERCICE')
                    <p style="color: red;">{{ $message }}</p>
                @enderror
            </div>
            <!-- Date commande -->
            <div class="inputBx">
                <input value="{{ old('DATE_COMMANDE') ?? $commande->DATE_COMMANDE }}" id="DATE_COMMANDE" name="DATE_COMMANDE" type="date"
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
                        <option @selected($responsable->id == old('RESPONSABLE_DOSSIER') ? old('RESPONSABLE_DOSSIER') : $commande->RESPONSABLE_DOSSIER ) value="{{ $responsable->id }}">
                            {{ $responsable->nom_responsable }}</option>
                    @endforeach
                </select>
                <label for="rubrique">responsable dossier</label>
                @error('RESPONSABLE_DOSSIER')
                    <p style="color: red;">{{ $message }}</p>
                @enderror
            </div>
            
            <!-- Enregistrer btn -->
            <button type="submit" class="btn">Enregistrer</button>
            <a href="{{route("commandesUpdate.index")}}" class="btn2">retour</a>
        </form>
    </div>
    <script src="{{ asset('js/script.js') }}"></script>
@endsection
