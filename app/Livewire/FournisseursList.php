<?php

namespace App\Livewire;

use App\Models\Fournisseur;
use Livewire\Component;
use Livewire\WithPagination;

class FournisseursList extends Component
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
        $query = Fournisseur::with('commandes');
        foreach ($this->filters as $name => $value) {
            $query->where($name, 'like', $value . "%");
        }
        if ($this->search) {
            $query->where('nom_fournisseur', 'like', $this->search . '%');
        }
        return $query->orderBy($this->sort, $this->sortDirection)->paginate($this->perPage);
    }
    public function render()
    {
        $fournisseurs = $this->queryCommande();
        return view('livewire.fournisseurs-list', [
            'fournisseurs' => $fournisseurs,
            'inputFilters' => [
             
            ],
            'sortColumns' => [
             
            ]
        ]);
    }
}
