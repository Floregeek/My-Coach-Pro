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
       Schema::create('clients', function (Blueprint $table) {
        $table->id();
        $table->string('Prenom');
        $table->string('Nom');
        $table->string('Email')->unique();
        $table->date('Date_nais')->nullable();
        $table->string('Adresse')->nullable();
        $table->string('Telephone')->nullable();
        $table->text('Objectifs'); 
        $table->text('Pathologies')->nullable(); // Blessures, restrictions
        $table->string('Niveau')->default('Débutant'); // Pour filtrer les exercices
        $table->boolean('consentement_rgpd')->default(false);
        $table->foreignId('user_id')->constrained()->onDelete('cascade'); // Le Coach
        $table->timestamps();
    });
    
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('clients');
    }
};
