<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('plans_nutrition', function (Blueprint $table) {
            $table->id();
            $table->foreignId('coach_id')->constrained('users');
            $table->string('titre');
            $table->text('description')->nullable();
            $table->integer('calories')->nullable();
            $table->integer('proteines')->nullable();
            $table->integer('glucides')->nullable();
            $table->integer('lipides')->nullable();
            $table->decimal('prix_ht', 10, 2)->default(0);
            $table->decimal('tva', 5, 2)->default(20);
            $table->decimal('prix_ttc', 10, 2)->default(0);
            $table->boolean('actif')->default(true);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('plans_nutrition');
    }
};
