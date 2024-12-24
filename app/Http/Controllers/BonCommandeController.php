<?php

namespace App\Http\Controllers;

use App\Models\BonCommande;
use App\Models\Commande;
use App\Models\Efp;
use App\Models\Efp;
use App\Models\Rubrique;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Fournisseur;
use App\Models\Responsable;
use Illuminate\Support\Facades\Auth;

class BonCommandeController extends Controller
{
    public function index()
    {
        return view('bonCommandes.index');
    }
    public function create()
    {
        $achatTypes = $this->getEnumValues("commandes", "TYPE_ACHAT");
        $budgetTypes = $this->getEnumValues("commandes", "TYPE_BUDGET");
        $efps = Efp::orderBy('nom_efp')->get();
        $rubriques = Rubrique::orderBy('REFERENCE_RUBRIQUE')->get();
        $fournisseurs = Fournisseur::orderBy('nom_fournisseur')->get();
        $rubriques = Rubrique::orderBy('REFERENCE_RUBRIQUE')->get();
        $efps = Efp::orderBy('nom_efp')->get();

        return view("boncommandes.create", [
            "efps" => $efps,
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
            "AVIS_ACHAT" => ['required'],
            "OBJET_ACHAT" => ['required'],
            "TYPE_BUDGET" => ['required'],
            "TYPE_BUDGET" => ['required'],
            "OBJET_ACHAT" => ['required'],
            "rubrique_id" => ['required'],
            "fournisseur_id" => ['required'],
            "efp_id" => ['required'],
            "DELAI_LIVRAISON" => ['required'],
            "RETENUE_GARANTIE" => $request->GARANTIE == "oui" ? ['required'] : '',
            "EXERCICE" => ['required', 'size:4'],
            "DATE_COMMANDE" => ['required'],
        ], [
            "*.required" => "Ce champ est obligatoire",
            "*EXERCICE.size" => "EXERCICE Doit comporter 4 caractères"
        ]);
        $validData['numero_bon_commandes'] = $this->generateId();
        $validData['user_id'] = Auth::id();
        $validData['GARANTIE'] = request()->GARANTIE ?? 'non';
        if ($validData['GARANTIE'] == 'non') {
            $validData['RETENUE_GARANTIE'] = NULL;
        }
        BonCommande::create($validData);
        return redirect()->back()->with('success', "Bon Commande A été ajouté avec succès");
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

    public function update(Request $request, BonCommande $commande)
    {
        if (request()->update === 'paiement') {
            if ($commande->STATUT_PAIEMENT != "payee" && $commande->STATUT_PAIEMENT != "deposee") {
                return redirect()->route('depots.edit', $commande->NUM_COMMANDE)->with("error", "Vous devez d'abord mettre à jour le dépôt !");
            }
            $newData = $request->validate([
                "DATE_PAIEMENT" => ['required'],
                "MONTANT_PAYE" => ['required'],
                "oz" => ['required'],
                "STATUT_PAIEMENT" => '',
            ], [
                '*.required' => 'Ce champ est obligatoire'
            ]);
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
                "AVIS_ACHAT" => ['required'],
                "TYPE_ACHAT" => ['required'],
                "TYPE_BUDGET" => ['required'],
                "OBJET_ACHAT" => ['required'],
                "rubrique_id" => ['required'],
                "fournisseur_id" => ['required'],
                "efp_id" => ['required'],
                "DELAI_LIVRAISON" => ['required'],
                "RETENUE_GARANTIE" => $request->GARANTIE == "oui" ? ['required'] : '',
                "NUM_MARCHE" => ['required'],
                "EXERCICE" => ['required', 'size:4'],
                "DATE_COMMANDE" => ['required'],
                "STATUT_COMMANDE" => '',
            ], [
                "*.required" => "Ce champ est obligatoire",
                "*EXERCICE.size" => "EXERCICE Doit comporter 4 caractères"
            ]);

            $validData['GARANTIE'] = request()->GARANTIE ?? 'non';
            if ($validData['GARANTIE'] == 'non') {
                $validData['RETENUE_GARANTIE'] = NULL;
            }
            $commande->update($validData);
            return redirect()->back()->with('success', 'Commande A été mis à jour avec succès!');
        }
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
