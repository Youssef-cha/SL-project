<?php

namespace App\Http\Controllers;

use App\Models\Responsable;
use Illuminate\Http\Request;

class ResponsableController extends Controller
{
    public function index()
    {
        return view('responsables.index');
    }
    public function create(){
        return view('responsables.create');
    }
    public function destroy($responsable )
    {
        $respons = Responsable::find($responsable);
        $respons->delete();

        return redirect()->back();
    }
    public function store(Request $request){
        $validData = $request->validate([
            "nom_responsable" => ['required'],
        ],[
            '*.required' => 'Ce champ est obligatoire'
        ]);
        Responsable::create($validData);
        return redirect()->back()->with('success','responsable A été ajouté avec succès');
    }
}
