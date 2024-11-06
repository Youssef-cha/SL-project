<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Responsable extends Model
{
    use HasFactory;
    protected $primaryKey = 'id';
    protected $fillable = [
        'nom_responsable'
    ];
    protected function commandes(){
        return $this->hasMany(Commande::class,"RESPONSABLE_DOSSIER");
    }
}
