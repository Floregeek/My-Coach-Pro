<?php

namespace App\Http\Controllers;

use App\Models\Seance;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AgendaController extends Controller
{
    public function index()
    {
        $seances = Seance::withCount('reservations')
            ->where('coach_id', Auth::id())
            ->orderBy('debut_a')
            ->get()
            ->map(function ($seance) {
                $placesOccupees = $seance->reservations_count;
                $capaciteMax = $seance->max_participants;
                $color = $seance->type === 'collective' ? '#10b981' : '#4f46e5';

                if (in_array($seance->statut, ['annule', 'indisponibilite'], true)) {
                    $color = '#ef4444';
                }

                $labelType = $seance->type === 'collective' ? '[Collectif] ' : '[Individuel] ';

                return [
                    'id' => $seance->id,
                    'title' => $labelType . $seance->titre . " ({$placesOccupees}/{$capaciteMax})",
                    'start' => $seance->debut_a,
                    'end' => $seance->fin_a,
                    'backgroundColor' => $color,
                    'borderColor' => $color,
                    'extendedProps' => [
                        'type' => $seance->type,
                        'isFull' => $placesOccupees >= $capaciteMax,
                    ],
                ];
            });

        return view('agenda.index', ['seances' => $seances]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'titre' => 'required|string|max:255',
            'debut_a' => 'required|date',
            'fin_a' => 'required|date|after:debut_a',
            'max_participants' => 'required|integer|min:1',
        ]);

        $typeAutomatique = $request->max_participants > 1 ? 'collective' : 'individuelle';

        Seance::create([
            'coach_id' => Auth::id(),
            'titre' => $request->titre,
            'type' => $typeAutomatique,
            'debut_a' => $request->debut_a,
            'fin_a' => $request->fin_a,
            'max_participants' => $request->max_participants,
            'statut' => 'programme',
        ]);

        return redirect()->back()->with('success', 'Seance ajoutee avec succes.');
    }
}
