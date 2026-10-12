<?php

namespace Database\Seeders;

use App\Models\CoachSalleContrat;
use App\Models\Salle;
use App\Models\User;
use Illuminate\Database\Seeder;

class CoachSalleContratSeeder extends Seeder
{
    public function run(): void
    {
        $salle = Salle::first();
        $coach = User::where('role', 'coach')->first();

        if (!$salle || !$coach) {
            return;
        }

        CoachSalleContrat::updateOrCreate(
            [
                'coach_id' => $coach->id,
                'salle_id' => $salle->id,
            ],
            [
                'type' => 'commission',
                'commission_rate' => 15,
                'statut' => 'actif',
            ]
        );
    }
}
