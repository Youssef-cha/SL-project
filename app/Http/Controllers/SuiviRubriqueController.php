<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SuiviRubriqueController extends Controller
{
    public function index(){
        return view('suiviRubriques.index');
    }
}
