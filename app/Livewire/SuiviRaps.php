<?php

namespace App\Livewire;

use App\Models\Commande;
use Livewire\Component;
use Livewire\WithPagination;

class SuiviRaps extends Component
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
        $query = Commande::with('fournisseur');
        // filter
        foreach ($this->filters as $name => $value) {
            $query->where("rubriques.$name", 'like', $value . "%");
        }
        // search
        if ($this->search) {
            $query->where('NUM_COMMANDE', 'like', $this->search . '%')
            ->orWhereHas('fournisseur' ,function($query){
                $query->where('nom_fournisseur', 'like', $this->search . '%');
            });
        }
        // sort
        $query->orderBy($this->sort, $this->sortDirection);

        return $query->paginate($this->perPage);
    }
    public function render()
    {
        $statusPai = Commande::select('STATUT_PAIEMENT')->distinct()->get();
        $commandes = $this->queryCommande();
        return view('livewire.suivi-raps', [
            'commandes' => $commandes,
            'inputFilters' => [
                'Status Paiement' => $statusPai,
            ],
            'sortColumns' => [
                'Date Commande' => 'DATE_COMMANDE',
                'HT' => 'HT',
                'TTC' => 'TTC',
                'TVA' => 'TVA',
            ]   
        ]);
    }
}
