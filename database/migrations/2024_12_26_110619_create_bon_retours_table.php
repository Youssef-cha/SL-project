<?php

use App\Models\BonCommande;
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
        Schema::create('bon_retours', function (Blueprint $table) {
            $table->id();
            $table->date("date_retour");
            $table->text("motif");
            $table->enum('STATUT_RETOUR', ['a resoudre', 'resolue'])->default('a resoudre');
            $table->timestamps();
            $table->foreignIdFor(BonCommande::class)->constrained();
            $table->foreignIdFor(User::class)->constrained();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bon_retours');
    }
};
