<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class bonRetour extends Model
{
    use HasFactory;
    public $timestamps = false;

    protected $fillable = [
        "bon_commande_id",
        "user_id",
        "motif",
        "date_retour",
        "STATUT_RETOUR"

    ];
    public function bonCommande()
    {
        return $this->belongsTo(BonCommande::class);
    }
}
