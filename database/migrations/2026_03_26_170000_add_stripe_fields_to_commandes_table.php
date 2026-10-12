<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('commandes', function (Blueprint $table) {
            $table->string('payment_provider')->nullable()->after('statut');
            $table->string('stripe_checkout_session_id')->nullable()->after('payment_provider');
        });
    }

    public function down(): void
    {
        Schema::table('commandes', function (Blueprint $table) {
            $table->dropColumn(['payment_provider', 'stripe_checkout_session_id']);
        });
    }
};
