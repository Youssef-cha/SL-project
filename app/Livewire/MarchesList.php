<?php

namespace App\Livewire;

use App\Models\AppelOffre;
use App\Models\Marche;
use Livewire\Component;
use Livewire\WithPagination;

class MarchesList extends Component
{
    use WithPagination;
    public $appelOffre = '';
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
    public function mount($appelOffre)
    {
        $this->appelOffre = $appelOffre;
    }
    public function filter()
    {
        return 1;
    }
    public function queryCommande()
    {
        $query = Marche::with(['appelOffre', 'commandes'])
        ->where('numero_appel_offre', $this->appelOffre);
        foreach ($this->filters as $name => $value) {
            $query->where($name, 'like', $value . "%");
        }
        if ($this->search) {
            $query->where('numero_marche', 'like', $this->search . '%');
        }
        return $query->orderBy($this->sort, $this->sortDirection)->paginate($this->perPage);
    }
    public function render()
    {
        $marches = $this->queryCommande();
        return view('livewire.marches-list', [
            'marches' => $marches,
            'inputFilters' => [],
            'sortColumns' => []
        ]);
    }
}
