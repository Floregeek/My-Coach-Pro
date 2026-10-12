<?php

namespace App\Http\Controllers;

use App\Models\CoachSalleContrat;
use App\Models\Salle;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CoachSalleContratController extends Controller
{
    public function index()
    {
        $contrats = CoachSalleContrat::with(['coach', 'salle'])
            ->orderByDesc('created_at')
            ->get();

        $salles = Salle::orderBy('nom')->get();
        $coachs = User::where('role', 'coach')->orderBy('name')->get();

        return view('responsable.contrats', compact('contrats', 'salles', 'coachs'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'coach_id' => ['required', 'integer', 'exists:users,id'],
            'salle_id' => ['required', 'integer', 'exists:salles,id'],
            'commission_rate' => ['required', 'numeric', 'min:0', 'max:100'],
            'type' => ['required', 'string', 'max:50'],
        ]);

        CoachSalleContrat::create([
            'coach_id' => $validated['coach_id'],
            'salle_id' => $validated['salle_id'],
            'type' => $validated['type'],
            'commission_rate' => $validated['commission_rate'],
            'statut' => 'actif',
        ]);

        return back()->with('success', 'Contrat salle-coach cree.');
    }
}
