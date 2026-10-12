<?php

namespace App\Http\Controllers;

use App\Models\Programme;
use App\Models\ProgrammeInscription;
use App\Models\Facture;
use App\Models\Paiement;
use App\Models\Reservation;
use App\Models\Seance;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProgrammeController extends Controller
{
    public function coachIndex()
    {
        $programmes = Programme::where('coach_id', Auth::id())
            ->orderByDesc('created_at')
            ->get();

        return view('coach.programmes.index', compact('programmes'));
    }

    public function coachCreate()
    {
        return view('coach.programmes.create');
    }

    public function coachStore(Request $request)
    {
        $validated = $request->validate([
            'titre' => ['required', 'string', 'max:120'],
            'description' => ['nullable', 'string', 'max:1500'],
            'prix_ht' => ['required', 'numeric', 'min:0'],
            'tva' => ['required', 'numeric', 'min:0'],
            'duree_semaines' => ['required', 'integer', 'min:1'],
            'seances_par_semaine' => ['required', 'integer', 'min:1'],
        ]);

        $prixTtc = $validated['prix_ht'] * (1 + ($validated['tva'] / 100));

        Programme::create([
            'coach_id' => Auth::id(),
            'titre' => $validated['titre'],
            'description' => $validated['description'] ?? null,
            'prix_ht' => $validated['prix_ht'],
            'tva' => $validated['tva'],
            'prix_ttc' => $prixTtc,
            'duree_semaines' => $validated['duree_semaines'],
            'seances_par_semaine' => $validated['seances_par_semaine'],
            'actif' => true,
        ]);

        return redirect()->route('coach.programmes.index')->with('success', 'Programme cree avec succes.');
    }

    public function clientIndex()
    {
        $programmes = Programme::where('actif', true)
            ->orderBy('titre')
            ->get();

        $mesProgrammes = ProgrammeInscription::with('programme')
            ->where('client_id', Auth::id())
            ->orderByDesc('created_at')
            ->get();

        return view('client.pages.programmes', compact('programmes', 'mesProgrammes'));
    }

    public function acheter(int $id)
    {
        $programme = Programme::findOrFail($id);
        $clientId = Auth::id();

        $inscription = ProgrammeInscription::firstOrCreate(
            [
                'programme_id' => $programme->id,
                'client_id' => $clientId,
            ],
            [
                'coach_id' => $programme->coach_id,
                'statut' => 'en_cours',
                'commence_le' => Carbon::now()->toDateString(),
                'termine_le' => Carbon::now()->addWeeks($programme->duree_semaines)->toDateString(),
                'paid_at' => $programme->prix_ttc > 0 ? Carbon::now() : null,
            ]
        );

        if ($inscription->wasRecentlyCreated) {
            $this->planifierSeances($programme, $clientId);
        }

        if ($programme->prix_ttc > 0 && !Facture::where('type', 'programme')->where('reference_id', $inscription->id)->exists()) {
            $facture = Facture::create([
                'numero' => Facture::generateNumero(),
                'user_id' => $clientId,
                'coach_id' => $programme->coach_id,
                'type' => 'programme',
                'reference_id' => $inscription->id,
                'total_ht' => $programme->prix_ht,
                'tva' => $programme->tva,
                'total_ttc' => $programme->prix_ttc,
                'statut' => 'paye',
                'issued_at' => now(),
            ]);

            Paiement::create([
                'facture_id' => $facture->id,
                'provider' => 'manual',
                'amount' => $programme->prix_ttc,
                'currency' => 'EUR',
                'statut' => 'paye',
                'paid_at' => now(),
            ]);
        }

        return back()->with('success', 'Programme ajoute et seances planifiees.');
    }

    private function planifierSeances(Programme $programme, int $clientId): void
    {
        $start = Carbon::now()->addDay()->startOfDay()->addHours(18);
        $weeks = $programme->duree_semaines;
        $perWeek = $programme->seances_par_semaine;
        $coachId = $programme->coach_id;

        for ($week = 0; $week < $weeks; $week++) {
            for ($i = 0; $i < $perWeek; $i++) {
                $date = (clone $start)->addWeeks($week)->addDays($i * 2);
                $seance = Seance::create([
                    'coach_id' => $coachId,
                    'titre' => 'Programme: ' . $programme->titre . ' - S' . ($week + 1) . '.' . ($i + 1),
                    'type' => 'individuelle',
                    'description' => 'Seance auto planifiee.',
                    'debut_a' => $date,
                    'fin_a' => (clone $date)->addHour(),
                    'max_participants' => 1,
                    'statut' => 'programme',
                ]);

                Reservation::firstOrCreate([
                    'user_id' => $clientId,
                    'seance_id' => $seance->id,
                ]);
            }
        }
    }
}
