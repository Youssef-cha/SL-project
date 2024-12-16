<?php

namespace App\Http\Controllers;

use App\Models\Commande;
use App\Models\Retour;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RetourController extends Controller
{
    public function index(Commande $commande)
    {
        return view("retours.index", compact('commande'));
    }

    public function create(Commande $commande)
    {
        return view("retours.create", compact("commande"));
    }
    public function edit(Retour $retour)
    {
        return view('retours.edit', compact('retour'));
    }
    public function update(Retour $retour)
    {
        $validDate = request()->validate([
            "motif" => ['required'],
            "date_retour" => ['required'],
        ], [
            "*.required" => 'Ce champ est obligatoire',
        ]);
        $retour->update($validDate);
        return redirect()->back()->with("success", 'retour A été mise a jour avec succès');
    }
    public function store(Commande $commande)
    {
        request()->validate([
            "motif" => ['required'],
            "date_retour" => ['required'],
        ], [
            "*.required" => 'Ce champ est obligatoire',
        ]);
        Retour::create([
            "NUM_COMMANDE" => $commande->NUM_COMMANDE,
            "user_id" => Auth::id(),
            "motif" => request()->motif,
            "date_retour" => request()->date_retour,
        ]);
        return redirect()->back()->with("success", 'retour A été ajouté avec succès');
    }
    public function destroy(Retour $retour)
    {
        $commandeId = $retour->commande->NUM_COMMANDE;
        $retour->delete();
        return redirect()->route('commandes.retours.index', $commandeId);
    }
}
