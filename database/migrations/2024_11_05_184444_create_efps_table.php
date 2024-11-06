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
        Schema::create('efps', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_complexe');
            $table->string('nom_efp',50);
            $table->timestamps();
            $table->foreign('id_complexe')->references('id')->on('complexes')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('efps');
    }
};
