<?php

namespace App\Livewire;

use App\Models\Commande;
use Livewire\Component;
use Livewire\WithPagination;

class CommandesList extends Component
{
    use WithPagination;
    public $perPage = 10;
    public $search = '';
    public function render()
    {
        return view('livewire.commandes-list', [
            'commandes' => Commande::with('user')->with('fournisseur')->paginate($this->perPage)
        ]);
    }
}
