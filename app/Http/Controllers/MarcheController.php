<?php

namespace App\Http\Controllers;

use App\Models\AppelOffre;
use App\Models\Marche;
use Illuminate\Http\Request;

class MarcheController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index($appelOffre)
    {
        $appelOffre = AppelOffre::findOrFail($appelOffre);
        return view('marches.index' , compact('appelOffre'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create($appelOffre)

    {
        $appelOffre = AppelOffre::findOrFail($appelOffre);
        return view('marches.create', compact('appelOffre'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, $appelOffre)
    {
        $appelOffre = AppelOffre::findOrFail($appelOffre);

        $validData = $request->validate([
            'numero_marche' => 'required',
            'TYPE_ACHAT' => 'required',
        ], [
            'numero_marche.required' => 'Le numéro de marché est obligatoire',
            'TYPE_ACHAT.required' => 'Le type d\'achat est obligatoire',
        ]);
        $validData['numero_appel_offre'] = $appelOffre->numero_appel_offre;
        Marche::create($validData);
        return redirect()->back()->with('success', "le Marche A été ajouter avec succès!");
    }

    public function edit(Marche $marche)
    {
        return view('marches.edit', compact('marche'));
    }

    public function update(Request $request, Marche $marche)
    {
        $validData = $request->validate([
            'numero_marche' => 'required',
            'TYPE_ACHAT' => 'required',
        ],[
            'numero_marche.required' => 'Le numéro de marché est obligatoire',
            'TYPE_ACHAT.required' => 'Le type d\'achat est obligatoire',
        ]);
        $marche->update($validData);
        return redirect()->back()->with('success', "le Marche A été mise a jour avec succès!");

    }

    public function destroy(Marche $marche)
    {
        $appelId = $marche->numero_appel_offre;
        $marche->delete();
        return redirect()->route('appelOffres.marches.index', $appelId);
    }
}
