<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BonCommande extends Model
{
    use HasFactory;
    protected $guarded = [];
    public function rubrique(){
        return $this->belongsTo(Rubrique::class);
    }
    public function fournisseur(){
        return $this->belongsTo(Fournisseur::class);
    }
    public function efp(){
        return $this->belongsTo(Efp::class);
    }
    public function user(){
        return $this->belongsTo(User::class);
    }


}
