<?php

namespace App\Livewire;

use App\Models\AppelOffre;
use App\Models\BonCommande;
use Livewire\Component;
use Livewire\WithPagination;

class BonCommandesList extends Component
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
        $query = BonCommande::with(['user', 'fournisseur', 'rubrique']);
        foreach ($this->filters as $name => $value) {
            $query->where($name, 'like', $value . "%");
        }
        if ($this->search) {
            $query->where('numero_bon_commandes', 'like', $this->search . '%');
        }
        return $query->orderBy($this->sort, $this->sortDirection)->paginate($this->perPage);
    }
    public function render()
    {
        $bonCommandes = $this->queryCommande();
        $count = BonCommande::count();
        return view('livewire.bon-commandes-list', [
            'count' => $count,
            'bonCommandes' => $bonCommandes,
            'inputFilters' => [],
            'sortColumns' => []
        ]);
    }
}
