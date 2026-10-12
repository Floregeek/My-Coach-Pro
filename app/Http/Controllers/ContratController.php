<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\Contrat;
use App\Models\Offre;
use App\Models\Facture;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ContratController extends Controller
{
    public function indexCoach()
    {
        $contrats = Contrat::with(['client', 'offre'])
            ->where('coach_id', Auth::id())
            ->orderByDesc('created_at')
            ->get();

        return view('coach.contrats.index', compact('contrats'));
    }

    public function createCoach()
    {
        $clients = Client::with('user')->orderBy('Nom')->get();
        $offres = Offre::where('coach_id', Auth::id())->where('active', true)->get();

        return view('coach.contrats.create', compact('clients', 'offres'));
    }

    public function storeCoach(Request $request)
    {
        $validated = $request->validate([
            'client_id' => ['required', 'integer'],
            'offre_id' => ['required', 'integer', 'exists:offres,id'],
            'date_expiration' => ['nullable', 'date'],
        ]);

        $offre = Offre::where('coach_id', Auth::id())->findOrFail($validated['offre_id']);

        $totalSeances = $offre->total_seances ?? 0;
        $expiration = $validated['date_expiration'];

        if (!$expiration && $offre->type === 'abonnement' && $offre->duree_mois) {
            $expiration = Carbon::now()->addMonths($offre->duree_mois);
        }

        $contrat = Contrat::create([
            'client_id' => $validated['client_id'],
            'coach_id' => Auth::id(),
            'offre_id' => $offre->id,
            'type' => $offre->type,
            'total_seances' => $totalSeances,
            'seances_restantes' => $totalSeances,
            'date_expiration' => $expiration,
            'prix_ht' => $offre->prix_ht,
            'tva' => $offre->tva,
            'prix_ttc' => $offre->prix_ttc,
        ]);

        Facture::create([
            'numero' => Facture::generateNumero(),
            'user_id' => $contrat->client_id,
            'coach_id' => $contrat->coach_id,
            'type' => 'contrat',
            'reference_id' => $contrat->id,
            'total_ht' => $contrat->prix_ht,
            'tva' => $contrat->tva,
            'total_ttc' => $contrat->prix_ttc,
            'statut' => 'impaye',
            'issued_at' => now(),
            'due_at' => $contrat->date_expiration ?? now()->addDays(30),
        ]);

        return redirect()->route('coach.contrats.index')->with('success', 'Contrat cree avec succes.');
    }

    public function consume(int $id)
    {
        $contrat = Contrat::where('coach_id', Auth::id())->findOrFail($id);

        if ($contrat->seances_restantes > 0) {
            $contrat->decrement('seances_restantes');
        }

        return back()->with('success', 'Seance consommee.');
    }

    public function indexClient()
    {
        $contrats = Contrat::with(['coach', 'offre'])
            ->where('client_id', Auth::id())
            ->orderByDesc('created_at')
            ->get();

        return view('client.pages.contrats', compact('contrats'));
    }
}
