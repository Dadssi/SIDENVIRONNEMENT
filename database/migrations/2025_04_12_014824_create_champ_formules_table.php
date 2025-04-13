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
        Schema::create('champ_formules', function (Blueprint $table) {
            $table->id();
            $table->foreignId('formule_id')->constrained()->onDelete('cascade');
            $table->string('nom_champ');  // ex: "longueur"
            $table->string('libelle'); // ex: "Longueur (en m)"
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('champ_formules');
    }
};
