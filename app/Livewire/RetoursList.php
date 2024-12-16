<?php

namespace App\Livewire;

use App\Models\Retour;
use Livewire\Component;
use Livewire\WithPagination;

class RetoursList extends Component
{
    use WithPagination;
    public $commande = '';
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
    public function mount($commande)
    {
        $this->commande = $commande;
    }
    public function queryCommande()
    {
        $query = Retour::query()
            ->where('NUM_COMMANDE', $this->commande);
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
        $retours = $this->queryCommande();
        return view('livewire.retours-list', [
            'retours' => $retours,
            'inputFilters' => [],
            'sortColumns' => []
        ]);
    }
}
