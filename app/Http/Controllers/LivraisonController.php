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
 
}
