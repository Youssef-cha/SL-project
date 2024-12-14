<?php

namespace App\Http\Controllers;

use App\Models\Rubrique;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class RubriqueController extends Controller
{
    public function index()
    {
        return view('rubriques.index');
    }
    public function destroy(Rubrique $rubrique)
    {
        $rubrique->delete();
        return redirect()->route('rubriques.index');
    }
    public function create()
    {
        return view('rubriques.create');
    }
    public function store(Request $request)
    {

        $validData = $request->validate([
            "REFERENCE_RUBRIQUE" => ['required'],
            "ANNEE_BUDGETAIRE" => ['required', 'size:4'],
            "BUDGET" => ['required'],
        ], [
            '*.required' => 'Ce champ est obligatoire',
            '*REFERENCE_RUBRIQUE.unique' => 'Existe déjà',
            '*ANNEE_BUDGETAIRE.size' => 'annee budgetaire Doit comporter 4 caractères',
        ]);
        $existe = Rubrique::where('REFERENCE_RUBRIQUE', $request->REFERENCE_RUBRIQUE)
        ->where('ANNEE_BUDGETAIRE', $request->ANNEE_BUDGETAIRE)
        ->limit(1)
        ->get();
        if ($existe->isNotEmpty()) {
            throw ValidationException::withMessages(['REFERENCE_RUBRIQUE' => 'existe deja', 'ANNEE_BUDGETAIRE' => 'existe deja']);
        }
        Rubrique::create($validData);
        return redirect()->back()->with('success', 'rubrique A été ajouté avec succès');
    }
    public function edit(Rubrique $rubrique)
    {
        return view('rubriques.edit', ["rubrique" => $rubrique]);
    }
    public function update(Request $request, Rubrique $rubrique)
    {
        $validData = $request->validate([
            "BUDGET" => 'required'
        ], [
            "BUDGET.required" => "Ce champ est obligatoire"
        ]);
        $rubrique->update($validData);
        return redirect()->back()->with('success', 'rubrique A été mis à jour avec succès');
    }
}
