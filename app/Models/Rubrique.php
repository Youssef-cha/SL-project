<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rubrique extends Model
{
    use HasFactory;
    protected $fillable = [
        "REFERENCE_RUBRIQUE",
        "ANNEE_BUDGETAIRE",
        "BUDGET",
    ];
    protected $primaryKey = 'REFERENCE_RUBRIQUE';
    protected $keyType = 'string';
    public $incrementing = false;
    public function commandes(){
        return $this->hasMany(Commande::class,"REFERENCE_RUBRIQUE");
    }
}
