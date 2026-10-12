<?php

namespace Database\Seeders;

use App\Models\Seance;
use App\Models\User;
use Illuminate\Database\Seeder;

class SeanceSeeder extends Seeder
{
    public function run(): void
    {
        $coach = User::where('email', 'coach@archiweb.fr')->first();

        if (!$coach) {
            return;
        }

        $seances = [
            [
                'titre' => 'Bilan sportif initial',
                'type' => 'individuelle',
                'debut_a' => now()->startOfWeek()->addDay()->setTime(9, 0),
                'fin_a' => now()->startOfWeek()->addDay()->setTime(10, 0),
                'max_participants' => 1,
                'statut' => 'programme',
            ],
            [
                'titre' => 'Circuit training debutants',
                'type' => 'collective',
                'debut_a' => now()->startOfWeek()->addDays(2)->setTime(18, 0),
                'fin_a' => now()->startOfWeek()->addDays(2)->setTime(19, 0),
                'max_participants' => 8,
                'statut' => 'programme',
            ],
            [
                'titre' => 'Renforcement bas du corps',
                'type' => 'individuelle',
                'debut_a' => now()->startOfWeek()->addDays(4)->setTime(14, 0),
                'fin_a' => now()->startOfWeek()->addDays(4)->setTime(15, 0),
                'max_participants' => 1,
                'statut' => 'programme',
            ],
        ];

        foreach ($seances as $seance) {
            Seance::updateOrCreate(
                [
                    'coach_id' => $coach->id,
                    'titre' => $seance['titre'],
                    'debut_a' => $seance['debut_a'],
                ],
                [
                    'type' => $seance['type'],
                    'fin_a' => $seance['fin_a'],
                    'max_participants' => $seance['max_participants'],
                    'statut' => $seance['statut'],
                ]
            );
        }
    }
}
