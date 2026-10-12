<?php

namespace Database\Seeders;

use App\Models\PlanNutrition;
use App\Models\PlanNutritionAchat;
use App\Models\User;
use Illuminate\Database\Seeder;
use Carbon\Carbon;

class PlanNutritionSeeder extends Seeder
{
    public function run(): void
    {
        $coach = User::where('role', 'coach')->first();
        $client = User::where('role', 'client')->first();

        if (!$coach) {
            return;
        }

        $items = [
            [
                'coach_id' => $coach->id,
                'titre' => 'Plan Equilibre',
                'description' => 'Plan de base pour maintien.',
                'calories' => 2200,
                'proteines' => 140,
                'glucides' => 220,
                'lipides' => 70,
                'prix_ht' => 40,
                'tva' => 20,
                'prix_ttc' => 48,
                'actif' => true,
            ],
            [
                'coach_id' => $coach->id,
                'titre' => 'Plan Perte de poids',
                'description' => 'Plan hypocalorique.',
                'calories' => 1800,
                'proteines' => 150,
                'glucides' => 150,
                'lipides' => 50,
                'prix_ht' => 50,
                'tva' => 20,
                'prix_ttc' => 60,
                'actif' => true,
            ],
        ];

        foreach ($items as $item) {
            PlanNutrition::updateOrCreate(
                ['coach_id' => $item['coach_id'], 'titre' => $item['titre']],
                $item
            );
        }

        if ($client) {
            $plan = PlanNutrition::where('coach_id', $coach->id)->first();
            if ($plan) {
                PlanNutritionAchat::updateOrCreate(
                    [
                        'plan_nutrition_id' => $plan->id,
                        'client_id' => $client->id,
                    ],
                    [
                        'coach_id' => $coach->id,
                        'prix_ttc' => $plan->prix_ttc,
                        'payment_provider' => 'stripe',
                        'stripe_checkout_session_id' => 'seeded-session',
                        'paid_at' => Carbon::now(),
                    ]
                );
            }
        }
    }
}
