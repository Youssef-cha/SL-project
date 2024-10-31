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
        Schema::table('commandes', function (Blueprint $table) {
            $table->date('DATE_LIVRAISON')->nullable()->change();
            $table->float('RETENUE_GARANTIE')->nullable()->change();
            $table->text('LIEU_LIVRAISON')->nullable()->change();
            $table->date('DATE_VERIFICATION_RECEPTION')->nullable()->change();
            $table->date('DATE_DEPOT_SL')->nullable()->change();
            $table->string('NUM_FACTURE', length: 50)->nullable()->change();
            $table->date('DATE_FACTURE')->nullable()->change();
            $table->float('HT')->nullable()->change();
            $table->float('TTC')->nullable()->change();
            $table->float('TAUX_TVA')->nullable()->change();
            $table->float('MONTANT_TVA')->nullable()->change();
            $table->date('DATE_DEPOT_SC')->nullable()->change();
            $table->date('DATE_PAIEMENT')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('commandes', function (Blueprint $table) {
            //
        });
    }
};
