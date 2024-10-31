<?php

namespace App\Models;

use Illuminate\Console\Command;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Retour extends Model
{
    use HasFactory;
    public $timestamps = false;
    
    protected $fillable = [
        "NUM_COMMANDE",
        "RESPONSABLE",
        "motif",
        "date_retour",
    
    ];
    public function commandes(){
        return $this->belongsTo(Commande::class,"NUM_COMMANDE");
    }
}
