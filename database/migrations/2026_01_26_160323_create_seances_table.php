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
        Schema::create('seances', function (Blueprint $table) {
    $table->id();
            $table->foreignId('coach_id')->constrained('users');
    $table->string('titre');
    
    $table->dateTime('debut_a');
    $table->dateTime('fin_a');
    $table->integer('max_participants')->default(1);
    $table->string('statut')->default('programme'); // programme, annule, termine
    $table->timestamps();
});
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('seances');
    }
};
