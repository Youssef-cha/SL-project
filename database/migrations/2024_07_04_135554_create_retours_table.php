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
        Schema::create('retours', function (Blueprint $table) {
            $table->id();
            $table->string("RESPONSABLE", 100);
            $table->text("MOTIF");
            $table->date("DEBUT");
            $table->date("FIN");
            $table->string('NUM_COMMANDE', length: 50);

            $table->foreign("NUM_COMMANDE")->references("NUM_COMMANDE")->on("commandes");
        });
    }
};
