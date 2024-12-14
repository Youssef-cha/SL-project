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
