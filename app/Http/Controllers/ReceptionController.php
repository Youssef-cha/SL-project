<?php

namespace App\Http\Controllers;

use App\Models\Commande;
use Illuminate\Http\Request;

class ReceptionController extends Controller
{
    public function edit(Commande $commande){
        return view("receptions.edit",[
            "commande" => $commande
        ]);
    }
    public function update(Request $request, Commande $commande){
        $newData = $request->validate([
            "STATUT_RECEPTION" => ['required','in:réceptionnée'],
            "DATE_VERIFICATION_RECEPTION" => ['required'],
            "DATE_DEPOT_SL" => ['required'],
            "NUM_FACTURE" => ['required'],
            "DATE_FACTURE" => ['required'],
            "HT" => ['required'],
            "TTC" => ['required'],
            "TAUX_TVA" => ['required'],
            "MONTANT_TVA" => ['required'],
        ]);
        $commande->update($newData);
        return redirect()->back()->with("success", "reception A été mis à jour avec succès!");
    }
}
