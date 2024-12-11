<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SuiviCommandeController extends Controller
{
    public function index(){
        return view('suiviCommandes.index');
    }
}
