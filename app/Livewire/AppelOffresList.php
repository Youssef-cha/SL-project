<?php

namespace App\Livewire;

use App\Models\AppelOffre;
use Livewire\Component;
use Livewire\WithPagination;

class AppelOffresList extends Component
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
        $query = AppelOffre::with([ 'marches']);
        foreach ($this->filters as $name => $value) {
            $query->where($name, 'like', $value . "%");
        }
        if ($this->search) {
            $query->where('numero_appel_offre', 'like', $this->search . '%');
        }
        return $query->orderBy($this->sort, $this->sortDirection)->paginate($this->perPage);
    }
    public function render()
    {
        $appelOffres = $this->queryCommande();
        $count = AppelOffre::count();
        return view('livewire.appel-offres-list', [
            'count' => $count,
            'appelOffres' => $appelOffres,
            'inputFilters' => [],
            'sortColumns' => []
        ]);
    }
}
