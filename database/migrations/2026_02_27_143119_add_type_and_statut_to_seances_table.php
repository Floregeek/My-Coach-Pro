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
    Schema::table('seances', function (Blueprint $table) {
        // On ajoute le type et on précise le statut par défaut
        $table->enum('type', ['individuelle', 'collective', 'indisponibilite'])->default('individuelle')->after('titre');
        // Si tu n'as pas encore de colonne statut pour les annulations/congés
        if (!Schema::hasColumn('seances', 'statut')) {
            $table->string('statut')->default('programme')->after('max_participants');
        }
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('seances', function (Blueprint $table) {
            //
        });
    }
};
