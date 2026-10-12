<?php

namespace App\Http\Controllers;

use App\Models\Partenariat;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PartenariatController extends Controller
{
    public function index()
    {
        $partenariats = Partenariat::with(['coach', 'partenaire'])
            ->where('coach_id', Auth::id())
            ->orWhere('partner_coach_id', Auth::id())
            ->orderByDesc('created_at')
            ->get();

        return view('coach.partenariats.index', compact('partenariats'));
    }

    public function create()
    {
        $coachs = User::where('role', 'coach')
            ->where('id', '!=', Auth::id())
            ->orderBy('name')
            ->get();

        return view('coach.partenariats.create', compact('coachs'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'partner_coach_id' => ['required', 'integer', 'exists:users,id'],
            'type' => ['required', 'string', 'max:50'],
            'commission_rate' => ['required', 'numeric', 'min:0', 'max:100'],
        ]);

        Partenariat::create([
            'coach_id' => Auth::id(),
            'partner_coach_id' => $validated['partner_coach_id'],
            'type' => $validated['type'],
            'commission_rate' => $validated['commission_rate'],
            'statut' => 'actif',
        ]);

        return redirect()->route('coach.partenariats.index')->with('success', 'Partenariat cree avec succes.');
    }
}
