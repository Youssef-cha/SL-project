<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Commande;
use App\Models\Efp;
use App\Models\Fournisseur;
use App\Models\Responsable;
use App\Models\Rubrique;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CommandeController extends Controller
{
    public function index(){
        return view('commandes.index', );
    }
    public function create()
    {
        $achatTypes = $this->getEnumValues("commandes", "TYPE_ACHAT");
        $budgetTypes = $this->getEnumValues("commandes", "TYPE_BUDGET");
        $rubriques = Rubrique::all();
        $efps = Efp::orderBy('nom_efp')->get();
        $fournisseurs = Fournisseur::orderBy('nom_fournisseur')->get();

        return view("commandes.create", [
            "achatTypes" => $achatTypes,
            "efps" => $efps,
            "budgetTypes" => $budgetTypes,
            "rubriques" => $rubriques,
            "fournisseurs" => $fournisseurs,
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
            "rubrique_id" => ['required'],
            "fournisseur_id" => ['required'],
            "efp_id" => ['required'],
            "DELAI_LIVRAISON" => ['required'],
            "GARANTIE" => '',
            "RETENUE_GARANTIE" => $request->GARANTIE == "oui" ? ['required'] : '',
            "NUM_MARCHE" => ['required'],
            "EXERCICE" => ['required', 'size:4'],
            "DATE_COMMANDE" => ['required'],
        ], [
            "*.required" => "Ce champ est obligatoire",
            "NUM_COMMANDE.unique" => "Numero de Commande Existe Déjà",
            "*EXERCICE.size" => "Exercice Doit comporter 4 caractères"
        ]);
        $validData["GARANTIE"] = $request->GARANTIE ?? 'non';
        $validData["user_id"] = Auth::id();
        Commande::create($validData);
        return redirect()->route('commandes.create')->with('success', 'commande A été ajouté avec succès');
    }

    public function edit(Commande $commande){
        $statutCommandes = $this->getEnumValues("commandes", "STATUT_COMMANDE");
        $achatTypes = $this->getEnumValues("commandes", "TYPE_ACHAT");
        $budgetTypes = $this->getEnumValues("commandes", "TYPE_BUDGET");
        $rubriques = Rubrique::orderBy('REFERENCE_RUBRIQUE')->get();
        $efps = Efp::orderBy('nom_efp')->get();
        $fournisseurs = Fournisseur::orderBy('nom_fournisseur')->get();
        return view('commandes.edit', [
            "commande" => $commande,
            "efps" => $efps,
            "statutCommandes" => $statutCommandes,
            "achatTypes" => $achatTypes,
            "budgetTypes" => $budgetTypes,
            "rubriques" => $rubriques,
            "fournisseurs" => $fournisseurs,
        ]);
    }
    public function update(Request $request, Commande $commande){
        
        $validData = $request->validate([
            "AVIS_ACHAT" => ['required'],
            "TYPE_ACHAT" => ['required'],
            "TYPE_BUDGET" => ['required'],
            "OBJET_ACHAT" => ['required'],
            "rubrique_id" => ['required'],
            "fournisseur_id" => ['required'],
            "efp_id" => ['required'],
            "DELAI_LIVRAISON" => ['required'],
            "GARANTIE" => '',
            "RETENUE_GARANTIE" => $request->GARANTIE == "oui" ? ['required'] : '',
            "NUM_MARCHE" => ['required'],
            "EXERCICE" => ['required', 'size:4'],
            "DATE_COMMANDE" => ['required'],
            "STATUT_COMMANDE" => '',
        ], [
            "*.required" => "Ce champ est obligatoire",
            "*EXERCICE.size" => "EXERCICE Doit comporter 4 caractères"
        ]);
        // dd($validData);
        $validData['GARANTIE'] = request()->GARANTIE ?? 'non';
        // dd($validData);
        $commande->update($validData);
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
