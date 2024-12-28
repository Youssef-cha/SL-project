<?php

namespace App\Livewire;

use App\Models\bonRetour;
use Livewire\Component;
use Livewire\WithPagination;

class BonRetoursList extends Component
{
    use WithPagination;

    public $bonCommande = '';
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

    public function mount($bonCommande)
    {
        $this->bonCommande = $bonCommande;
    }

    public function queryCommande()
    {
        $query = bonRetour::query()
            ->where('bon_commande_id', $this->bonCommande);
        foreach ($this->filters as $name => $value) {
            $query->where($name, 'like', $value . "%");
        }
        if ($this->search) {
            $query->where('id', 'like', $this->search . '%');
        }
        return $query->orderBy($this->sort, $this->sortDirection)->paginate($this->perPage);
    }

    public function render()
    {
        $bonRetours = $this->queryCommande();
        return view('livewire.bon-retours-list', [
            'bonRetours' => $bonRetours,
            'inputFilters' => [],
            'sortColumns' => []
        ]);
    }
}
