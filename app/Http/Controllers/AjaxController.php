<?php

namespace App\Http\Controllers;

use App\Models\Commande;
use App\Models\Complexe;
use App\Models\Fournisseur;
use App\Models\Responsable;
use App\Models\Rubrique;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use function PHPUnit\Framework\isNull;

class AjaxController extends Controller
{
    // search
    
    // suivi des commanedes
    // suivi des rubriques
    
    // suivi des rap
    public function rap(Request $request)
    {
        if ($request->ajax()) {
            $commandes = Commande::where('EXERCICE', 'like', '%' . $request->search . '%')
                ->where('NUM_COMMANDE', 'not like', '__________/____')
                ->orderBy('updated_at', 'desc')
                ->get();
            $commandes = $commandes->map(function ($commande) {
                $taux = null;
                if ($commande->TTC != null && $commande->MONTANT_PAYE != null) {
                    $taux = round($commande->MONTANT_PAYE / $commande->TTC * 100, 2) . "%";
                }
                return [
                    'commande' => $commande,
                    'taux' => $taux,
                ];
            });
            $output = "";
            if ($commandes->count() > 0) {
                $output .= '
                <table class="afftable">
                    <tr>
                        <th>numéro de commande</th>
                        <th>DATE COMMANDE</th>
                        <th>fournisseur</th>
                        <th>ht</th>
                        <th>ttc</th>
                        <th>tva</th>
                        <th>montant paye</th>
                        <th>taux</th>
                        <th>statut paiement</th>
                    </tr>';
                foreach ($commandes as $commande) {
                    $output .= '<tr>
                                    <td>' . $commande["commande"]->NUM_COMMANDE . '</td>
                                    <td>' . $commande["commande"]->DATE_COMMANDE . '</td>
                                    <td>' . $commande["commande"]->FOURNISSEUR->nom_fournisseur . '</td>
                                    <td>' . $commande["commande"]->HT . '</td>
                                    <td>' . $commande["commande"]->TTC . '</td>
                                    <td>' . $commande["commande"]->MONTANT_TVA . '</td>
                                    <td>' . $commande["commande"]->MONTANT_PAYE . '</td>
                                    <td>' . $commande["taux"] . '</td>
                                    <td>' . $commande["commande"]->STATUT_PAIEMENT . '</td>
                                </tr>';
                }
                $output .= '</table>';
            } else {
                $output = '<h3>Aucune donnée trouvée</h3>';
            }
            echo $output;
        }
    }
    public function editCommande(Request $request)
    {
        if ($request->ajax()) {
            $commandes = Commande::where('NUM_COMMANDE', 'not like', '__________/____')
                ->where(function ($query) use ($request) {
                    $query->where('NUM_COMMANDE', 'like', '%' . $request->search . '%')
                        ->orWhere('OBJET_ACHAT', 'like', '%' . $request->search . '%')
                        ->orWhere('FOURNISSEUR', 'like', '%' . $request->search . '%');
                })
                ->orderBy('updated_at', 'desc')
                ->get();
            $boncommandes = Commande::where('NUM_COMMANDE', 'like', '__________/____')
                ->where(function ($query) use ($request) {
                    $query->where('NUM_COMMANDE', 'like', '%' . $request->search . '%')
                        ->orWhere('OBJET_ACHAT', 'like', '%' . $request->search . '%')
                        ->orWhere('FOURNISSEUR', 'like', '%' . $request->search . '%');
                })
                ->orderBy('NUM_COMMANDE', 'desc')
                ->get();
            $output = "<h2>commandes:</h2>";
            if ($commandes->count() > 0) {
                $output .= '
                <table class="afftable">
                    <tr>
                        <th>Numéro de commande</th>
                        <th>CRÉÉ À</th>
                        <th>MIS À JOUR À</th>
                        <th>Mettre à jour</th>
                    </tr>';
                foreach ($commandes as $row) {
                    $output .= '<tr>
                            <td>' . $row->NUM_COMMANDE . '</td>
                            <td>' . $row->created_at->format('Y-m-d') . '</td>
                            <td>' . $row->updated_at->format('Y-m-d') . '</td>
                            <td>
                            <ul>
                                <li class="Link" >
                                    <a class="tableLink" href=' . route('commandes.edit', $row->NUM_COMMANDE) . '>commande</a>
                                </li>
                                <li class="Link" >
                                    <a class="tableLink" href=' . route('livraisons.edit', $row->NUM_COMMANDE) . '>livraison</a>
                                </li>
                                <li class="Link" >
                                    <a class="tableLink" href=' . route('receptions.edit', $row->NUM_COMMANDE) . '>reception</a>
                                </li>
                                <li class="Link" >
                                    <a class="tableLink" href=' . route('depots.edit', $row->NUM_COMMANDE) . '>depot</a>
                                </li>
                                <li class="Link" >
                                    <a class="tableLink" href=' . route('paiements.edit', $row->NUM_COMMANDE) . '>paiement</a>
                                </li>
                            </ul>
                            </td>
                        </tr>';
                }
                $output .= '</table>';
            } else {
                $output .= '<h3>Aucune donnée trouvée</h3>';
            }
            $output .= "<hr><h2>bon commande:</h2>";
            if ($boncommandes->count() > 0) {
                $output .= '
                <table class="afftable">
                    <tr>
                        <th>Numero de commande</th>
                        <th>CRÉÉ À</th>
                        <th>MIS À JOUR À</th>
                        <th>Mettre à jour</th>
                    </tr>';
                foreach ($boncommandes as $row) {
                    $output .= "<tr>
                                <td>" . $row->NUM_COMMANDE . "</td>
                                <td>" . $row->created_at->format('Y-m-d') . "</td>
                                <td>" . $row->updated_at->format('Y-m-d') . "</td>
                                <td>
                                    <a href='" . route('boncommandes.edit', base64_encode($row->NUM_COMMANDE)) . "' class='link'>modifier bon commande</a>
                                </td>
                            </tr>";
                }

                $output .= '</table>';
            } else {
                $output .= '<h3 >Aucune donnée trouvée</h3>';
            }
            echo $output;
        }
    }
    public function editRubrique(Request $request)
    {
        if ($request->ajax()) {
            $rubriques = Rubrique::where("REFERENCE_RUBRIQUE", 'like', '%' . $request->search . '%')
                ->orWhere("ANNEE_BUDGETAIRE", 'like', '%' . $request->search . '%')
                ->orderBy('updated_at', 'desc')
                ->get();

            $output = "";
            if ($rubriques->count() > 0) {
                $output .= '
                <table class="afftable">
                    <tr>
                        <th>reference rubrique</th>
                        <th>annee budgetaire</th>
                        <th>CRÉÉ À</th>
                        <th>MIS À JOUR À</th>
                        <th>Mettre à jour</th>
                        
                    </tr>';
                foreach ($rubriques as $row) {
                    $output .= '<tr>
                            <td>' . $row->REFERENCE_RUBRIQUE  . '</td>
                            <td>' . $row->ANNEE_BUDGETAIRE   . '</td>
                            <td>' . $row->created_at->format('Y-m-d') . '</td>
                            <td>' . $row->updated_at->format('Y-m-d') . '</td>
                            <td>
                                    <a class="tableLink" href=' . route('rubriques.edit', $row->REFERENCE_RUBRIQUE) . '>rubrique</a>
                            </td>
                        </tr>';
                }
                $output .= '</table>';
            } else {
                $output .= '<h3>Aucune donnée trouvée</h3>';
            }

            echo $output;
        }
    }










