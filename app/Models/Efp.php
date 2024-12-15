<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Efp extends Model
{
    use HasFactory;
    public $fillable = [
        'complexe_id',
        'nom_efp'
    ];
    public function complexe()
    {
        return $this->belongsTo(Complexe::class);
    }
    public function commandes()
    {
        return $this->hasMany(Commande::class);
    }
}
