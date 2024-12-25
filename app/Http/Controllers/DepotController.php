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
    
}
