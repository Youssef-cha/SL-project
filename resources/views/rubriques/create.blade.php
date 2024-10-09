@extends('layouts.app')
@section('content')
<div class="box-form">
    <h1>Créer Une Nouvelle Rubrique</h1>
    @session('success')
        <div class="p-4 bg-green-500">
            {{ $value }}
        </div>
    @endsession
    <form method="post" action="{{ route('rubriques.store') }}" class="form-container">
            @csrf
            <div class="inputBx">
                <input value="{{ old('REFERENCE_RUBRIQUE') }}" type="text" id="reference_rubrique2" name="REFERENCE_RUBRIQUE"
                    placeholder=" ">
                <label for="reference_rubrique2">Référence Rubrique</label>
                @error('REFERENCE_RUBRIQUE')
                    <p style="color: red">{{ $message }}</p>
                @enderror
            </div>

            <div class="inputBx">
                <input value="{{ old('ANNEE_BUDGETAIRE') }}" type="number" id="ANNEE_BUDGETAIRE" name="ANNEE_BUDGETAIRE"
                    placeholder=" ">
                <label for="ANNEE_BUDGETAIRE">Année Budgétaire</label>
                @error('ANNEE_BUDGETAIRE')
                    <p style="color: red">{{ $message }}</p>
                @enderror
            </div>

            <div class="inputBx">
                <input value="{{ old('BUDGET') }}" type="number" id="BUDGET" name="BUDGET" placeholder=" ">
                <label for="BUDGET">Budget</label>
                @error('BUDGET')
                    <p style="color: red">{{ $message }}</p>
                @enderror
            </div>

            <div class="grp-btn">
                <button type="submit" class="btn">Créer</button>
            </div>
        </form>
    </div>
@endsection
