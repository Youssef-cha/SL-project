<?php

namespace App\Http\Controllers;

use App\Models\Commande;
use App\Models\Rubrique;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AjaxController extends Controller
{
    public function search(Request $request)
    {
        if ($request->ajax()) {
            $data = Commande::where('NUM_COMMANDE', 'like', '%' . $request->search . '%')
                ->orWhere('OBJET_ACHAT', 'like', '%' . $request->search . '%')
                ->orWhere('FOURNISSEUR', 'like', '%' . $request->search . '%')
                ->orderBy('NUM_COMMANDE', 'desc')
                ->get();
            $output = "";
            if ($data->count() > 0) {
                $output .= '<table class="afftable">
                <tr>
                            <th>Numero de commande</th>
                            <th>Avis achat</th>
                            <th>Type achat</th>
                            <th>Type budget</th>
                            <th>Objet achat</th>
                            <th>Reference rubrique</th>
                            <th>Fournisseur</th>
                            <th>Delai livraison</th>
                            <th>Garantie</th>
                            <th>Retenue garantie</th>
                            <th>Numero marche</th>
                            <th>Exercice</th>
                            <th>Date commande</th>
                            <th>Responsable dossier</th>
                            <th>Statut commande</th>
                            <th>Date livraison</th>
                            <th>Statut livraison</th>
                            <th>Lieu livraison</th>
                            <th>Date verification reception</th>
                            <th>Statut reception</th>
                            <th>Date depot SL</th>
                            <th>Numero facture</th>
                            <th>Date facture</th>
                            <th>HT</th>
                            <th>TTC</th>
                            <th>Taux TVA</th>
                            <th>Montant TVA</th>
                            <th>Date depot SC</th>
                            <th>Statut paiement</th>
                            <th>Montant paye</th>
                            <th>Date paiement</th>
                        </tr>';
                foreach ($data as $row) {
                    $output .= '<tr>
                            <td>' . $row->NUM_COMMANDE . '</td>
                            <td>' . $row->AVIS_ACHAT . '</td>
                            <td>' . $row->TYPE_ACHAT . '</td>
                            <td>' . $row->TYPE_BUDGET . '</td>
                            <td>' . $row->OBJET_ACHAT . '</td>
                            <td>' . $row->REFERENCE_RUBRIQUE . '</td>
                            <td>' . $row->FOURNISSEUR . '</td>
                            <td>' . $row->DELAI_LIVRAISON . '</td>
                            <td>' . $row->GARANTIE . '</td>
                            <td>' . $row->RETENUE_GARANTIE . '</td>
                            <td>' . $row->NUM_MARCHE . '</td>
                            <td>' . $row->EXERCICE . '</td>
                            <td>' . $row->DATE_COMMANDE . '</td>
                            <td>' . $row->RESPONSABLE_DOSSIER . '</td>
                            <td>' . $row->STATUT_COMMANDE . '</td>
                            <td>' . $row->DATE_LIVRAISON . '</td>
                            <td>' . $row->STATUT_LIVRAISON . '</td>
                            <td>' . $row->LIEU_LIVRAISON . '</td>
                            <td>' . $row->DATE_VERIFICATION_RECEPTION . '</td>
                            <td>' . $row->STATUT_RECEPTION . '</td>
                            <td>' . $row->DATE_DEPOT_SL . '</td>
                            <td>' . $row->NUM_FACTURE . '</td>
                            <td>' . $row->DATE_FACTURE . '</td>
                            <td>' . $row->HT . '</td>
                            <td>' . $row->TTC . '</td>
                            <td>' . $row->TAUX_TVA . '</td>
                            <td>' . $row->MONTANT_TVA . '</td>
                            <td>' . $row->DATE_DEPOT_SC . '</td>
                            <td>' . $row->STATUT_PAIEMENT . '</td>
                            <td>' . $row->MONTANT_PAYE . '</td>
                            <td>' . $row->DATE_PAIEMENT . '</td>
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
                                    <a class="tableLink" href=' . route('commandes.edit',$row->NUM_COMMANDE) . '>commande</a>
                                </li>
                                <li class="Link" >
                                    <a class="tableLink" href=' . route('livraisons.edit',$row->NUM_COMMANDE) . '>livraison</a>
                                </li>
                                <li class="Link" >
                                    <a class="tableLink" href=' . route('receptions.edit',$row->NUM_COMMANDE) . '>reception</a>
                                </li>
                                <li class="Link" >
                                    <a class="tableLink" href=' . route('depots.edit',$row->NUM_COMMANDE) . '>depot</a>
                                </li>
                                <li class="Link" >
                                    <a class="tableLink" href=' . route('paiements.edit',$row->NUM_COMMANDE) . '>paiement</a>
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
                                    <a class="tableLink" href=' . route('rubriques.edit',$row->REFERENCE_RUBRIQUE) . '>rubrique</a>
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
    public function list(Request $request)
    {
        if ($request->ajax()) {
            $commandes = Commande::where('NUM_COMMANDE', 'not like', '__________/____')
                ->where(function ($query) use ($request) {
                    $query->where('NUM_COMMANDE', 'like', '%' . $request->search . '%')
                        ->orWhere('FOURNISSEUR', 'like', '%' . $request->search . '%');
                })
                ->orderBy('updated_at', 'desc')
                ->get();
            $commandesWithIntervals = $commandes->map(function ($commande) {
                $daysLeft = null;
                $deadline = null;

                if ($commande->STATUT_LIVRAISON === 'livree' && $commande->STATUT_RECEPTION === 'receptionnee' && $commande->STATUT_PAIEMENT !== 'payee') {
                    $dateCommande = Carbon::parse($commande->DATE_FACTURE);
                    $deadline = $dateCommande->addDays(60)->format("Y-m-d");
                    $today = Carbon::now();
                    $daysLeft = 0;
                    if ($today < $deadline) {
                        $daysLeft = (int) $today->diffInDays($deadline, false);
                    }
                }

                return [
                    'commande' => $commande,
                    'days_left' => $daysLeft,
                    'deadline' => $deadline,
                ];
            });
            $output = "";
            if ($commandesWithIntervals->count() > 0) {
                $output .= '
                <table class="afftable">
                    <tr>
                        <th>numéro de commande</th>
                        <th>DATE COMMANDE</th>
                        <th>STATUT COMMANDE</th>
                        <th>STATUT LIVRAISON</th>
                        <th>STATUT RECEPTION</th>
                        <th>STATUT PAIEMENT</th>
                        <th>DELAI RESTANT</th>
                        <th>DATE LIMITE DE PAIEMENT</th>
                    </tr>';
                foreach ($commandesWithIntervals as $commande) {
                    $output .= '<tr>
                <td>' . $commande["commande"]->NUM_COMMANDE . '</td>
                <td>' . $commande["commande"]->DATE_COMMANDE . '</td>
                <td>' . $commande["commande"]->STATUT_COMMANDE . '</td>
                <td>' . $commande["commande"]->STATUT_LIVRAISON . '</td>
                <td>' . $commande["commande"]->STATUT_RECEPTION . '</td>
                <td>' . $commande["commande"]->STATUT_PAIEMENT . '</td>
                <td>' . $commande["days_left"] . '</td>
                <td>' . $commande["deadline"] . '</td>
            </tr>';
                }
                $output .= '</table>';
            } else {
                $output = '<h3>Aucune donnée trouvée</h3>';
            }
            echo $output;
        }
    }
    public function engagement(Request $request)
    {
        if ($request->ajax()) {
            $currentYear = Carbon::now()->format('Y');
            $commandes = Commande::where('DATE_COMMANDE', 'like', $currentYear . '%')
                ->where('NUM_COMMANDE', 'not like', '__________/____')
                ->where(function ($query) use ($request) {
                    $query->where('NUM_COMMANDE', 'like', '%' . $request->search . '%')
                        ->orWhere('FOURNISSEUR', 'like', '%' . $request->search . '%');
                })
                ->orderBy('updated_at', 'desc')
                ->get();
            $commandesWithIntervals = $commandes->map(function ($commande) {
                $daysLeft = null;
                $deadline = null;

                if ($commande->STATUT_LIVRAISON === 'livree' && $commande->STATUT_RECEPTION === 'receptionnee' && $commande->STATUT_PAIEMENT !== 'payee') {
                    $dateCommande = Carbon::parse($commande->DATE_FACTURE);
                    $deadline = $dateCommande->addDays(60)->format("Y-m-d");
                    $today = Carbon::now();
                    $daysLeft = 0;
                    if ($today < $deadline) {
                        $daysLeft = (int) $today->diffInDays($deadline, false) . "jrs";
                    }
                }

                return [
                    'commande' => $commande,
                    'days_left' => $daysLeft,
                    'deadline' => $deadline,
                ];
            });
            $output = "";
            if ($commandesWithIntervals->count() > 0) {
                $output .= '
                <table class="afftable">
                    <tr>
                        <th>numéro de commande</th>
                        <th>DATE COMMANDE</th>
                        <th>STATUT COMMANDE</th>
                        <th>STATUT LIVRAISON</th>
                        <th>STATUT RECEPTION</th>
                        <th>STATUT PAIEMENT</th>
                        <th>DELAI RESTANT</th>
                        <th>DATE LIMITE DE PAIEMENT</th>
                    </tr>';
                foreach ($commandesWithIntervals as $commande) {
                    $output .= '<tr>
                <td>' . $commande["commande"]->NUM_COMMANDE . '</td>
                <td>' . $commande["commande"]->DATE_COMMANDE . '</td>
                <td>' . $commande["commande"]->STATUT_COMMANDE . '</td>
                <td>' . $commande["commande"]->STATUT_LIVRAISON . '</td>
                <td>' . $commande["commande"]->STATUT_RECEPTION . '</td>
                <td>' . $commande["commande"]->STATUT_PAIEMENT . '</td>
                <td>' . $commande["days_left"] . ' </td>
                <td>' . $commande["deadline"] . '</td>
            </tr>';
                }
                $output .= '</table>';
            } else {
                $output = '<h3>Aucune donnée trouvée</h3>';
            }
            echo $output;
        }
    }
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
                    $taux = round($commande->MONTANT_PAYE / $commande->TTC * 100,2) . "%";
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
                                    <td>' . $commande["commande"]->FOURNISSEUR . '</td>
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
    public function rubrique(Request $request)
    {
        if ($request->ajax()) {
            $commandes = DB::table("commandes")
                ->join("rubriques", "rubriques.REFERENCE_RUBRIQUE", "=", "commandes.REFERENCE_RUBRIQUE")
                ->select(
                    DB::raw('rubriques.BUDGET - SUM(commandes.TTC) AS RESTE')
                )
                ->where('rubriques.ANNEE_BUDGETAIRE', '=', Carbon::now()->format('Y'))
                ->where('NUM_COMMANDE', 'not like', '__________/____')
                ->groupBy('rubriques.REFERENCE_RUBRIQUE', 'rubriques.BUDGET')
                ->get();

            $SearchedCommandes = DB::table("commandes")
                ->join("rubriques", "rubriques.REFERENCE_RUBRIQUE", "=", "commandes.REFERENCE_RUBRIQUE")
                ->select(
                    'rubriques.REFERENCE_RUBRIQUE',
                    'rubriques.BUDGET',
                    DB::raw('SUM(commandes.TTC) AS TOTAL_C'),
                    DB::raw('rubriques.BUDGET - SUM(commandes.TTC) AS RESTE')
                )
                ->where('rubriques.ANNEE_BUDGETAIRE', '=', Carbon::now()->format('Y'))
                ->where('NUM_COMMANDE', 'not like', '__________/____')
                ->where(function ($query) use ($request) {
                    $query->where('NUM_COMMANDE', 'like', '%' . $request->search . '%');
                })
                ->groupBy('rubriques.REFERENCE_RUBRIQUE', 'rubriques.BUDGET')
                ->get();

            $output = "";
            if ($commandes->count() > 0) {
                $resteP = 0;
                $resteB = 0;
                foreach ($commandes as $commande) {
                    $resteP += $commande->RESTE < 0 ? $commande->RESTE * -1 : 0;
                    $resteB += $commande->RESTE > 0 ? $commande->RESTE : 0;
                }
                if ($SearchedCommandes->count() > 0) {
                    $output .= '
                    <table class="afftable">
                        <tr>
                            <th>REFERENCE RUBRIQUE</th>
                            <th>BUDGET</th>
                            <th>total ttc</th>
                            <th>reste</th>
                        </tr>';
                    foreach ($SearchedCommandes as $commande) {
                        $output .= '<tr>
                                            <td>' . $commande->REFERENCE_RUBRIQUE . '</td>
                                            <td>' . $commande->BUDGET . '</td>
                                            <td>' . $commande->TOTAL_C . '</td>
                                            <td>' . $commande->RESTE . '</td>
                                        </tr>';
                    }
                    $output .= '</table>';
                } else {
                    $output = '<h3>Aucune donnée trouvée</h3>';
                }
                $output .= '<hr style="border: 1px solid #000; margin: 20px 0;">
                <h3><strong style="font-weight: 700;">Total reste à payer :</strong> ' . $resteP . '</h3>
                <h3><strong style="font-weight: 700;">Total reste du budget :</strong> ' . $resteB . '</h3>';
    
    
            
            } else {
                $output = '<hr><h3>Aucune donnée trouvée</h3>';
            }
            echo $output;
        }
    }
    public function reste(Request $request)
    {
        if ($request->ajax()) {
            $commandes = DB::table("commandes")
                ->join("rubriques", "rubriques.REFERENCE_RUBRIQUE", "=", "commandes.REFERENCE_RUBRIQUE")
                ->select(
                    'rubriques.REFERENCE_RUBRIQUE',
                    'rubriques.BUDGET',
                    DB::raw('SUM(commandes.TTC) AS TOTAL_C'),
                    DB::raw('rubriques.BUDGET - SUM(commandes.TTC) AS RESTE')
                )
                ->where('NUM_COMMANDE', 'not like', '__________/____')
                ->where('rubriques.ANNEE_BUDGETAIRE', '=', $request->search)
                ->groupBy('rubriques.REFERENCE_RUBRIQUE', 'rubriques.BUDGET')
                ->get();
            $output = "";
            if ($commandes->count() > 0) {
                $resteP = 0;
                $resteB = 0;
                $output .= '
                <table class="afftable">
                    <tr>
                        <th>REFERENCE RUBRIQUE</th>
                        <th>BUDGET</th>
                        <th>total ttc</th>
                        <th>reste</th>
                    </tr>';
                foreach ($commandes as $commande) {
                    $resteP += $commande->RESTE < 0 ? $commande->RESTE * -1 : 0;
                    $resteB += $commande->RESTE > 0 ? $commande->RESTE : 0;
                    $output .= '<tr>
                                    <td>' . $commande->REFERENCE_RUBRIQUE . '</td>
                                    <td>' . $commande->BUDGET . '</td>
                                    <td>' . $commande->TOTAL_C . '</td>
                                    <td>' . $commande->RESTE . '</td>
                                </tr>';
                }
                $output .= '</table>';
                $output .= '<h3><strong style="font-weight: 700;">Total reste à payer :</strong> ' . $resteP . '</h3>
            <h3><strong style="font-weight: 700;">Total reste du budget :</strong> ' . $resteB . '</h3>';

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
                        <th>numero de retours </th>
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
