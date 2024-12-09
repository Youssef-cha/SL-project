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
        Schema::create('rubriques', function (Blueprint $table) {
            $table->id();
            $table->string('REFERENCE_RUBRIQUE', length: 50);
            $table->integer('ANNEE_BUDGETAIRE');
            $table->float('BUDGET');
            $table->timestamps();
        });
    }
};
