<?php

namespace App\Http\Controllers;

use App\Models\Fournisseur;
use Illuminate\Http\Request;

class FournisseurController extends Controller
{
    public function index()
    {
        return view('fournisseurs.index');
    }
    public function create()
    {
        return view('fournisseurs.create');
    }
    public function store(Request $request)
    {
        $validData = $request->validate([
            "nom_fournisseur" => ['required'],
        ], [
            '*.required' => 'Ce champ est obligatoire'
        ]);
        Fournisseur::create($validData);
        return redirect()->back()->with('success', 'fournisseur A été ajouté avec succès');
    }
    public function edit(Fournisseur $fournisseur)
    {
        return view('fournisseurs.edit', compact('fournisseur'));
    }
    public function update(Fournisseur $fournisseur)
    {
        $validData = request()->validate([
            'nom_fournisseur' => 'required',
        ]);
        $fournisseur->update($validData);
        return redirect()->back()->with('success', 'fournisseur tbdl');
    }
    public function destroy(Fournisseur $fournisseur)
    {
        $fournisseur->delete();
        return redirect()->route('fournisseurs.index')->with('success', 'le fournisseur a été supprimée avec succès.');
    }
}
