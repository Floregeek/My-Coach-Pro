<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('factures', function (Blueprint $table) {
            $table->id();
            $table->string('numero')->unique();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->foreignId('coach_id')->nullable()->constrained('users')->nullOnDelete();
            $table->string('type'); // commande | contrat | programme | plan_nutrition
            $table->unsignedBigInteger('reference_id')->nullable();
            $table->decimal('total_ht', 10, 2)->default(0);
            $table->decimal('tva', 5, 2)->default(0);
            $table->decimal('total_ttc', 10, 2)->default(0);
            $table->string('statut')->default('paye'); // paye | impaye | annule
            $table->timestamp('issued_at')->nullable();
            $table->timestamp('due_at')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('factures');
    }
};
