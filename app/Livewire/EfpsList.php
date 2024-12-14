<?php

namespace App\Livewire;

use Livewire\Component;

class EfpsList extends Component
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
        return view('livewire.efps-list', [
            'commandes' => $commandes,
            'inputFilters' => [
              
            ],
            'sortColumns' => [
              
            ]
        ]);
    }
}
