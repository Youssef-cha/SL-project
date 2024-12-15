<?php

namespace App\Livewire;

use App\Models\Complexe;
use App\Models\Fournisseur;
use Livewire\Component;
use Livewire\WithPagination;

class ComplexesList extends Component
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
        $query = Complexe::with('efps');
        foreach ($this->filters as $name => $value) {
            $query->where($name, 'like', $value . "%");
        }
        if ($this->search) {
            $query->where('nom_complexe', 'like', $this->search . '%');
        }
        return $query->orderBy($this->sort, $this->sortDirection)->paginate($this->perPage);
    }
    public function render()
    {
        $complexes = $this->queryCommande();
        return view('livewire.complexes-list', [
            'complexes' => $complexes,
            'inputFilters' => [],
            'sortColumns' => []
        ]);
    }
}
