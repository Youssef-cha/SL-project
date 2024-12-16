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
            return redirect()->route('depots.edit' , $commande->NUM_COMMANDE)->with("error", "Vous devez d'abord mettre à jour le dépôt !");
        }
        $newData = $request->validate([
            "DATE_PAIEMENT" => ['required'],
            "MONTANT_PAYE" => ['required'],
            "oz" => ['required'],
            "STATUT_PAIEMENT" => '',
        ], [
            '*.required' => 'Ce champ est obligatoire'
        ]);
        $commande->update($newData);
        return redirect()->back()->with("success", "paiement A été mis à jour avec succès!");
    }
}
