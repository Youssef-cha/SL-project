<?php

namespace App\Http\Controllers;

use App\Models\Complexe;
use Illuminate\Http\Request;

class ComplexeController extends Controller
{
    public function index(){
        return view('complexes.index');
    }
    public function create(){
        return view('complexes.create');
    }
    public function store(Request $request){
        $validData = $request->validate([
            "nom_complexe" => ['required'],
        ], [
            '*.required' => 'Ce champ est obligatoire'
        ]);
        Complexe::create($validData);
        return redirect()->back()->with('success','complexe A été ajouté avec succès');;
    }
    public function destroy(Complexe $complexe){
        $complexe->delete();
        return redirect()->back();
    }
}
