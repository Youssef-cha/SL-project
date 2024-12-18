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
    
}
