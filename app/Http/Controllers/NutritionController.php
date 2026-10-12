<?php

namespace App\Http\Controllers;

use App\Models\PlanNutrition;
use App\Models\PlanNutritionAchat;
use App\Models\Facture;
use App\Models\Paiement;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Stripe\Checkout\Session;
use Stripe\Stripe;

class NutritionController extends Controller
{
    public function coachIndex()
    {
        $plans = PlanNutrition::where('coach_id', Auth::id())
            ->orderByDesc('created_at')
            ->get();

        return view('coach.nutrition.index', compact('plans'));
    }

    public function coachCreate()
    {
        return view('coach.nutrition.create');
    }

    public function coachStore(Request $request)
    {
        $validated = $request->validate([
            'titre' => ['required', 'string', 'max:120'],
            'description' => ['nullable', 'string', 'max:1500'],
            'calories' => ['nullable', 'integer', 'min:0'],
            'proteines' => ['nullable', 'integer', 'min:0'],
            'glucides' => ['nullable', 'integer', 'min:0'],
            'lipides' => ['nullable', 'integer', 'min:0'],
            'prix_ht' => ['required', 'numeric', 'min:0'],
            'tva' => ['required', 'numeric', 'min:0'],
        ]);

        $prixTtc = $validated['prix_ht'] * (1 + ($validated['tva'] / 100));

        PlanNutrition::create([
            'coach_id' => Auth::id(),
            'titre' => $validated['titre'],
            'description' => $validated['description'] ?? null,
            'calories' => $validated['calories'] ?? null,
            'proteines' => $validated['proteines'] ?? null,
            'glucides' => $validated['glucides'] ?? null,
            'lipides' => $validated['lipides'] ?? null,
            'prix_ht' => $validated['prix_ht'],
            'tva' => $validated['tva'],
            'prix_ttc' => $prixTtc,
            'actif' => true,
        ]);

        return redirect()->route('coach.nutrition.index')->with('success', 'Plan nutrition cree avec succes.');
    }

    public function clientIndex()
    {
        $plans = PlanNutrition::where('actif', true)
            ->orderBy('titre')
            ->get();

        $achats = PlanNutritionAchat::with('plan')
            ->where('client_id', Auth::id())
            ->get()
            ->keyBy('plan_nutrition_id');

        return view('client.pages.nutrition', compact('plans', 'achats'));
    }

    public function acheterStripe(int $id)
    {
        $plan = PlanNutrition::findOrFail($id);

        $existing = PlanNutritionAchat::where('client_id', Auth::id())
            ->where('plan_nutrition_id', $plan->id)
            ->first();

        if ($existing) {
            return back()->with('success', 'Plan deja achete.');
        }

        $secret = config('services.stripe.secret');

        if (blank($secret)) {
            return back()->with('error', 'Stripe n est pas configure. Ajoutez STRIPE_KEY et STRIPE_SECRET dans le fichier .env.');
        }

        Stripe::setApiKey($secret);

        $checkoutSession = Session::create([
            'mode' => 'payment',
            'customer_email' => Auth::user()->email,
            'line_items' => [
                [
                    'price_data' => [
                        'currency' => 'eur',
                        'product_data' => [
                            'name' => $plan->titre,
                            'description' => $plan->description,
                        ],
                        'unit_amount' => (int) round($plan->prix_ttc * 100),
                    ],
                    'quantity' => 1,
                ],
            ],
            'metadata' => [
                'plan_nutrition_id' => (string) $plan->id,
                'client_id' => (string) Auth::id(),
                'coach_id' => (string) $plan->coach_id,
            ],
            'success_url' => route('client.nutrition.success') . '?session_id={CHECKOUT_SESSION_ID}',
            'cancel_url' => route('client.nutrition.cancel'),
        ]);

        return redirect()->away($checkoutSession->url);
    }

    public function paiementSucces(Request $request)
    {
        $sessionId = $request->query('session_id');
        $secret = config('services.stripe.secret');

        if (blank($sessionId) || blank($secret)) {
            return redirect()->route('client.nutrition')->with('error', 'Session Stripe invalide.');
        }

        Stripe::setApiKey($secret);
        $checkoutSession = Session::retrieve($sessionId);

        if ($checkoutSession->payment_status !== 'paid') {
            return redirect()->route('client.nutrition')->with('error', 'Paiement Stripe non confirme.');
        }

        $metadata = $checkoutSession->metadata ?? [];
        $planId = (int) ($metadata->plan_nutrition_id ?? 0);

        $plan = PlanNutrition::find($planId);

        if (!$plan) {
            return redirect()->route('client.nutrition')->with('error', 'Plan introuvable.');
        }

        PlanNutritionAchat::firstOrCreate(
            [
                'plan_nutrition_id' => $plan->id,
                'client_id' => Auth::id(),
            ],
            [
                'coach_id' => $plan->coach_id,
                'prix_ttc' => $plan->prix_ttc,
                'payment_provider' => 'stripe',
                'stripe_checkout_session_id' => $sessionId,
                'paid_at' => Carbon::now(),
            ]
        );

        $achat = PlanNutritionAchat::where('plan_nutrition_id', $plan->id)
            ->where('client_id', Auth::id())
            ->first();

        if ($achat && !Facture::where('type', 'plan_nutrition')->where('reference_id', $achat->id)->exists()) {
            $facture = Facture::create([
                'numero' => Facture::generateNumero(),
                'user_id' => $achat->client_id,
                'coach_id' => $achat->coach_id,
                'type' => 'plan_nutrition',
                'reference_id' => $achat->id,
                'total_ht' => $plan->prix_ht,
                'tva' => $plan->tva,
                'total_ttc' => $plan->prix_ttc,
                'statut' => 'paye',
                'issued_at' => now(),
            ]);

            Paiement::create([
                'facture_id' => $facture->id,
                'provider' => 'stripe',
                'amount' => $plan->prix_ttc,
                'currency' => 'EUR',
                'statut' => 'paye',
                'paid_at' => now(),
                'reference' => $sessionId,
            ]);
        }

        return redirect()->route('client.nutrition')->with('success', 'Plan nutrition achete avec succes.');
    }

    public function paiementAnnule()
    {
        return redirect()->route('client.nutrition')->with('error', 'Paiement annule.');
    }
}
