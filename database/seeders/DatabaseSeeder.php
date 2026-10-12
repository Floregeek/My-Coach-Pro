<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    public function run(): void
    {
        $this->call([
            UtilisateurSeeder::class,
            SalleSeeder::class,
            ClientSeeder::class,
            SeanceSeeder::class,
            ProduitSeeder::class,
            OffreSeeder::class,
            ContratSeeder::class,
            ProgrammeSeeder::class,
            PlanNutritionSeeder::class,
            PartenariatSeeder::class,
            CoachSalleContratSeeder::class,
        ]);
    }
}
