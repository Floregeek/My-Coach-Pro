<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('contrats', function (Blueprint $table) {
            $table->foreignId('offre_id')->nullable()->constrained('offres')->nullOnDelete();
            $table->decimal('prix_ht', 10, 2)->default(0);
            $table->decimal('tva', 5, 2)->default(20);
            $table->decimal('prix_ttc', 10, 2)->default(0);
        });
    }

    public function down(): void
    {
        Schema::table('contrats', function (Blueprint $table) {
            $table->dropConstrainedForeignId('offre_id');
            $table->dropColumn(['prix_ht', 'tva', 'prix_ttc']);
        });
    }
};
