<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Marche extends Model
{
    use HasFactory;
    protected $guarded = [];
    public function appelOffre(){
        return $this->belongsTo(AppelOffre::class,"numero_appel_offre");
    }
    public function commandes(){
        return $this->hasMany(Commande::class,"NUM_COMMANDE");
    }
}
