<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('plan_nutrition_achats', function (Blueprint $table) {
            $table->id();
            $table->foreignId('plan_nutrition_id')->constrained('plans_nutrition')->onDelete('cascade');
            $table->foreignId('client_id')->constrained('users')->onDelete('cascade');
            $table->foreignId('coach_id')->constrained('users')->onDelete('cascade');
            $table->decimal('prix_ttc', 10, 2)->default(0);
            $table->string('payment_provider')->nullable();
            $table->string('stripe_checkout_session_id')->nullable()->index();
            $table->timestamp('paid_at')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('plan_nutrition_achats');
    }
};
