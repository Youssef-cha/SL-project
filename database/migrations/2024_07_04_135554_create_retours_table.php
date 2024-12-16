<?php

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
        Schema::create('retours', function (Blueprint $table) {
            $table->id();
            $table->date("date_retour");
            $table->text("motif");
            $table->string('NUM_COMMANDE', length: 50);
            $table->timestamps();

            $table->foreign("NUM_COMMANDE")->references("NUM_COMMANDE")->on("commandes");
            $table->foreignIdFor(User::class)->constrained();
        });
    }
};
