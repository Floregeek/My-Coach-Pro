<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('offres', function (Blueprint $table) {
            $table->id();
            $table->foreignId('coach_id')->constrained('users');
            $table->string('titre');
            $table->string('type'); // pack | abonnement
            $table->text('description')->nullable();
            $table->decimal('prix_ht', 10, 2)->default(0);
            $table->decimal('tva', 5, 2)->default(20);
            $table->decimal('prix_ttc', 10, 2)->default(0);
            $table->integer('total_seances')->default(0);
            $table->integer('duree_mois')->nullable();
            $table->boolean('active')->default(true);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('offres');
    }
};
