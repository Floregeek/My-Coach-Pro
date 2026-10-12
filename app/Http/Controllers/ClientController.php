<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Client;
use App\Models\User;
use Illuminate\Support\Facades\Auth; 



class ClientController extends Controller
{
    /**
     * Display a listing of the resource.
     */ 
    // Affiche tous les clients pour le Coach
    public function index()
    {
        $clients = Client::all(); 
        return view('coach.clients.index', compact('clients'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('coach.clients.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // 1. Validation complète de tous les champs
    $validated = $request->validate([
        'Prenom' => 'required|string|max:255',
        'Nom' => 'required|string|max:255',
        'Email' => 'required|email|unique:clients,Email',
        'Date_nais' => 'nullable|date',
        'Adresse' => 'nullable|string|max:500',
        'Telephone' => 'nullable|string|max:20',
        'Niveau' => 'required|string',
        'Objectifs' => 'required|string',
        'Pathologies' => 'nullable|string', // Données de santé
        'consentement_rgpd' => 'accepted', // Obligation légale
        'user_id' => 'required|exists:users,id'
    ]);

    // 2. Préparation des données
    $data = $validated;
    $data['consentement_rgpd'] = true; // On enregistre la preuve du consentement

    // 3. Création en base de données
    Client::create($data);

    // 4. Redirection avec le message de succès (qui disparaîtra après 4s)
    return redirect()->route('clients.index')->with('success', 'Nouveau client et dossier santé créés avec succès !');
    }

    /**
     * Display the specified resource.
     */
    // Affiche le dossier d'un client précis
    public function show(string $id)
    {
        $client = Client::findOrFail($id);
        return view('coach.clients.show', compact('client'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validated = $request->validate([
        'Prenom' => 'required|string|max:255',
        'Nom' => 'required|string|max:255',
        'Email' => 'required|email',
        'Telephone' => 'nullable|string',
        'Date_nais' => 'nullable|date',
        'Adresse' => 'nullable|string',
        'Niveau' => 'required|string',
        'Objectifs' => 'required|string',
        'Pathologies' => 'nullable|string', // Bien vérifier la majuscule !
        'consentement_rgpd' => 'accepted', 
    ]);

    $client = Client::findOrFail($id);

    // On prépare les données et on force le true pour le RGPD
    $data = $validated;
    $data['consentement_rgpd'] = true;

    $client->update($data); // Une seule mise à jour suffit

    return redirect()->route('clients.index')->with('success', 'Fiche client mise à jour avec succès !');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    // VUE CLIENT : Consulter ses propres données (RGPD)
public function myProfile()
{
    $userId = Auth::id();
    $client = Client::where('user_id', $userId)->first();

    if (!$client) {
        // Si on ne trouve pas de client, on affiche un message d'erreur au lieu d'une 404 brute
        return "Erreur : Aucun dossier client trouvé pour l'ID utilisateur " . $userId;
    }

    return view('client.pages.my-profile', compact('client'));
}

public function monCoach()
    {
        return view('client.pages.coach');
    }

}
