<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Commande;

class Fournisseur extends Model
{
    use HasFactory;
    protected $fillable = [
        'nom_fournisseur'
    ];
    public function commandes(){
        return $this->hasMany(Commande::class,'FOURNISSEUR');
    }
}
