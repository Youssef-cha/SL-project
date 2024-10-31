@extends('layouts.app')
@section('content')
<div class="box-form">
    <h1>Créer Une Nouvelle Rubrique</h1>
    @session('success')
        <div class="p-4 bg-green-500">
            {{ $value }}
        </div>
    @endsession
    <form method="post" action="{{ route('rubriques.update', $rubrique->REFERENCE_RUBRIQUE) }}" class="form-container">
        @csrf
        @method("PUT")
        <div class="inputBx">
            <input value="{{ old('BUDGET') ?? $rubrique->BUDGET }}" type="number" id="BUDGET" name="BUDGET"
                placeholder=" ">
            <label for="BUDGET">Budget</label>
            @error('BUDGET')
                <p style="color: red">{{ $message }}</p>
            @enderror
        </div>
        <div class="grp-btn">
            <button type="submit" class="btn">modifier</button>
            <a href="{{ route('rubriquesUpdate.index') }}" class="btn2" style="margin-left: 10px;">retour</a>
        </div>

    </form>
</div>
@endsection