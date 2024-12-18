<?php

use App\Models\Complexe;
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
        Schema::create('appel_offres', function (Blueprint $table) {
            $table->string('numero_appel_offre',50)->primary();
            $table->string('numero_marche');
            $table->timestamps();
        });
        Schema::create('fournisseurs', function (Blueprint $table) {
            $table->id();
            $table->string('nom_fournisseur');
            $table->timestamps();
        });
        Schema::create('rubriques', function (Blueprint $table) {
            $table->id();
            $table->string('REFERENCE_RUBRIQUE', length: 50);
            $table->integer('ANNEE_BUDGETAIRE');
            $table->float('BUDGET');
            $table->timestamps();
        });
        Schema::create('complexes', function (Blueprint $table) {
            $table->id();
            $table->string('nom_complexe', 50);
            $table->timestamps();
        });
        Schema::create('efps', function (Blueprint $table) {
            $table->id();
            $table->string('nom_efp', 50);
            $table->timestamps();
            $table->foreignIdFor(Complexe::class)->constrained()->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('fournisseurs');
        Schema::dropIfExists('rubriques');
        Schema::dropIfExists('complexes');
        Schema::dropIfExists('efps');
    }
};
