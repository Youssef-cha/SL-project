<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Complexe extends Model
{
    use HasFactory;
    protected $fillable = [
        'nom_complexe'
    ];
    public function efps(){
        return $this->hasMany(Efp::class, "id");
    }
}
