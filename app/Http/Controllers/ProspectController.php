<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class ProspectController extends Controller
{
    public function index()
    {
        $coaches = User::where('role', 'coach')
            ->orderBy('name')
            ->get();

        return view('prospect.index', compact('coaches'));
    }

    public function show(int $id)
    {
        $coach = User::where('role', 'coach')->findOrFail($id);

        return view('prospect.show', compact('coach'));
    }

    public function contact(Request $request)
    {
        $selectedCoach = null;
        $coachId = $request->query('coach');

        if ($coachId) {
            $selectedCoach = User::where('role', 'coach')->find($coachId);
        }

        $coaches = User::where('role', 'coach')
            ->orderBy('name')
            ->get();

        return view('prospect.contact', compact('coaches', 'selectedCoach'));
    }

    public function sendContact(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:120'],
            'email' => ['required', 'email', 'max:190'],
            'message' => ['required', 'string', 'max:2000'],
            'coach_id' => ['nullable', 'integer'],
        ]);

        Log::info('Prospect contact request', [
            'name' => $validated['name'],
            'email' => $validated['email'],
            'coach_id' => $validated['coach_id'] ?? null,
        ]);

        return back()->with('status', 'Merci, votre demande a ete envoyee.');
    }
}
