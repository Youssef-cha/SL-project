<?php

namespace App\Models;
use App\Models\Responsable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Commande extends Model
{
    use HasFactory;
    protected $guarded = [];
    protected $primaryKey = 'NUM_COMMANDE';
    protected $keyType = 'string';
    public $incrementing = false;
    public function rubrique(){
        return $this->belongsTo(Rubrique::class);
    }
    

    public function fournisseur(){
        return $this->belongsTo(Fournisseur::class);
    }
    public function user(){
        return $this->belongsTo(User::class);
    }
    public function efp(){
        return $this->belongsTo(Efp::class);
    }
    public function marche(){
        return $this->belongsTo(Marche::class);
    }

    public function retours(){
        return $this->hasMany(Retour::class,"NUM_COMMANDE");
    }
}
