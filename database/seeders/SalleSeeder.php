<?php

namespace Database\Seeders;

use App\Models\Salle;
use App\Models\User;
use Illuminate\Database\Seeder;

class SalleSeeder extends Seeder
{
    public function run(): void
    {
        $salle = Salle::updateOrCreate(
            ['nom' => 'Salle ArchiWeb'],
            ['adresse' => '1 rue du Sport, 67000 Strasbourg']
        );

        $responsable = User::where('role', 'responsable')->first();

        if ($responsable) {
            $responsable->update(['salle_id' => $salle->id]);
        }

        $coachs = User::where('role', 'coach')->get();
        if ($coachs->isNotEmpty()) {
            $salle->coachs()->sync($coachs->pluck('id')->toArray());
        }
    }
}
