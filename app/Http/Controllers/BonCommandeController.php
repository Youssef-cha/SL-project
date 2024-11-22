<?php

namespace App\Http\Controllers;

use App\Models\Commande;
use App\Models\Rubrique;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Fournisseur;
use App\Models\Responsable;

class BonCommandeController extends Controller
{

    public function create()
    {
        $commandes = Commande::all();
        $achatTypes = $this->getEnumValues("commandes", "TYPE_ACHAT");
        $budgetTypes = $this->getEnumValues("commandes", "TYPE_BUDGET");
        $rubriques = Rubrique::all();
        $fournisseurs = Fournisseur::orderBy('nom_fournisseur')->get();
        $responsables = Responsable::orderBy('nom_responsable')->get();

        return view("boncommandes.create", [
            "achatTypes" => $achatTypes,
            "budgetTypes" => $budgetTypes,
            "rubriques" => $rubriques,
            "fournisseurs" => $fournisseurs,
            "responsables" => $responsables,
        ]);
    }

    public function store(Request $request)
    {
        $validData = $request->validate([
            "AVIS_ACHAT" => ['required'],
            "TYPE_BUDGET" => ['required'],
            "OBJET_ACHAT" => ['required'],
            "REFERENCE_RUBRIQUE" => ['required'],
            "FOURNISSEUR" => ['required'],
            "DELAI_LIVRAISON" => ['required'],
            "GARANTIE" => ['required'],
            "RETENUE_GARANTIE" => $request->GARANTIE == "oui" ? ['required'] : '',
            "EXERCICE" => ['required', 'size:4'],
            "DATE_COMMANDE" => ['required'],
            "RESPONSABLE_DOSSIER" => ['required'],
        ], [
            "*.required" => "Ce champ est obligatoire",
            "*EXERCICE.size" => "EXERCICE Doit comporter 4 caractères"
        ]);
        $commandeId = $this->generateId();
        Commande::create([
            "NUM_COMMANDE" => $commandeId,
            "AVIS_ACHAT" => $request->AVIS_ACHAT,
            "TYPE_BUDGET" => $request->TYPE_BUDGET,
            "OBJET_ACHAT" => $request->OBJET_ACHAT,
            "REFERENCE_RUBRIQUE" => $request->REFERENCE_RUBRIQUE,
            "FOURNISSEUR" => $request->FOURNISSEUR,
            "DELAI_LIVRAISON" => $request->DELAI_LIVRAISON,
            "GARANTIE" => $request->GARANTIE,
            "RETENUE_GARANTIE" => $request->RETENUE_GARANTIE,
            "EXERCICE" => $request->EXERCICE,
            "DATE_COMMANDE" => $request->DATE_COMMANDE,
            "RESPONSABLE_DOSSIER" => $request->RESPONSABLE_DOSSIER,
        ]);
        return redirect()->back()->with('success', "Bon Commande n°: $commandeId A été ajouté avec succès");
    }

    public function edit($commande)
    {
        $commande = base64_decode($commande);
        $commande = Commande::findOrFail($commande);
        $statutCommandes = $this->getEnumValues("commandes", "STATUT_COMMANDE");
        $achatTypes = $this->getEnumValues("commandes", "TYPE_ACHAT");
        $budgetTypes = $this->getEnumValues("commandes", "TYPE_BUDGET");
        $rubriques = Rubrique::all();
        $fournisseurs = Fournisseur::orderBy('nom_fournisseur')->get();
        $responsables = Responsable::orderBy('nom_responsable')->get();
        return view('boncommandes.edit', [
            "commande" => $commande,
            "statutCommandes" => $statutCommandes,
            "achatTypes" => $achatTypes,
            "budgetTypes" => $budgetTypes,
            "rubriques" => $rubriques,
            "fournisseurs" => $fournisseurs,
            "responsables" => $responsables,
        ]);
    }

    public function update(Request $request, $commande)
    {
        $commande = Commande::findOrFail(base64_decode($commande));
        $newData = $request->validate([
            "AVIS_ACHAT" => ['required'],
            "TYPE_BUDGET" => ['required'],
            "OBJET_ACHAT" => ['required'],
            "REFERENCE_RUBRIQUE" => ['required'],
            "FOURNISSEUR" => ['required'],
            "DELAI_LIVRAISON" => ['required'],
            "GARANTIE" => ['required'],
            "RETENUE_GARANTIE" => $request->GARANTIE == "oui" ? ['required'] : '',
            "EXERCICE" => ['required', 'size:4'],
            "DATE_COMMANDE" => ['required'],
            "RESPONSABLE_DOSSIER" => ['required'],
        ], [
            "*.required" => "Ce champ est obligatoire",
            "*EXERCICE.size" => "EXERCICE Doit comporter 4 caractères"
        ]);
        $commande->update($newData);
        return redirect()->back()->with('success', 'Commande A été mis à jour avec succès!');
    }

    private function getEnumValues($tableName, $columnName)
    {

        $enumValues = DB::select("SHOW COLUMNS FROM $tableName WHERE Field = ?", [$columnName])[0]->Type;
        preg_match("/^enum\(\'(.*)\'\)$/", $enumValues, $matches);
        $enumValues = explode("','", $matches[1]);
        return $enumValues;
    }
    
    private function generateId()
    {
        $numbers = '';
        for ($i = 0; $i < 10; $i++) {
            $numbers .= mt_rand(0, 9);
        }
        $year = Carbon::now()->format('Y');
        $id = $numbers . '/' . $year;
        if (Commande::find($id)) {
            $id = $this->generateId();
        }
        return $id;
    }
}
