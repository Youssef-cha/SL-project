<?php

namespace App\Http\Controllers;

use App\Models\BonCommande;
use App\Models\bonRetour;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class BonRetourController extends Controller
{
    public function index(BonCommande $bonCommande)
    {
        return view("bonRetours.index", compact('bonCommande'));
    }

    public function create(BonCommande $bonCommande)
    {
        return view("bonRetours.create", compact("bonCommande"));
    }
    public function edit(bonRetour $bonRetour)
    {
        // dd($bonRetour->bonCommande);
        return view('bonRetours.edit', compact('bonRetour'));
    }
    public function update(bonRetour $bonRetour)
    {
        $validDate = request()->validate([
            "motif" => ['required'],
            "date_retour" => ['required'],
        ], [
            "*.required" => 'Ce champ est obligatoire',
        ]);
        if (request()->STATUT_RETOUR == 'resolue') {
            $validDate['STATUT_RETOUR'] = 'resolue';
        } else {
            $validDate['STATUT_RETOUR'] = 'a resoudre';
        }
        $bonRetour->update($validDate);
        return redirect()->back()->with("success", 'retour A été mise a jour avec succès');
    }
    public function store(BonCommande $bonCommande)
    {
        request()->validate([
            "motif" => ['required'],
            "date_retour" => ['required'],
        ], [
            "*.required" => 'Ce champ est obligatoire',
        ]);
        bonRetour::create([
            "bon_commande_id" => $bonCommande->id,
            "user_id" => Auth::id(),
            "motif" => request()->motif,
            "date_retour" => request()->date_retour,
            "STATUT_RETOUR" => request()->STATUT_RETOUR
        ]);
        return redirect()->back()->with("success", 'retour A été ajouté avec succès');
    }
}
