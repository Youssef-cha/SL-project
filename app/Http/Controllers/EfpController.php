<?php

namespace App\Http\Controllers;

use App\Models\Complexe;
use App\Models\Efp;
use Illuminate\Http\Request;

class EfpController extends Controller
{
    public function create(Complexe $complexe)
    {
        return view('efps.create', compact('complexe'));
    }
    public function index(Complexe $complexe)
    {
        return view('efps.index', compact('complexe'));
    }
    public function store(Request $request, Complexe $complexe)
    {
        $request->validate([
            "nom_efp" => ['required'],

        ], [
            "*.required" => 'Ce champ est obligatoire',
        ]);
        Efp::create([
            "complexe_id" => $complexe->id,
            "nom_efp" => $request->nom_efp,
        ]);
        return redirect()->back()->with("success", 'efp A été ajouté avec succès');
    }
    public function edit(Efp $efp)
    {
        return view('efps.edit', compact('efp'));
    }
    public function destroy(Efp $efp)
    {
        $complexeId = $efp->complexe->id;
        $efp->delete();
        return redirect()->route('complexes.efps.index',$complexeId);
    }
    public function update(Request $request, Efp $efp)
    {
        $validData = $request->validate([
            "nom_efp" => ['required'],
        ], [
            "*.required" => 'Ce champ est obligatoire',
        ]);
        $efp->update($validData);
        return redirect()->back()->with("success", 'efp A été mise a jour avec succès');
    }
}
