<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UtilisateurSeeder extends Seeder
{
    public function run(): void
    {
        $users = [
            [
                'name' => 'Liza Coach',
                'email' => 'coach@archiweb.fr',
                'password' => 'password123',
                'role' => 'coach',
            ],
            [
                'name' => 'Jean Durand',
                'email' => 'client@jean.fr',
                'password' => 'password',
                'role' => 'client',
            ],
            [
                'name' => 'Coach Test',
                'email' => 'c@test.com',
                'password' => 'pass_flo',
                'role' => 'coach',
            ],
            [
                'name' => 'Responsable Salle',
                'email' => 'responsable@archiweb.fr',
                'password' => 'password123',
                'role' => 'responsable',
            ],
        ];

        foreach ($users as $userData) {
            User::updateOrCreate(
                ['email' => $userData['email']],
                [
                    'name' => $userData['name'],
                    'password' => Hash::make($userData['password']),
                    'role' => $userData['role'],
                ]
            );
        }
    }
}
