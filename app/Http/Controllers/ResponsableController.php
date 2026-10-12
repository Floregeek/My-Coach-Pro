<?php

namespace App\Http\Controllers;

use App\Models\Commande;
use App\Models\Contrat;
use App\Models\Facture;
use App\Models\Reservation;
use App\Models\Salle;
use App\Models\Seance;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ResponsableController extends Controller
{
    public function dashboard()
    {
        $salle = $this->getSalle();
        $coachsCount = $salle ? $salle->coachs()->count() : 0;
        $seancesCount = $salle ? Seance::where('salle_id', $salle->id)->count() : 0;
        $reservationsCount = $salle ? Reservation::whereHas('seance', function ($q) use ($salle) {
            $q->where('salle_id', $salle->id);
        })->count() : 0;

        $recentSeances = $salle
            ? Seance::with('coach')
                ->where('salle_id', $salle->id)
                ->orderByDesc('debut_a')
                ->limit(5)
                ->get()
            : collect();

        $topCoachs = $salle
            ? Seance::selectRaw('coach_id, COUNT(*) as total')
                ->where('salle_id', $salle->id)
                ->groupBy('coach_id')
                ->orderByDesc('total')
                ->limit(5)
                ->get()
                ->map(function ($row) {
                    $row->coach = User::find($row->coach_id);
                    return $row;
                })
            : collect();

        return view('responsable.dashboard', compact(
            'salle',
            'coachsCount',
            'seancesCount',
            'reservationsCount',
            'recentSeances',
            'topCoachs'
        ));
    }

    public function coachs()
    {
        $salle = $this->getSalle();
        $coachs = User::where('role', 'coach')->orderBy('name')->get();
        $affilies = $salle ? $salle->coachs()->pluck('users.id')->toArray() : [];
        $stats = $salle
            ? Seance::selectRaw('coach_id, COUNT(*) as total')
                ->where('salle_id', $salle->id)
                ->groupBy('coach_id')
                ->get()
                ->keyBy('coach_id')
            : collect();

        return view('responsable.coachs', compact('salle', 'coachs', 'affilies', 'stats'));
    }

    public function updateCoachs(Request $request)
    {
        $salle = $this->getSalle();

        if (!$salle) {
            return back()->with('error', 'Salle non definie.');
        }

        $coachIds = $request->input('coachs', []);
        $salle->coachs()->sync($coachIds);

        return back()->with('success', 'Coachs affilies mis a jour.');
    }

    public function planning()
    {
        $salle = $this->getSalle();
        $seances = $salle ? Seance::where('salle_id', $salle->id)->orderByDesc('debut_a')->get() : collect();
        $coachs = $salle ? $salle->coachs()->orderBy('name')->get() : collect();
        $seancesDisponibles = Seance::whereNull('salle_id')->orderByDesc('debut_a')->get();

        return view('responsable.planning', compact('salle', 'seances', 'coachs', 'seancesDisponibles'));
    }

    public function affecterSeance(Request $request)
    {
        $validated = $request->validate([
            'seance_id' => ['required', 'integer'],
            'coach_id' => ['required', 'integer'],
        ]);

        $salle = $this->getSalle();

        if (!$salle) {
            return back()->with('error', 'Salle non definie.');
        }

        $seance = Seance::findOrFail($validated['seance_id']);
        $seance->update([
            'coach_id' => $validated['coach_id'],
            'salle_id' => $salle->id,
        ]);

        return back()->with('success', 'Seance affectee a la salle.');
    }

    public function occupation()
    {
        $salle = $this->getSalle();
        $seances = $salle ? Seance::withCount('reservations')->where('salle_id', $salle->id)->get() : collect();
        $totalSeances = $seances->count();
        $totalReservations = $salle ? Reservation::whereHas('seance', function ($q) use ($salle) {
            $q->where('salle_id', $salle->id);
        })->count() : 0;
        $capaciteTotale = $seances->sum('max_participants');
        $tauxRemplissage = $capaciteTotale > 0 ? round(($totalReservations / $capaciteTotale) * 100, 1) : 0;

        return view('responsable.occupation', compact(
            'salle',
            'totalSeances',
            'totalReservations',
            'tauxRemplissage',
            'seances'
        ));
    }

    public function facturation()
    {
        $salle = $this->getSalle();
        $coachIds = $salle ? $salle->coachs()->pluck('users.id')->toArray() : [];

        $factures = $coachIds
            ? Facture::with(['coach', 'user'])->whereIn('coach_id', $coachIds)->orderByDesc('issued_at')->get()
            : collect();

        $totalTtc = $factures->sum('total_ttc');
        $totalHt = $factures->sum('total_ht');
        $totalTva = $totalTtc - $totalHt;

        $recentFactures = $factures->take(5);

        return view('responsable.facturation', compact(
            'salle',
            'totalTtc',
            'totalHt',
            'totalTva',
            'recentFactures'
        ));
    }

    public function exportFacturation()
    {
        $salle = $this->getSalle();
        $coachIds = $salle ? $salle->coachs()->pluck('users.id')->toArray() : [];

        $factures = $coachIds
            ? Facture::with(['coach', 'user'])->whereIn('coach_id', $coachIds)->orderByDesc('issued_at')->get()
            : collect();

        $headers = [
            'Content-Type' => 'text/csv; charset=UTF-8',
            'Content-Disposition' => 'attachment; filename="factures-salle.csv"',
        ];

        $callback = function () use ($factures) {
            $handle = fopen('php://output', 'w');
            fputcsv($handle, ['Numero', 'Coach', 'Client', 'Type', 'Total HT', 'TVA', 'Total TTC', 'Statut', 'Date']);

            foreach ($factures as $facture) {
                fputcsv($handle, [
                    $facture->numero,
                    $facture->coach?->name ?? 'Coach',
                    $facture->user?->name ?? 'Client',
                    $facture->type,
                    number_format($facture->total_ht, 2, '.', ''),
                    number_format($facture->tva, 2, '.', ''),
                    number_format($facture->total_ttc, 2, '.', ''),
                    $facture->statut,
                    optional($facture->issued_at)->format('Y-m-d'),
                ]);
            }

            fclose($handle);
        };

        return response()->stream($callback, 200, $headers);
    }

    private function getSalle(): ?Salle
    {
        $user = Auth::user();

        if (!$user) {
            return null;
        }

        return $user->salle;
    }
}
