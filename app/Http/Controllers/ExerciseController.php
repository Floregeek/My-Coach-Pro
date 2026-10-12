<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Exercise;
use Illuminate\Support\Facades\Auth;

class ExerciseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index() {
    $exercises = Exercise::where('user_id', Auth::id())->orderBy('Nom', 'asc')->get();
    return view('exercises.index', compact('exercises'));
}

    /**
     * Show the form for creating a new resource.
     */
   public function create() {
    return view('exercises.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request) {
    $validated = $request->validate([
        'Nom' => 'required|max:255',
        'Description' => 'required',
        'Consignes' => 'required',
        'Niveau' => 'required|in:Débutant,Intermédiaire,Avancé',
        'Categorie' => 'required',
        'Equipement' => 'nullable|max:255',
        'Media_url' => 'nullable|url',
    ]);

    $validated['user_id'] = Auth::id(); 

    Exercise::create($validated);

    return redirect()->route('exercises.index')->with('success', 'Exercice ajouté !');
}

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $exercise = Exercise::findOrFail($id);
        return view('exercises.show', compact('exercise'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $exercise = Exercise::findOrFail($id);
        
        // Sécurité : Vérifie que c'est bien l'exercice du coach connecté
        if ($exercise->user_id !== Auth::id()) {
            abort(403, 'Action non autorisée.');
        }
        
        return view('exercises.edit', compact('exercise'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $exercise = Exercise::findOrFail($id);

        if ($exercise->user_id !== Auth::id()) {
            abort(403);
        }

        $validated = $request->validate([
            'Nom' => 'required|max:255',
            'Description' => 'required',
            'Consignes' => 'required',
            'Niveau' => 'required|in:Débutant,Intermédiaire,Avancé',
            'Categorie' => 'required',
            'Equipement' => 'nullable|max:255',
            'Media_url' => 'nullable|url',
        ]);

        $exercise->update($validated);

        return redirect()->route('exercises.index')->with('success', 'Exercice mis à jour avec succès !');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $exercise = Exercise::findOrFail($id);

        if ($exercise->user_id !== Auth::id()) {
            abort(403);
        }

        $exercise->delete();

        return redirect()->route('exercises.index')->with('success', 'Exercice supprimé de la bibliothèque.');
    }
}