    public function complexesList(Request $request)
    {
        if ($request->ajax()) {
            $complexes = Complexe::where('nom_complexe', 'like', '%' . $request->search . '%')
                ->orWhere('id', 'like', '%' . $request->search . '%')->get();
            $output = "";
            if ($complexes->count() > 0) {
                $output .= '
                <table class="afftable">
                    <tr>
                        <th>id </th>
                        <th>nom complexe </th>
                        <th>nombre des efps </th>
                        <th>creer a </th>
                        <th>supprimer</th>
                    </tr>';
                foreach ($complexes as $complexe) {
                    $link = '
                            <a href="' . route("complexes.destroy", ["complexe" => $complexe->id]) . '" class="link" onclick="return confirmDelete()">supprimer</a> ' .
                        ($complexe->efps->count() != 0 ?
                            '<a href="' . ($complexe->efps->count() == 0 ? "" :
                                route("complexes.efps.index", ["complexe" => $complexe->id])) . '" class="link">efps</a>' : "") . '
                            <a href="' . route("complexes.efps.create", ["complexe" => $complexe->id]) . '" class="link">ajouter un efp</a>
                        ';

                    $output .= '<tr>
                                        <td>' . $complexe->id . '</td>
                                        <td>' . $complexe->nom_complexe . '</td>
                                        <td>' . $complexe->efps->count() . '</td>
                                        <td>' . $complexe->created_at . '</td>
                                        <td>' . $link . '</td>
                                    </tr>';
                }


                $output .= '</table>';
            } else {
                $output = '<h3>Aucune donnée trouvée</h3>';
            }
            echo $output;
        }
    }
    public function responsablesList(Request $request)
    {

        if ($request->ajax()) {
            $responsables = Responsable::where('nom_responsable', 'like', '%' . $request->search . '%')
                ->orWhere('id', 'like', '%' . $request->search . '%')->get();
            $output = "";
            if ($responsables->count() > 0) {
                $output .= '
                <table class="afftable">
                    <tr>
                        <th>id </th>
                        <th>nom responsable </th>
                        <th>nombre des commande </th>
                        <th>creer a </th>
                        <th>supprimer</th>
                    </tr>';
                foreach ($responsables as $responsable) {
                    $link = '
                     <a href="' . route("responsables.destroy", ["responsable" => $responsable->id]) . '" class="link" onclick="return confirmDelete()">supprimer</a>';

                    $output .= '<tr>
                                        <td>' . $responsable->id . '</td>
                                        <td>' . $responsable->nom_responsable . '</td>
                                        <td>' . $responsable->commandes->count() . '</td>
                                        <td>' . $responsable->created_at . '</td>
                                        <td>' . $link . '</td>
                                </tr>';
                }

                $output .= '</table>';
            } else {
                $output = '<h3>Aucune donnée trouvée</h3>';
            }
            echo $output;
        }
    }
    public function fournisseursList(Request $request)
    {
        if ($request->ajax()) {
            $fournisseurs = Fournisseur::where('nom_fournisseur', 'like', '%' . $request->search . '%')
                ->orWhere('id', 'like', '%' . $request->search . '%')->get();
            $output = "";
            if ($fournisseurs->count() > 0) {
                $output .= '
                <table class="afftable">
                    <tr>
                        <th>id </th>
                        <th>nom fournisseur </th>
                        <th>nombre des commande </th>
                        <th>creer a </th>
                        <th>supprimer</th>
                    </tr>';
                foreach ($fournisseurs as $fournisseur) {
                    $link = '
                     <a href="' . route("fournisseurs.destroy", ["fournisseur" => $fournisseur->id]) . '" class="link" onclick="return confirmDelete()">supprimer</a>';

                    $output .= '<tr>
                                        <td>' . $fournisseur->id . '</td>
                                        <td>' . $fournisseur->nom_fournisseur . '</td>
                                        <td>' . $fournisseur->commandes->count() . '</td>
                                        <td>' . $fournisseur->created_at . '</td>
                                        <td>' . $link . '</td>
                                </tr>';
                }

                $output .= '</table>';
            } else {
                $output = '<h3>Aucune donnée trouvée</h3>';
            }
            echo $output;
        }
    }
    public function retours(Request $request)
    {
        if ($request->ajax()) {
            $commandes = Commande::where('NUM_COMMANDE', 'not like', '__________/____')
                ->where('NUM_COMMANDE', 'like', '%' . $request->search . '%')
                ->get();
            $output = "";
            if ($commandes->count() > 0) {
                $output .= '
                <table class="afftable">
                    <tr>
                        <th>NUM_COMMANDE </th>
                        <th>nombre de retours </th>
                        <th>actions</th>
                    </tr>';
                foreach ($commandes as $commande) {
                    $link = $commande->retours->count() != 0
                        ? '<br> <a href="' . route("commandes.retours.index", ["commande" => $commande->NUM_COMMANDE]) . '" class="link">voir tous les retours</a>'
                        : "";

                    $output .= '<tr>
                                        <td>' . $commande->NUM_COMMANDE . '</td>
                                        <td>' . $commande->retours->count() . '</td>
                                        <td>
                                            <a href="' . route("commandes.retours.create", $commande->NUM_COMMANDE) . '" class="link">créer un retour</a>'
                        . $link .
                        '</td>
                                    </tr>';
                }

                $output .= '</table>';
            } else {
                $output = '<h3>Aucune donnée trouvée</h3>';
            }
            echo $output;
        }
    }
}
