<?php

namespace App\Http\Controllers;

use App\Models\AppelOffre;
use App\Models\BonCommande;
use Illuminate\Http\Request;
use App\Models\Commande;
use App\Models\Efp;
use App\Models\Fournisseur;
use App\Models\Marche;
use App\Models\Responsable;
use App\Models\Rubrique;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CommandeController extends Controller
{
    public function index()
    {
        return view('commandes.index',);
    }
    public function create()
    {
        $budgetTypes = $this->getEnumValues("commandes", "TYPE_BUDGET");
        $rubriques = Rubrique::all();
        $efps = Efp::orderBy('nom_efp')->get();
        $fournisseurs = Fournisseur::orderBy('nom_fournisseur')->get();
        $marches = Marche::with('appelOffre')->orderBy('numero_marche')->get();

        return view("commandes.create", [
            "marches" => $marches,
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
            "TYPE_BUDGET" => ['required'],
            "OBJET_ACHAT" => ['required'],
            "marche_id" => ['required'],
            "rubrique_id" => ['required'],
            "fournisseur_id" => ['required'],
            "efp_id" => ['required'],
            "DELAI_LIVRAISON" => ['required'],
            "GARANTIE" => '',
            "RETENUE_GARANTIE" => $request->GARANTIE == "oui" ? ['required'] : '',
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
    public function edit(Commande $commande)
    {
        $statutCommandes = $this->getEnumValues("commandes", "STATUT_COMMANDE");
        $budgetTypes = $this->getEnumValues("commandes", "TYPE_BUDGET");
        $rubriques = Rubrique::orderBy('REFERENCE_RUBRIQUE')->get();
        $efps = Efp::orderBy('nom_efp')->get();
        $fournisseurs = Fournisseur::orderBy('nom_fournisseur')->get();
        $marches = Marche::with('appelOffre')->orderBy('numero_marche')->get();
        return view('commandes.edit', [
            "marches" => $marches,
            "commande" => $commande,
            "efps" => $efps,
            "statutCommandes" => $statutCommandes,
            "budgetTypes" => $budgetTypes,
            "rubriques" => $rubriques,
            "fournisseurs" => $fournisseurs,
        ]);
    }
    public function update(Request $request, Commande $commande)
    {

        if (request()->update === 'paiement') {
            if ($commande->STATUT_PAIEMENT != "payee" && $commande->STATUT_PAIEMENT != "deposee") {
                return redirect()->route('depots.edit', $commande->NUM_COMMANDE)->with("error", "Vous devez d'abord mettre à jour le dépôt !");
            }
            $newData = $request->validate([
                "DATE_PAIEMENT" => ['required'],
                "MONTANT_PAYE" => ['required'],
                "ov" => ['required'],
                "op" => ['required'],
            ], [
                '*.required' => 'Ce champ est obligatoire'
            ]);
            if(request()->STATUT_PAIEMENT){
                $newData['STATUT_PAIEMENT'] = request()->STATUT_PAIEMENT;
            }else{
                $newData['STATUT_PAIEMENT'] = "deposee";
            }
            $commande->update($newData);
            return redirect()->back()->with("success", "paiement A été mis à jour avec succès!");
        } elseif (request()->update === 'reception') {
            $newData = $request->validate([
                "STATUT_RECEPTION" => ['required', 'in:réceptionnée'],
                "DATE_VERIFICATION_RECEPTION" => ['required'],
                "DATE_DEPOT_SL" => ['required'],
                "NUM_FACTURE" => ['required'],
                "DATE_FACTURE" => ['required'],
                "HT" => ['required'],
                "TTC" => ['required'],
                "TAUX_TVA" => ['required'],
                "MONTANT_TVA" => ['required'],
            ]);
            $commande->update($newData);
            return redirect()->back()->with("success", "reception A été mis à jour avec succès!");
        } elseif (request()->update === 'depot') {
            $newData = $request->validate([
                "STATUT_PAIEMENT" => ['required', 'in:deposee'],
                "DATE_DEPOT_SC" => ['required'],
            ], [
                '*.required' => 'Ce champ est obligatoire'
            ]);
            $commande->update($newData);
            return redirect()->back()->with("success", "Depot A été mis à jour avec succès");
        } elseif (request()->update === 'livraison') {
            $newData = $request->validate([
                "STATUT_LIVRAISON" => ['required', 'in:Livrée'],
                "DATE_LIVRAISON" => ['required'],
                "LIEU_LIVRAISON" => ['required'],
            ], [
                '*.required' => 'Ce champ est obligatoire'
            ]);
            $commande->update($newData);
            return redirect()->back()->with("success", "livraison A été mis à jour avec succès!");
        } else {
            $validData = $request->validate([
                "TYPE_BUDGET" => ['required'],
                "OBJET_ACHAT" => ['required'],
                "rubrique_id" => ['required'],
                "fournisseur_id" => ['required'],
                "marche_id" => ['required'],
                "efp_id" => ['required'],
                "DELAI_LIVRAISON" => ['required'],
                "RETENUE_GARANTIE" => $request->GARANTIE == "oui" ? ['required'] : '',
                "EXERCICE" => ['required', 'size:4'],
                "DATE_COMMANDE" => ['required'],
            ], [
                "*.required" => "Ce champ est obligatoire",
                "*EXERCICE.size" => "EXERCICE Doit comporter 4 caractères"
            ]);

            $validData['GARANTIE'] = request()->GARANTIE ?? 'non';
            if ($validData['GARANTIE'] == 'non') {
                $validData['RETENUE_GARANTIE'] = NULL;
            }
            if(request()->STATUT_COMMANDE){
                $validData['STATUT_COMMANDE'] = request()->STATUT_COMMANDE;
            }else{
                $validData['STATUT_COMMANDE'] = "attribuee";
            }
            $commande->update($validData);
            return redirect()->back()->with('success', 'Commande A été mis à jour avec succès!');
        }
    }
    private function getEnumValues($tableName, $columnName)
    {

        $enumValues = DB::select("SHOW COLUMNS FROM $tableName WHERE Field = ?", [$columnName])[0]->Type;
        preg_match("/^enum\(\'(.*)\'\)$/", $enumValues, $matches);
        return explode("','", $matches[1]);
    }
}
