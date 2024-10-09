<?php

namespace App\Http\Controllers;

use App\Models\Commande;
use Illuminate\Http\Request;

class PaiementController extends Controller
{
    public function edit(Commande $commande){
        
        if($commande->STATUT_PAIEMENT != "payee" && $commande->STATUT_PAIEMENT != "deposee"){
            return redirect()->back()->with("error", "Vous devez d'abord mettre à jour le dépôt !");
        }
        return view("paiements.edit",[
            "commande" => $commande
        ]);
    }
    public function update(Request $request, Commande $commande){
        if($commande->STATUT_PAIEMENT != "payee" && $commande->STATUT_PAIEMENT != "deposee"){
            return redirect()->route('commandesUpdate.index')->with("error", "Vous devez d'abord mettre à jour le dépôt !");
        }
        $newData = $request->validate([
            "STATUT_PAIEMENT" => ['required','in:deposee,payee'],
            "DATE_PAIEMENT" => ['required'],
            "MONTANT_PAYE" => ['required'],
        ], [
            '*.required' => 'Ce champ est obligatoire'
        ]);
        $commande->update($newData);
        return redirect()->back()->with("success", "paiement A été mis à jour avec succès!");
    }
}
