<?php

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
        Schema::create('commandes', function (Blueprint $table) {
            $table->string('NUM_COMMANDE', 50);
            $table->string('AVIS_ACHAT', 50);
            $table->enum('TYPE_ACHAT', ['Marche', 'Marche Cadre', 'Marche Recondictible', 'Contrat/Convention']);
            $table->enum('TYPE_BUDGET', ['Fonctionnement', 'Investissement', 'Compte hors budget']);
            $table->text('OBJET_ACHAT');
            $table->string('REFERENCE_RUBRIQUE', 50);
            $table->unsignedBigInteger('FOURNISSEUR');  // Fixed typo here
            $table->integer('DELAI_LIVRAISON');
            $table->enum('GARANTIE', ["oui", "non"]);
            $table->float('RETENUE_GARANTIE');
            $table->string('NUM_MARCHE', 50)->nullable();
            $table->integer('EXERCICE');
            $table->date('DATE_COMMANDE');
            $table->unsignedBigInteger('RESPONSABLE_DOSSIER');
            $table->enum('STATUT_COMMANDE', ['attribuee', 'annulee'])->default('attribuee');

            $table->date('DATE_LIVRAISON');
            $table->enum('STATUT_LIVRAISON', ["livree", "non livree"])->default('non livree');
            $table->text('LIEU_LIVRAISON');

            $table->date('DATE_VERIFICATION_RECEPTION');
            $table->enum('STATUT_RECEPTION', ["receptionnee", "non receptionnee"])->default('non receptionnee');
            $table->date('DATE_DEPOT_SL');
            $table->string('NUM_FACTURE', 50);
            $table->date('DATE_FACTURE');
            $table->float('HT');
            $table->float('TTC');
            $table->float('TAUX_TVA');
            $table->float('MONTANT_TVA');

            $table->date('DATE_DEPOT_SC');
            $table->string('oz');
            $table->enum('STATUT_PAIEMENT', ['payee', 'non payee', 'deposee'])->default('non payee');
            $table->date('DATE_PAIEMENT');
            $table->float('MONTANT_PAYE')->nullable();

            $table->primary('NUM_COMMANDE');
            $table->foreign('REFERENCE_RUBRIQUE')->references('REFERENCE_RUBRIQUE')->on('rubriques');
            $table->foreign('FOURNISSEUR')->references('id')->on('fournisseurs')->onDelete('cascade');  // Corrected foreign key definition
            $table->foreign('RESPONSABLE_DOSSIER')->references('id')->on('responsables')->onDelete('cascade');  // Corrected foreign key definition

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
