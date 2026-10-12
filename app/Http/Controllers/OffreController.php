<?php

namespace App\Http\Controllers;

use App\Models\Offre;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OffreController extends Controller
{
    public function index()
    {
        $offres = Offre::where('coach_id', Auth::id())
            ->orderByDesc('created_at')
            ->get();

        return view('coach.offres.index', compact('offres'));
    }

    public function create()
    {
        return view('coach.offres.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'titre' => ['required', 'string', 'max:120'],
            'type' => ['required', 'in:pack,abonnement'],
            'description' => ['nullable', 'string', 'max:1000'],
            'prix_ht' => ['required', 'numeric', 'min:0'],
            'tva' => ['required', 'numeric', 'min:0'],
            'total_seances' => ['nullable', 'integer', 'min:0'],
            'duree_mois' => ['nullable', 'integer', 'min:1'],
        ]);

        $prixTtc = $validated['prix_ht'] * (1 + ($validated['tva'] / 100));

        Offre::create([
            'coach_id' => Auth::id(),
            'titre' => $validated['titre'],
            'type' => $validated['type'],
            'description' => $validated['description'] ?? null,
            'prix_ht' => $validated['prix_ht'],
            'tva' => $validated['tva'],
            'prix_ttc' => $prixTtc,
            'total_seances' => $validated['total_seances'] ?? 0,
            'duree_mois' => $validated['duree_mois'] ?? null,
            'active' => true,
        ]);

        return redirect()->route('coach.offres.index')->with('success', 'Offre creee avec succes.');
    }
}
