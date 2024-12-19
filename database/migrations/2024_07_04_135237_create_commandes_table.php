<?php

use App\Models\AppelOffre;
use App\Models\Efp;
use App\Models\Fournisseur;
use App\Models\Rubrique;
use App\Models\User;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // commande
        Schema::create('bon_commandes', function (Blueprint $table) {
            $table->string('numero_bon_commandes', 50)->primary();
            $table->string('AVIS_ACHAT', 50);
            $table->enum('TYPE_BUDGET', ['Fonctionnement', 'Investissement', 'Compte hors budget']);
            $table->text('OBJET_ACHAT');
            $table->integer('DELAI_LIVRAISON');
            $table->enum('GARANTIE', ["oui", "non"])->default('non');
            $table->float('RETENUE_GARANTIE')->nullable();
            $table->integer('EXERCICE');
            $table->date('DATE_COMMANDE');

            // livraison
            $table->date('DATE_LIVRAISON')->nullable();
            $table->enum('STATUT_LIVRAISON', ["livree", "non livree"])->default('non livree');
            $table->text('LIEU_LIVRAISON')->nullable();

            // reception
            $table->enum('STATUT_RECEPTION', ["receptionnee", "non receptionnee"])->default('non receptionnee');
            $table->date('DATE_VERIFICATION_RECEPTION')->nullable();
            $table->date('DATE_DEPOT_SL')->nullable();

            // depot
            $table->date('DATE_DEPOT_SC')->nullable();

            // facture
            $table->string('NUM_FACTURE', 50)->nullable();
            $table->date('DATE_FACTURE')->nullable();
            $table->float('HT')->nullable();
            $table->float('TTC')->nullable();
            $table->float('TAUX_TVA')->nullable();
            $table->float('MONTANT_TVA')->nullable();

            // paiement
            $table->string('oz')->nullable();
            $table->string('op')->nullable();
            $table->enum('STATUT_PAIEMENT', ['payee', 'non payee', 'deposee'])->default('non payee');
            $table->date('DATE_PAIEMENT')->nullable();
            $table->float('MONTANT_PAYE')->nullable();

            $table->foreignIdFor(Efp::class)->constrained();
            $table->foreignIdFor(Rubrique::class)->constrained();
            $table->foreignIdFor(Fournisseur::class)->constrained();
            $table->foreignIdFor(User::class)->constrained();
            $table->timestamps();
        });

        Schema::create('commandes', function (Blueprint $table) {
            $table->string('NUM_COMMANDE', 50)->primary();
            $table->string('numero_appel_offre', 50);
            $table->enum('TYPE_ACHAT', ['Marche', 'Marche Cadre', 'Marche Recondictible', 'Contrat/Convention']);
            $table->enum('TYPE_BUDGET', ['Fonctionnement', 'Investissement', 'Compte hors budget']);
            $table->text('OBJET_ACHAT');
            $table->integer('DELAI_LIVRAISON');
            $table->enum('GARANTIE', ["oui", "non"])->default('non');
            $table->float('RETENUE_GARANTIE')->nullable();
            $table->integer('EXERCICE');
            $table->date('DATE_COMMANDE');
            $table->enum('STATUT_COMMANDE', ['attribuee', 'annulee'])->default('attribuee');

            // livraison
            $table->date('DATE_LIVRAISON')->nullable();
            $table->enum('STATUT_LIVRAISON', ["livree", "non livree"])->default('non livree');
            $table->text('LIEU_LIVRAISON')->nullable();

            // reception
            $table->enum('STATUT_RECEPTION', ["receptionnee", "non receptionnee"])->default('non receptionnee');
            $table->date('DATE_VERIFICATION_RECEPTION')->nullable();
            $table->date('DATE_DEPOT_SL')->nullable();

            // DEPOT
            $table->date('DATE_DEPOT_SC')->nullable();

            // facture
            $table->string('NUM_FACTURE', 50)->nullable();
            $table->date('DATE_FACTURE')->nullable();
            $table->float('HT')->nullable();
            $table->float('TTC')->nullable();
            $table->float('TAUX_TVA')->nullable();
            $table->float('MONTANT_TVA')->nullable();

            // paiement
            $table->string('oz')->nullable();
            $table->string('op')->nullable();
            $table->enum('STATUT_PAIEMENT', ['payee', 'non payee', 'deposee'])->default('non payee');
            $table->date('DATE_PAIEMENT')->nullable();
            $table->float('MONTANT_PAYE')->nullable();

            $table->foreign('numero_appel_offre')->references('numero_appel_offre')->on('appel_offres');
            $table->foreignIdFor(Efp::class)->constrained();
            $table->foreignIdFor(Rubrique::class)->constrained();
            $table->foreignIdFor(Fournisseur::class)->constrained();
            $table->foreignIdFor(User::class)->constrained();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('commandes');
    }
};
