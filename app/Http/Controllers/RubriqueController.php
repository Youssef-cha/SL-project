<?php

namespace App\Http\Controllers;

use App\Models\Rubrique;
use Illuminate\Http\Request;

class RubriqueController extends Controller
{
    public function index(){
        return view('rubriques.index');
    }
    public function create(){
        return view('rubriques.create');
    }
    public function store(Request $request){
        $validData = $request->validate([
            "REFERENCE_RUBRIQUE" => ['required', 'unique:rubriques,REFERENCE_RUBRIQUE'],
            "ANNEE_BUDGETAIRE" => ['required','size:4'],
            "BUDGET" => ['required'],
        ],[
            '*.required' => 'Ce champ est obligatoire',
            '*REFERENCE_RUBRIQUE.unique' => 'Existe déjà',
            '*ANNEE_BUDGETAIRE.size' => 'annee budgetaire Doit comporter 4 caractères',
        ]);
        Rubrique::create($validData);
        return redirect()->back()->with('success','rubrique A été ajouté avec succès');
    }
    public function edit(Rubrique $rubrique){
        return view('rubriques.edit', [ "rubrique" => $rubrique]);
    }
    public function update(Request $request, Rubrique $rubrique){
        $validData = $request->validate([
            "BUDGET" => 'required'
        ], [
            "BUDGET.required" => "Ce champ est obligatoire"
        ]);
        $rubrique->update($validData);
        return redirect()->back()->with('success','rubrique A été mis à jour avec succès');
    }
}
