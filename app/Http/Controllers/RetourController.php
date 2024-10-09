<?php

namespace App\Http\Controllers;

use App\Models\Commande;
use App\Models\Retour;
use Illuminate\Http\Request;

class RetourController extends Controller
{
    public function index(Commande $commande)
    {
        return view("retours.index",compact('commande'));
    }

    public function create(Commande $commande)
    {
        return view("retours.create", compact("commande"));
    }
    public function store(Request $request ,Commande $commande)
    {
        $request->validate([
            "RESPONSABLE" => ['required'],
            "MOTIF" => ['required'],
            "DEBUT" => ['required'],
            "FIN" => ['required'],
        ],[
            "*.required" => 'Ce champ est obligatoire',
        ]);
        Retour::create([
            "NUM_COMMANDE" => $commande->NUM_COMMANDE,
            "RESPONSABLE" => $request->RESPONSABLE,
            "MOTIF" => $request->MOTIF,
            "DEBUT" => $request->DEBUT,
            "FIN" => $request->FIN,
        ]);
        return redirect()->back()->with("success", 'retour A été ajouté avec succès');
    }

}
