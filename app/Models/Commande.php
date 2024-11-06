<?php

namespace App\Models;
use App\Models\Responsable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Commande extends Model
{
    use HasFactory;
    protected $fillable = [
        "NUM_COMMANDE",
        "AVIS_ACHAT",
        "TYPE_ACHAT",
        "TYPE_BUDGET",
        "OBJET_ACHAT",
        "REFERENCE_RUBRIQUE",
        "FOURNISSEUR",
        "DELAI_LIVRAISON",
        "GARANTIE",
        "RETENUE_GARANTIE",
        "NUM_MARCHE",
        "EXERCICE",
        "DATE_COMMANDE",
        "RESPONSABLE_DOSSIER",
        "STATUT_COMMANDE",
        "DATE_LIVRAISON",
        "STATUT_LIVRAISON",
        "oz",
        "LIEU_LIVRAISON",
        "DATE_VERIFICATION_RECEPTION",
        "STATUT_RECEPTION",
        "DATE_DEPOT_SL",
        "NUM_FACTURE",
        "DATE_FACTURE",
        "HT",
        "TTC",
        "TAUX_TVA",
        "MONTANT_TVA",
        "DATE_DEPOT_SC",
        "STATUT_PAIEMENT",
        "DATE_PAIEMENT",
        "MONTANT_PAYE"
    ];
    protected $primaryKey = 'NUM_COMMANDE';
    protected $keyType = 'string';
    public $incrementing = false;
    public function rubrique(){
        return $this->belongsTo(Rubrique::class, "REFERENCE_RUBRIQUE");
    }

    public function responsable(){
        return $this->BelongsTo(Responsable::class,"RESPONSABLE_DOSSIER","id");
    }
    public function fournisseur(){
        return $this->belongsTo(Fournisseur::class,'FOURNISSEUR');
    }

    public function retours(){
        return $this->hasMany(Retour::class,"NUM_COMMANDE");
    }
}
