<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SuiviRapController extends Controller
{
    public function index(){
        return view('suiviRaps.index');
    }
}
