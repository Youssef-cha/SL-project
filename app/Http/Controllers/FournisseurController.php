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
    public function destroy($fournisseur )
    {
        $fournisseur = Fournisseur::find($fournisseur);
        $fournisseur->delete();

        return redirect()->back();
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
}
