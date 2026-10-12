<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Seance; 
use Illuminate\Support\Facades\Auth;
use App\Models\Performance;
use App\Models\Exercise;

class SeanceController extends Controller
{
    /**
     * Affiche la liste des séances (Vue Coach)
     */
    public function index()
    {
        // On récupère uniquement les séances créées par ce coach
        $seances = Seance::where('coach_id', Auth::id())->get();
        
        return view('coach.seances.index', compact('seances'));
    }

    /**
     * Affiche le formulaire de création (C'est ce qui manquait !)
     */
    public function create()
    {
       
        
        $exercises = Exercise::all(); 
        return view('coach.seances.create', compact('exercises'));

    }

    /**
     * Enregistre la séance dans la base de données
     */
    public function store(Request $request)
    {
        $request->validate([
            'titre' => 'required|string|max:255',
            'debut_a' => 'required|date',
            'max_participants' => 'required|integer|min:1',
            'exercises' => 'nullable|array',
        ]);

        $seance = Seance::create([
            'coach_id' => Auth::id(),
            'titre' => $request->titre,
            'description' => $request->description,
            'debut_a' => $request->debut_a,
            'fin_a' => $request->fin_a,
            'max_participants' => $request->max_participants,
        ]);

        //  Liaison des exercices cochés 
    if ($request->has('exercises')) {
        $seance->exercises()->attach($request->exercises);
    }

        return redirect()->route('coach.seances.index')->with('success', 'Séance type créée avec son programme !');
    }

    /**
     * Logique de réservation pour le Client
     */
    public function reserver(Request $request, $seanceId)
    {
        $seance = Seance::findOrFail($seanceId);
        $user = Auth::user();

        // 1. VÉRIFICATION : Est-ce que la séance est complète ?
        if ($seance->clients()->count() >= $seance->max_participants) {
            return back()->with('error', 'Désolé, cette séance est déjà complète !');
        }

        // 2. VÉRIFICATION : Est-ce que le client est déjà inscrit ?
        if ($seance->clients()->where('user_id', $user->id)->exists()) {
            return back()->with('error', 'Vous êtes déjà inscrit à ce créneau.');
        }

        // 3. INSCRIPTION : Ajout dans la table pivot 'reservations'
        $seance->clients()->attach($user->id, [
            'commentaire_client' => $request->input('commentaire'),
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        return back()->with('success', 'Votre réservation a été validée avec succès !');
    }
   
    // On récupère  les séances pour que le client puisse choisir
public function catalogue()
{
    $seances = Seance::with(['clients', 'exercises'])->get(); 
    return view('client.seances.index', compact('seances'));
}
public function show($id)
{
    
    $seance = Seance::with(['clients', 'exercises'])
        ->where('coach_id', Auth::id())
        ->findOrFail($id);
    
    return view('coach.seances.show', compact('seance'));
}
public function simulerPerformance($seance_id)
{
    
    $existeDeja = Performance::where('user_id', auth()->id())
                              ->where('seance_id', $seance_id)
                              ->exists();

    
    if ($existeDeja) {
        return back()->with('error', 'Vous avez déjà importé les données pour cette séance !');
    }

   
    Performance::create([
        'user_id' => auth()->id(),
        'seance_id' => $seance_id,
        'distance_km' => rand(3, 12) + (rand(0, 9) / 10),
        'calories' => rand(250, 900),
        'duree_minutes' => rand(20, 120),
    ]);

    return back()->with('success', 'Données sportives importées avec succès !');
}
public function mesPerformances()
{
    
    $performances = Performance::where('user_id', auth()->id())
                                ->with('seance')
                                ->latest() 
                                ->get();

    return view('client.performances.index', compact('performances'));
}

public function importerDonneesSportives()
{
    $userId = auth()->id();

    $seance = Seance::whereHas('clients', function ($query) use ($userId) {
        $query->where('users.id', $userId);
    })->orderBy('debut_a', 'desc')->first();

    if (!$seance) {
        $seance = Seance::orderBy('debut_a', 'desc')->first();
    }

    if (!$seance) {
        return back()->with('error', 'Aucune seance disponible pour importer des donnees.');
    }

    $alreadyExists = Performance::where('user_id', $userId)
        ->where('seance_id', $seance->id)
        ->exists();

    if ($alreadyExists) {
        return back()->with('error', 'Une performance existe deja pour cette seance.');
    }

    Performance::create([
        'user_id' => $userId,
        'seance_id' => $seance->id,
        'distance_km' => rand(3, 12) + (rand(0, 9) / 10),
        'calories' => rand(250, 900),
        'duree_minutes' => rand(20, 120),
    ]);

    return back()->with('success', 'Donnees sportives importees avec succes (mock).');
}

public function planningClient()
{
    $seances = Seance::with('exercises')
        ->whereHas('clients', function ($query) {
            $query->where('users.id', auth()->id());
        })
        ->orderBy('debut_a')
        ->get();

    $calendarEvents = $seances->map(function ($seance) {
        $color = $seance->type === 'collective' ? '#10b981' : '#4f46e5';

        return [
            'id' => $seance->id,
            'title' => $seance->titre,
            'start' => $seance->debut_a,
            'end' => $seance->fin_a,
            'backgroundColor' => $color,
            'borderColor' => $color,
        ];
    });

    return view('client.pages.planning', [
        'seances' => $seances,
        'calendarEvents' => $calendarEvents,
    ]);
}

public function programmesClient()
{
    return view('client.pages.programmes');
}

}
