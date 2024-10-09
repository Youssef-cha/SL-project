<?php

namespace App\Http\Controllers;

use App\Models\Commande;
use Illuminate\Http\Request;

class DepotController extends Controller
{
    public function edit(Commande $commande){
        return view("depots.edit",[
            "commande" => $commande
        ]);
    }
    public function update(Request $request, Commande $commande){
        $newData = $request->validate([
            "STATUT_PAIEMENT" => ['required','in:deposee'],
            "DATE_DEPOT_SC" => ['required'],
        ], [
            '*.required' => 'Ce champ est obligatoire'
        ]);
        $commande->update($newData);
        return redirect()->back()->with("success", "Depot A été mis à jour avec succès");
    }
}
