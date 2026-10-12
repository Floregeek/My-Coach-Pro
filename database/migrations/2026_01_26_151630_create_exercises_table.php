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
        Schema::create('exercises', function (Blueprint $table) {
            $table->id();
            $table->string('Nom');
            $table->text('Description'); // Résumé rapide
            $table->text('Consignes');   
            $table->string('Niveau');      // Débutant, Intermédiaire, Avancé (nouveau)
            $table->string('Categorie');   // Musculation, Cardio, etc.
            $table->string('Equipement')->nullable();
            $table->string('Media_url')->nullable(); 
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade'); // Le coach créateur
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('exercises');
    }
};
