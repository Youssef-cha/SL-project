<?php

namespace App\Http\Controllers;

use App\Models\Complexe;
use App\Models\Efp;
use Illuminate\Http\Request;

class EfpController extends Controller
{
    public function create(Request $request ,Complexe $complexe){
        return view('efps.create',compact('complexe'));
    }
    public function index(Complexe $complexe){


        return view('efps.index', compact('complexe'));
    }
    public function store(Request $request ,Complexe $complexe){
        $request->validate([
            "nom_efp" => ['required'],
            
        ],[
            "*.required" => 'Ce champ est obligatoire',
        ]);
        Efp::create([
            "id_complexe" => $complexe->id,
            "nom_efp" => $request->nom_efp,
        ]);
        return redirect()->back()->with("success", 'efp A été ajouté avec succès');
    }

}
