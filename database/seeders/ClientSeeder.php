<?php

namespace Database\Seeders;

use App\Models\Client;
use App\Models\User;
use Illuminate\Database\Seeder;

class ClientSeeder extends Seeder
{
    public function run(): void
    {
        $user = User::where('email', 'client@jean.fr')->first();

        if (!$user) {
            return;
        }

        Client::updateOrCreate(
            ['Email' => 'client@jean.fr'],
            [
                'Prenom' => 'Jean',
                'Nom' => 'Durand',
                'Date_nais' => '1990-05-15',
                'Adresse' => '123 Rue du Sport, Paris',
                'Telephone' => '0601020304',
                'Objectifs' => 'Perte de poids et tonification',
                'Pathologies' => 'Douleur genou gauche',
                'Niveau' => 'Debutant',
                'consentement_rgpd' => true,
                'user_id' => $user->id,
            ]
        );
    }
}
