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
            'numero_appel_offre' => ['required', 'unique:appel_offres,numero_appel_offre'],

        ],[
            "*.required" => "Ce champ est obligatoire",
            "*.unique" => "existe déjà",
        ]);
        AppelOffre::create($validData);
        return redirect()->back()->with('success', "l'appel d'offre A été ajouter avec succès!");
    }
    public function destroy(AppelOffre $appelOffre){
        $appelOffre->delete();
        return redirect()->route('appelOffres.index');
    }
}
