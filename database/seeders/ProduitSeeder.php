<?php

namespace Database\Seeders;

use App\Models\Produit;
use Illuminate\Database\Seeder;

class ProduitSeeder extends Seeder
{
    public function run(): void
    {
        $produits = [
            [
                'nom' => 'Banc de Musculation Ajustable',
                'description' => 'Banc robuste avec 7 positions d\'inclinaison pour un entrainement complet.',
                'prix' => 129.00,
                'stock' => 5,
                'categorie' => 'Materiel',
                'image' => 'images/noodles.jpg',
            ],
            [
                'nom' => 'Corde a Sauter Vitesse',
                'description' => 'Ideale pour le cardio et la coordination. Poignees ergonomiques.',
                'prix' => 12.50,
                'stock' => 25,
                'categorie' => 'Materiel',
                'image' => 'images/corde.jpg',
            ],
            [
                'nom' => 'Kettlebell Fonte 16kg',
                'description' => 'Parfait pour le renforcement musculaire et le cross-training.',
                'prix' => 45.00,
                'stock' => 8,
                'categorie' => 'Materiel',
                'image' => 'images/kettlebel.jpg',
            ],
            [
                'nom' => 'Whey Protein Isolate - Vanille',
                'description' => '2kg de proteines de haute qualite pour la construction musculaire.',
                'prix' => 54.90,
                'stock' => 12,
                'categorie' => 'Nutrition',
                'image' => 'images/PureWh.jpg',
            ],
            [
                'nom' => 'Bandes Elastiques de Resistance',
                'description' => 'Set de 5 bandes avec differents niveaux de tension.',
                'prix' => 19.90,
                'stock' => 30,
                'categorie' => 'Materiel',
                'image' => 'images/Netrition_Resistance_Band.png',
            ],
            [
                'nom' => 'Montre Cardio GPS',
                'description' => 'Suivez vos performances, votre rythme cardiaque et votre sommeil.',
                'prix' => 89.00,
                'stock' => 10,
                'categorie' => 'Materiel',
                'image' => 'images/montre.jpg',
            ],
        ];

        foreach ($produits as $produit) {
            Produit::updateOrCreate(
                ['nom' => $produit['nom']],
                $produit
            );
        }
    }
}
