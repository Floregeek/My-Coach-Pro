<?php

namespace Database\Seeders;

use App\Models\Partenariat;
use App\Models\User;
use Illuminate\Database\Seeder;

class PartenariatSeeder extends Seeder
{
    public function run(): void
    {
        $coachs = User::where('role', 'coach')->orderBy('id')->take(2)->get();

        if ($coachs->count() < 2) {
            return;
        }

        Partenariat::updateOrCreate(
            [
                'coach_id' => $coachs[0]->id,
                'partner_coach_id' => $coachs[1]->id,
            ],
            [
                'type' => 'co-traitance',
                'commission_rate' => 20,
                'statut' => 'actif',
            ]
        );
    }
}
