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
        Schema::create('exercise_seance', function (Blueprint $table) {
        $table->id();
        $table->foreignId('seance_id')->constrained()->onDelete('cascade');
        $table->foreignId('exercise_id')->constrained()->onDelete('cascade');
        $table->integer('ordre')->nullable(); // Pour trier les exercices
        $table->string('reps_series')->nullable(); // Ex: "3x12 répétitions"
        $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('exercise_seance');
    }
};
