<?php

namespace App\Http\Controllers;

use App\Models\Commande;
use Illuminate\Http\Request;

class LivraisonController extends Controller
{
    public function edit(Commande $commande){
        return view("livraisons.edit",[
            "commande" => $commande
        ]);
    }
    public function update(Request $request, Commande $commande){
        $newData = $request->validate([
            "STATUT_LIVRAISON" => ['required','in:Livrée'],
            "DATE_LIVRAISON" => ['required'],
            "LIEU_LIVRAISON" => ['required'],
        ], [
            '*.required' => 'Ce champ est obligatoire'
        ]);
        $commande->update($newData);
        return redirect()->back()->with("success", "livraison A été mis à jour avec succès!");
    }
}
