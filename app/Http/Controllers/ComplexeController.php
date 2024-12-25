<?php

namespace App\Http\Controllers;

use App\Models\Complexe;
use Illuminate\Http\Request;

class ComplexeController extends Controller
{
    public function index(){
        return view('complexes.index');
    }
    public function create(){
        return view('complexes.create');
    }
    public function store(Request $request){
        $validData = $request->validate([
            "nom_complexe" => ['required','unique:complexes,nom_complexe'],
        ], [
            "*.required" => "Ce champ est obligatoire",
            "*.unique" => "existe déjà",
        ]);
        Complexe::create($validData);
        return redirect()->back()->with('success','complexe A été ajouté avec succès');;
    }
    public function edit($complexe){
        $complexe = Complexe::findOrFail($complexe);
        return view('complexes.edit', compact('complexe'));
    }

    public function update(Request $request , $complexe){
        $complexe = Complexe::findOrFail($complexe);
        $validData = $request->validate([
            'nom_complexe' => ['required','unique:complexes,nom_complexe']
        ],[
            'nom_complexe.required' => 'Le nom du complexe est obligatoire',
            'nom_complexe.unique' => 'existe déjà',
        ]);
        $complexe->update($validData);
        return redirect()->back()->with('success', 'complexe A été mis à jour avec succès');

    }
    public function destroy($complexe){
        $complexe = Complexe::findOrFail($complexe);
        $complexe->delete();
        return redirect()->route('complexes.index');
    }
}
