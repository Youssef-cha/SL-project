@extends('layouts.app')
@section('content')
    <div class="box-form">
        <h1>mettre a jour Commande n° {{ $commande->NUM_COMMANDE }} </h1>
        @session('success')
            <div class="p-4 bg-green-100">
                {{ $value }}
            </div>
        @endsession
        <form method="post" action="{{ route('commandes.update', $commande->NUM_COMMANDE) }}" class="form-container">
            @csrf
            @method('PUT')
            <!-- Numéro appel d'offre -->
            <div class="inputBx">
                <input value="{{ old('AVIS_ACHAT') ? old('AVIS_ACHAT') : $commande->AVIS_ACHAT }}" id="avis_achat"
                    name="AVIS_ACHAT" type="text" placeholder=" ">
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
                        <option @selected($achatType == (old('TYPE_ACHAT') ? old('TYPE_ACHAT') : $commande->TYPE_ACHAT)) value="{{ $achatType }}">{{ $achatType }}</option>
                    @endforeach
                </select>
                <label for="typeAchat">Type Commande</label>
                @error('TYPE_ACHAT')
                    <p style="color: red;">{{ $message }}</p>
                @enderror
            </div>
            <!-- type budget -->
            <div class="inputBx">
                <select name="TYPE_BUDGET" id="">
                    <option value="" hidden></option>
                    @foreach ($budgetTypes as $budgetType)
                        <option @selected($budgetType == (old('TYPE_BUDGET') ? old('TYPE_BUDGET') : $commande->TYPE_BUDGET)) value="{{ $budgetType }}">{{ $budgetType }}</option>
                    @endforeach
                </select>
                <label for="typeAchat">type budget</label>
                @error('TYPE_BUDGET')
                    <p style="color: red;">{{ $message }}</p>
                @enderror
            </div>
            <!-- Objet d'achat -->
            <div class="inputBx">
                <input value="{{ old('OBJET_ACHAT') ? old('OBJET_ACHAT') : $commande->OBJET_ACHAT }}" id="objet_achat"
                    name="OBJET_ACHAT" type="text" placeholder=" ">
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
                        <option @selected($rubrique->REFERENCE_RUBRIQUE == (old('REFERENCE_RUBRIQUE') ? old('REFERENCE_RUBRIQUE') : $commande->REFERENCE_RUBRIQUE)) value="{{ $rubrique->REFERENCE_RUBRIQUE }}">
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
                <input value="{{ old('FOURNISSEUR') ? old('FOURNISSEUR') : $commande->FOURNISSEUR }}" id="fornisseur"
                    name="FOURNISSEUR" type="text" placeholder=" ">
                <label for="fornisseur">Fournisseur</label>
                @error('FOURNISSEUR')
                    <p style="color: red;">{{ $message }}</p>
                @enderror
            </div>
            <!-- Délai de livraison -->
            <div class="inputBx">
                <input value="{{ old('DELAI_LIVRAISON') ? old('DELAI_LIVRAISON') : $commande->DELAI_LIVRAISON }}"
                    id="DELAI_LIVRAISON" name="DELAI_LIVRAISON" type="number" min="0" placeholder=" ">
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
                        <input id="GARANTIEoui" @checked((old('GARANTIE') ? old('GARANTIE') : $commande->GARANTIE) == 'oui') name="GARANTIE" type="radio" value="oui">
                        <label for="GARANTIEoui" class="radio-label">Oui</label>
                    </div>
                    <div>
                        <input id="GARANTIEnon" @checked((old('GARANTIE') ? old('GARANTIE') : $commande->GARANTIE) == 'non') name="GARANTIE" type="radio" value="non">
                        <label for="GARANTIEnon" class="radio-label">Non</label>
                    </div>
                </div>
                @error('GARANTIE')
                    <p style="color: red;">{{ $message }}</p>
                @enderror
            </div>
            <!-- Retenue garantie -->
            <div class="inputBx dropped">
                <input value="{{ old('RETENUE_GARANTIE') ? old('RETENUE_GARANTIE') : $commande->RETENUE_GARANTIE }}"
                    id="RETENUE_GARANTIE" name="RETENUE_GARANTIE" type="number" placeholder=" ">
                <label for="RETENUE_GARANTIE">Retenue garantie</label>
                @error('RETENUE_GARANTIE')
                    <p style="color: red;">{{ $message }}</p>
                @enderror
            </div>
            <!-- Numéro de marché -->
            <div class="inputBx">
                <input value="{{ old('NUM_MARCHE') ? old('NUM_MARCHE') : $commande->NUM_MARCHE }}" id="NUM_MARCHE"
                    name="NUM_MARCHE" type="text" placeholder=" ">
                <label for="NUM_MARCHE">Numéro de marché</label>
                @error('NUM_MARCHE')
                    <p style="color: red;">{{ $message }}</p>
                @enderror
            </div>
            <!-- Exercice -->
            <div class="inputBx">
                <input value="{{ old('EXERCICE') ? old('EXERCICE') : $commande->EXERCICE }}" id="EXERCICE" name="EXERCICE"
                    type="number" min="0" placeholder=" ">
                <label for="EXERCICE">Exercice</label>
                @error('EXERCICE')
                    <p style="color: red;">{{ $message }}</p>
                @enderror
            </div>
            <!-- Date commande -->
            <div class="inputBx">
                <input value="{{ old('DATE_COMMANDE') ? old('DATE_COMMANDE') : $commande->DATE_COMMANDE }}"
                    id="DATE_COMMANDE" name="DATE_COMMANDE" type="date" placeholder=" ">
                <label for="DATE_COMMANDE" class="label-title unique-label" id="autre_label_unique">Date commande</label>
                @error('DATE_COMMANDE')
                    <p style="color: red;">{{ $message }}</p>
                @enderror
            </div>
            <!-- Responsable dossier -->
            <div class="inputBx">
                <input
                    value="{{ old('RESPONSABLE_DOSSIER') ? old('RESPONSABLE_DOSSIER') : $commande->RESPONSABLE_DOSSIER }}"
                    id="Responsable dossier" name="RESPONSABLE_DOSSIER" type="text" placeholder=" ">
                <label for="Responsable dossier">Responsable dossier</label>
                @error('RESPONSABLE_DOSSIER')
                    <p style="color: red;">{{ $message }}</p>
                @enderror
            </div>
            <!-- Statut commande -->
            <div class="inputBx2">
                <p class="label-title">Statut commande</p>
                <div class="radio-group">
                    @foreach ($statutCommandes as $statutCommande)
                        <div>
                            <input @checked((old('STATUT_COMMANDE') ? old('STATUT_COMMANDE') : $commande->STATUT_COMMANDE) == $statutCommande) id="{{ $statutCommande }}" name="STATUT_COMMANDE" type="radio"
                                value="{{ $statutCommande }}">
                            <label for="{{ $statutCommande }}" class="radio-label">{{ $statutCommande }}</label>
                        </div>
                    @endforeach
                </div>
            </div>
            <!-- Enregistrer btn -->
            <button type="submit" class="btn">Enregistrer</button>
            <a href="{{route("commandesUpdate.index")}}" class="btn2">retour</a>
            <!-- <button onclick="window.location.href='{{ route('commandesUpdate.index') }}'" class="btn">Retour</button> -->
            <!-- <button id="redirectButton" class="btn">Retour</button> -->


        </form>
    </div>
    <script src="{{ asset('js/script.js') }}"></script>
@endsection
