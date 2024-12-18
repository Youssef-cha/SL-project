<?php

namespace App\Http\Controllers;

use App\Models\AppelOffre;
use Illuminate\Http\Request;

class AppelOffreController extends Controller
{
    public function index(){
        return view('appelOffres.index');
    }
    public function create(){
        return view('appelOffres.create');
    }
    public function store(){
        $validData = request()->validate([
            'numero_appel_offre' => 'required',
            'numero_marche' => 'required',
        ],[
            "*.required" => "Ce champ est obligatoire",
        ]);
        AppelOffre::create($validData);
        return redirect()->back()->with('success', 'appel_offre A été ajouter avec succès!');
    }
    public function edit(AppelOffre $appelOffre){
        return view('appelOffres.edit', compact('appelOffre'));
    }
    public function update(AppelOffre $appelOffre){
        $validData = request()->validate([
            'numero_marche' => 'required',
        ],[
            "*.required" => "Ce champ est obligatoire",
        ]);
        $appelOffre->update($validData);
        return redirect()->back()->with('success', 'appel_offre A été mise a jour avec succès!');
    }
    public function destroy(AppelOffre $appelOffre){
        $appelOffre->delete();
        return redirect()->route('appelOffres.index');
    }
}
