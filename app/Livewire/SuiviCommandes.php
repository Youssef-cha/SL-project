<?php

namespace App\Livewire;

use App\Models\Commande;
use Livewire\Component;
use Livewire\WithPagination;

class SuiviCommandes extends Component
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
        $query = Commande::with(['user', 'fournisseur', 'rubrique']);
        foreach ($this->filters as $name => $value) {
            $query->where($name, 'like', $value . "%");
        }
        if ($this->search) {
            $query->where('NUM_COMMANDE', 'like', $this->search . '%');
        }
        return $query->orderBy($this->sort, $this->sortDirection)->paginate($this->perPage);
    }
    public function render()
    {
        $statusCmd = Commande::select('STATUT_COMMANDE')->distinct()->get();
        $statusLvr = Commande::select('STATUT_LIVRAISON')->distinct()->get();
        $statusRec = Commande::select('STATUT_RECEPTION')->distinct()->get();
        $statusPai = Commande::select('STATUT_PAIEMENT')->distinct()->get();
        $commandes = $this->queryCommande();
        return view('livewire.suivi-commandes', [
            'commandes' => $commandes,
            'inputFilters' => [
                'Status Commande' => $statusCmd,
                'Status Livraison' => $statusLvr,
                'Status Reception' => $statusRec,
                'Status Paiement' => $statusPai,
            ],
            'sortColumns' => [
                'Date Commande' => 'DATE_COMMANDE',
            ]   
        ]);
    }
}
