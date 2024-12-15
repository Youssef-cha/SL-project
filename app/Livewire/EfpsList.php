<?php

namespace App\Livewire;

use App\Models\Efp;
use Livewire\Component;
use Livewire\WithPagination;

class EfpsList extends Component
{
    use WithPagination;
    public $complexe = '';
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
    public function mount($complexe)
    {
        $this->complexe = $complexe;
    }
    public function queryCommande()
    {
        $query = Efp::with('commandes')
            ->where('complexe_id', $this->complexe);
        foreach ($this->filters as $name => $value) {
            $query->where($name, 'like', $value . "%");
        }
        if ($this->search) {
            $query->where('nom_efp', 'like', $this->search . '%');
        }
        return $query->orderBy($this->sort, $this->sortDirection)->paginate($this->perPage);
    }
    public function render()
    {
        $efps = $this->queryCommande();
        return view('livewire.efps-list', [
            'efps' => $efps,
            'inputFilters' => [],
            'sortColumns' => []
        ]);
    }
}
