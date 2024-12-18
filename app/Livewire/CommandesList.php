<?php

namespace App\Livewire;

use App\Models\Commande;
use Livewire\Component;
use Livewire\WithPagination;

class CommandesList extends Component
{
    use WithPagination;
    public $perPage = 10;
    public $search = '';
    public $sort = 'created_at';
    public $sortDirection = 'asc';
    public $filters = [];

    public function updated($prop)
    {
        if (in_array($prop, ['perPage', 'search', 'filters', 'sort'])) {
            $this->resetPage();
        }
    }
    public function filter()
    {
        // nothing here but it is required
    }
    public function queryCommande()
    {
        $query = Commande::with(['user', 'fournisseur', 'rubrique', 'retours', 'appelOffre']);
        foreach ($this->filters as $name => $value) {
            $query->where($name, 'like', $value . "%");
        }
        if ($this->search) {
            $query->where('NUM_COMMANDE', 'like', $this->search . '%')
                ->orWhereHas(
                    'fournisseur',
                    function ($query) {
                        $query->where('nom_fournisseur', 'like', $this->search . '%');
                    }
                )
                ->orWhereHas(
                    'rubrique',
                    function ($query) {
                        $query->where('REFERENCE_RUBRIQUE', 'like', $this->search . '%');
                    }
                )
                ->orWhereHas(
                    'user',
                    function ($query) {
                        $query->where('name', 'like', $this->search . '%');
                    }
                )
            ;
        }
        return $query->orderBy($this->sort, $this->sortDirection)->paginate($this->perPage);
    }
    public function render()
    {
        $typeAchat = Commande::select('type_achat')->distinct()->get();
        $typeBudget = Commande::select('TYPE_BUDGET')->distinct()->get();
        $Garantie = Commande::select('Garantie')->distinct()->get();
        $statusCmd = Commande::select('STATUT_COMMANDE')->distinct()->get();
        $statusLvr = Commande::select('STATUT_LIVRAISON')->distinct()->get();
        $statusRec = Commande::select('STATUT_RECEPTION')->distinct()->get();
        $statusPai = Commande::select('STATUT_PAIEMENT')->distinct()->get();
        $commandes = $this->queryCommande();

            return view('livewire.commandes-list', [
                'commandes' => $commandes,
                'inputFilters' => [
                    'Type Achat' => $typeAchat,
                    'Type Budget' => $typeBudget,
                    'Garantie' => $Garantie,
                    'Status Commande' => $statusCmd,
                    'Status Livraison' => $statusLvr,
                    'Status Reception' => $statusRec,
                    'Status Paiement' => $statusPai,
                ],
                'sortColumns' => [
                    'Delai Livraison' => 'DELAI_LIVRAISON',
                    'Retenue Garantie' => 'RETENUE_GARANTIE',
                    'Exercice' => 'EXERCICE',
                    'Date Commande' => 'DATE_COMMANDE',
                    'Date Livraison' => 'DATE_LIVRAISON',
                    'Date Verification Reception' => 'DATE_VERIFICATION_RECEPTION',
                    'Date Depot (Service Logistique)' => 'DATE_DEPOT_SL',
                    'Date Depot (Service comptabilite)' => 'DATE_DEPOT_SC',
                    'Date Facture' => 'DATE_FACTURE',
                    'HT' => 'HT',
                    'TTC' => 'TTC',
                    'TAUX_TVA' => 'TAUX_TVA',
                    'Montant TVA' => 'MONTANT_TVA',
                    'Date Paiement' => 'DATE_PAIEMENT',
                    'Montant Paye' => 'MONTANT_PAYE',
                ]
            ]);
     
    }
}
