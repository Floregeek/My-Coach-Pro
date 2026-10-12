<?php

namespace Database\Seeders;

use App\Models\Offre;
use App\Models\User;
use Illuminate\Database\Seeder;

class OffreSeeder extends Seeder
{
    public function run(): void
    {
        $coach = User::where('role', 'coach')->first();

        if (!$coach) {
            return;
        }

        $offres = [
            [
                'coach_id' => $coach->id,
                'titre' => 'Pack 10 seances',
                'type' => 'pack',
                'description' => '10 seances individuelles valables 6 mois.',
                'prix_ht' => 300,
                'tva' => 20,
                'prix_ttc' => 360,
                'total_seances' => 10,
                'duree_mois' => null,
                'active' => true,
            ],
            [
                'coach_id' => $coach->id,
                'titre' => 'Abonnement 3 mois',
                'type' => 'abonnement',
                'description' => 'Suivi complet avec 1 seance par semaine.',
                'prix_ht' => 240,
                'tva' => 20,
                'prix_ttc' => 288,
                'total_seances' => 12,
                'duree_mois' => 3,
                'active' => true,
            ],
        ];

        foreach ($offres as $offre) {
            Offre::updateOrCreate(
                ['coach_id' => $offre['coach_id'], 'titre' => $offre['titre']],
                $offre
            );
        }
    }
}
