<?php

namespace Database\Seeders;

use App\Models\Programme;
use App\Models\User;
use Illuminate\Database\Seeder;

class ProgrammeSeeder extends Seeder
{
    public function run(): void
    {
        $coach = User::where('role', 'coach')->first();

        if (!$coach) {
            return;
        }

        $items = [
            [
                'coach_id' => $coach->id,
                'titre' => 'Programme Force 4 semaines',
                'description' => 'Progression force avec 2 seances par semaine.',
                'prix_ht' => 80,
                'tva' => 20,
                'prix_ttc' => 96,
                'duree_semaines' => 4,
                'seances_par_semaine' => 2,
                'actif' => true,
            ],
            [
                'coach_id' => $coach->id,
                'titre' => 'Programme Cardio 6 semaines',
                'description' => 'Conditionnement cardio avec 3 seances par semaine.',
                'prix_ht' => 120,
                'tva' => 20,
                'prix_ttc' => 144,
                'duree_semaines' => 6,
                'seances_par_semaine' => 3,
                'actif' => true,
            ],
        ];

        foreach ($items as $item) {
            Programme::updateOrCreate(
                ['coach_id' => $item['coach_id'], 'titre' => $item['titre']],
                $item
            );
        }
    }
}
