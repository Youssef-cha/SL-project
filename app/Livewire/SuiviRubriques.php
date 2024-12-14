<?php

namespace App\Livewire;

use App\Models\Rubrique;
use Livewire\Component;
use Livewire\WithPagination;

class SuiviRubriques extends Component
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
        $totalB = 0;
        $totalC = 0;
        $years = Rubrique::select('ANNEE_BUDGETAIRE')->orderBy('ANNEE_BUDGETAIRE', 'desc')->distinct()->get();
        foreach (Rubrique::with('commandes')->get() as $rubrique) {
            $diff = $rubrique->BUDGET - $rubrique->commandes->sum("TTC");
            if ($diff < 0) {
                $totalC += -$diff;
            } else {
                $totalB += $diff;
            }
        }
        $rubriques = $this->queryCommande();



        return view('livewire.suivi-rubriques', [
            'totalC' => $totalC,
            'totalB' => $totalB,
            'rubriques' => $rubriques,
            'inputFilters' => [
                'annee' => $years,
            ],
            'sortColumns' => [
                'annee' => 'ANNEE_BUDGETAIRE',
                'budget' => 'BUDGET',
                'total ttc' => 'total_ttc',
            ]
        ]);
    }
}
