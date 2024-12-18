<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AppelOffre extends Model
{
    use HasFactory;
    protected $primaryKey = 'numero_appel_offre';
    protected $keyType = 'string';
    public $incrementing = false;
    protected $guarded= [];
    public function commandes(){
        return $this->hasMany(Commande::class,'numero_appel_offre');
    }
}
