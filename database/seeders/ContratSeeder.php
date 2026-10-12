<?php

namespace Database\Seeders;

use App\Models\Contrat;
use App\Models\Offre;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class ContratSeeder extends Seeder
{
    public function run(): void
    {
        $coach = User::where('role', 'coach')->first();
        $client = User::where('role', 'client')->first();

        if (!$coach || !$client) {
            return;
        }

        $offre = Offre::where('coach_id', $coach->id)->first();

        if (!$offre) {
            return;
        }

        $expiration = $offre->type === 'abonnement' && $offre->duree_mois
            ? Carbon::now()->addMonths($offre->duree_mois)
            : null;

        Contrat::updateOrCreate(
            [
                'client_id' => $client->id,
                'coach_id' => $coach->id,
                'offre_id' => $offre->id,
            ],
            [
                'type' => $offre->type,
                'total_seances' => $offre->total_seances,
                'seances_restantes' => max(0, $offre->total_seances - 2),
                'date_expiration' => $expiration,
                'prix_ht' => $offre->prix_ht,
                'tva' => $offre->tva,
                'prix_ttc' => $offre->prix_ttc,
            ]
        );
    }
}
