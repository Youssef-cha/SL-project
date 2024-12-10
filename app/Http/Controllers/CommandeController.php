<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Commande;
use App\Models\Fournisseur;
use App\Models\Responsable;
use App\Models\Rubrique;
use Illuminate\Support\Facades\DB;

class CommandeController extends Controller
{
    public function index(){
        return view('commandes.index', );
    }
    public function create()
    {
        $commandes = Commande::all();
        $achatTypes = $this->getEnumValues("commandes", "TYPE_ACHAT");
        $budgetTypes = $this->getEnumValues("commandes", "TYPE_BUDGET");
        $rubriques = Rubrique::all();
        $fournisseurs = Fournisseur::orderBy('nom_fournisseur')->get();
        $responsables = Responsable::orderBy('nom_responsable')->get();

        return view("commandes.create", [
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
            "NUM_COMMANDE" => ['required', 'unique:commandes,NUM_COMMANDE'],
            "AVIS_ACHAT" => ['required'],
            "TYPE_ACHAT" => ['required'],
            "TYPE_BUDGET" => ['required'],
            "OBJET_ACHAT" => ['required'],
            "REFERENCE_RUBRIQUE" => ['required'],
            "FOURNISSEUR" => ['required'],
            "DELAI_LIVRAISON" => ['required'],
            "GARANTIE" => ['required'],
            "RETENUE_GARANTIE" => $request->GARANTIE == "oui" ? ['required'] : '',
            "NUM_MARCHE" => ['required'],
            "EXERCICE" => ['required', 'size:4'],
            "DATE_COMMANDE" => ['required'],
            "RESPONSABLE_DOSSIER" => ['required'],
        ], [
            "*.required" => "Ce champ est obligatoire",
            "NUM_COMMANDE.unique" => "Existe déjà",
            "*EXERCICE.size" => "EXERCICE Doit comporter 4 caractères"
        ]);

        Commande::create([
            "NUM_COMMANDE" => $request->NUM_COMMANDE,
            "AVIS_ACHAT" => $request->AVIS_ACHAT,
            "TYPE_ACHAT" => $request->TYPE_ACHAT,
            "TYPE_BUDGET" => $request->TYPE_BUDGET,
            "OBJET_ACHAT" => $request->OBJET_ACHAT,
            "REFERENCE_RUBRIQUE" => $request->REFERENCE_RUBRIQUE,
            "FOURNISSEUR" => $request->FOURNISSEUR,
            "DELAI_LIVRAISON" => $request->DELAI_LIVRAISON,
            "GARANTIE" => $request->GARANTIE,
            "RETENUE_GARANTIE" => $request->RETENUE_GARANTIE,
            "NUM_MARCHE" => $request->NUM_MARCHE,
            "EXERCICE" => $request->EXERCICE,
            "DATE_COMMANDE" => $request->DATE_COMMANDE,
            "RESPONSABLE_DOSSIER" => $request->RESPONSABLE_DOSSIER,
        ]);
        return redirect()->route('commandes.create')->with('success', 'commande A été ajouté avec succès');
    }

    public function edit(Commande $commande){
        $statutCommandes = $this->getEnumValues("commandes", "STATUT_COMMANDE");
        $achatTypes = $this->getEnumValues("commandes", "TYPE_ACHAT");
        $budgetTypes = $this->getEnumValues("commandes", "TYPE_BUDGET");
        $rubriques = Rubrique::all();
        $fournisseurs = Fournisseur::orderBy('nom_fournisseur')->get();
        $responsables = Responsable::orderBy('nom_responsable')->get();
        return view('commandes.edit', [
            "commande" => $commande,
            "statutCommandes" => $statutCommandes,
            "achatTypes" => $achatTypes,
            "budgetTypes" => $budgetTypes,
            "rubriques" => $rubriques,
            "fournisseurs" => $fournisseurs,
            "responsables" => $responsables,
        ]);
    }
    public function update(Request $request, Commande $commande){
        $newData = $request->validate([
            "AVIS_ACHAT" => ['required'],
            "TYPE_ACHAT" => ['required'],
            "TYPE_BUDGET" => ['required'],
            "OBJET_ACHAT" => ['required'],
            "REFERENCE_RUBRIQUE" => ['required'],
            "FOURNISSEUR" => ['required'],
            "DELAI_LIVRAISON" => ['required'],
            "GARANTIE" => ['required'],
            "RETENUE_GARANTIE" => $request->GARANTIE == "oui" ? ['required'] : '',
            "NUM_MARCHE" => ['required'],
            "EXERCICE" => ['required', 'size:4'],
            "DATE_COMMANDE" => ['required'],
            "RESPONSABLE_DOSSIER" => ['required'],
            "STATUT_COMMANDE" => ['required'],
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

}
