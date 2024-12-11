<?php

namespace App\Livewire;

use Livewire\Component;

class SuiviRaps extends Component
{
    use WithPagination;
    public $perPage = 10;
    public $search = '';
    public $sort = 'rubriques.created_at';
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
        $query = Rubrique::query()
            ->selectRaw('rubriques.id , REFERENCE_RUBRIQUE , BUDGET, ANNEE_BUDGETAIRE, SUM(TTC) as total_ttc')
            ->leftJoin('commandes', 'rubriques.id', '=', 'commandes.rubrique_id')
            ->groupBy('rubriques.id', 'REFERENCE_RUBRIQUE', 'BUDGET', 'ANNEE_BUDGETAIRE');
        // filter
        foreach ($this->filters as $name => $value) {
            $query->where("rubriques.$name", 'like', $value . "%");
        }
        // search
        if ($this->search) {
            $query->where('rubriques.REFERENCE_RUBRIQUE', 'like', $this->search . '%');
        }
        // sort
        $query->orderBy($this->sort, $this->sortDirection);

        return $query->paginate($this->perPage);
    }
    public function render()
    {
        return view('livewire.suivi-raps');
    }
}
