<?php

namespace App\Http\Controllers;

use App\Models\Commande;
use App\Models\Facture;
use App\Models\Panier;
use App\Models\Paiement;
use App\Models\Produit;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Stripe\Checkout\Session;
use Stripe\Stripe;

class ProduitController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');

        $produits = Produit::when($search, function ($query) use ($search) {
            return $query->where('nom', 'like', "%{$search}%")
                ->orWhere('categorie', 'like', "%{$search}%");
        })->get();

        return view('boutique.index', compact('produits'));
    }

    public function show($id)
    {
        $produit = Produit::findOrFail($id);

        $similaires = Produit::where('categorie', $produit->categorie)
            ->where('id', '!=', $id)
            ->limit(4)
            ->get();

        return view('boutique.show', compact('produit', 'similaires'));
    }

    public function acheter(Request $request, $id): RedirectResponse
    {
        $item = Panier::where('user_id', Auth::id())
            ->where('produit_id', $id)
            ->first();

        if ($item) {
            $item->increment('quantite');
        } else {
            Panier::create([
                'user_id' => Auth::id(),
                'produit_id' => $id,
                'quantite' => 1,
            ]);
        }

        return redirect()->route('panier.index')->with('success', 'Produit ajoute au panier.');
    }

    public function panier()
    {
        $items = Panier::where('user_id', Auth::id())->with('produit')->get();

        return view('boutique.panier', compact('items'));
    }

    public function ajouterAuPanier(Request $request, $id): RedirectResponse
    {
        $item = Panier::where('user_id', Auth::id())
            ->where('produit_id', $id)
            ->first();

        if ($item) {
            $item->increment('quantite');
        } else {
            Panier::create([
                'user_id' => Auth::id(),
                'produit_id' => $id,
                'quantite' => 1,
            ]);
        }

        return redirect()->back()->with('success', 'Article sauvegarde dans votre panier.');
    }

    public function retirerDuPanier($id): RedirectResponse
    {
        $item = Panier::where('user_id', Auth::id())
            ->where('id', $id)
            ->first();

        if ($item) {
            $item->delete();
        }

        return redirect()->back()->with('success', 'Produit retire.');
    }

    public function checkout()
    {
        $items = Panier::where('user_id', Auth::id())
            ->with('produit')
            ->get();

        if ($items->isEmpty()) {
            return redirect()->route('boutique.index')->with('error', 'Votre panier est vide.');
        }

        return view('boutique.checkout', compact('items'));
    }

    public function traiterPaiement(Request $request)
    {
        $validated = $request->validate([
            'adresse' => 'required|string|max:255',
            'ville' => 'required|string|max:255',
            'code_postal' => 'required|string|max:20',
        ]);

        $items = Panier::where('user_id', Auth::id())
            ->with('produit')
            ->get();

        if ($items->isEmpty()) {
            return redirect()->route('boutique.index')->with('error', 'Votre panier est vide.');
        }

        $total = $items->sum(function ($item) {
            return $item->produit->prix * $item->quantite;
        });

        return view('boutique.paiement', [
            'infos' => $validated,
            'items' => $items,
            'total' => $total,
            'stripeKeyConfigured' => filled(config('services.stripe.key')) && filled(config('services.stripe.secret')),
        ]);
    }

    public function lancerPaiementStripe(Request $request)
    {
        $validated = $request->validate([
            'adresse' => 'required|string|max:255',
            'ville' => 'required|string|max:255',
            'code_postal' => 'required|string|max:20',
        ]);

        $items = Panier::where('user_id', Auth::id())
            ->with('produit')
            ->get();

        if ($items->isEmpty()) {
            return redirect()->route('boutique.index')->with('error', 'Votre panier est vide.');
        }

        $secret = config('services.stripe.secret');

        if (blank($secret)) {
            return redirect()
                ->route('checkout.index')
                ->with('error', 'Stripe n est pas configure. Ajoutez STRIPE_KEY et STRIPE_SECRET dans le fichier .env.');
        }

        Stripe::setApiKey($secret);

        $lineItems = $items->map(function ($item) {
            return [
                'price_data' => [
                    'currency' => 'eur',
                    'product_data' => [
                        'name' => $item->produit->nom,
                        'description' => $item->produit->description,
                    ],
                    'unit_amount' => (int) round($item->produit->prix * 100),
                ],
                'quantity' => $item->quantite,
            ];
        })->values()->all();

        $checkoutSession = Session::create([
            'mode' => 'payment',
            'customer_email' => Auth::user()->email,
            'line_items' => $lineItems,
            'metadata' => [
                'user_id' => (string) Auth::id(),
                'adresse' => $validated['adresse'],
                'ville' => $validated['ville'],
                'code_postal' => $validated['code_postal'],
            ],
            'success_url' => route('checkout.success') . '?session_id={CHECKOUT_SESSION_ID}',
            'cancel_url' => route('checkout.cancel'),
        ]);

        return redirect()->away($checkoutSession->url);
    }

    public function paiementSucces(Request $request)
    {
        $sessionId = $request->query('session_id');
        $secret = config('services.stripe.secret');

        if (blank($sessionId) || blank($secret)) {
            return redirect()->route('boutique.index')->with('error', 'Session Stripe invalide.');
        }

        Stripe::setApiKey($secret);

        $checkoutSession = Session::retrieve($sessionId);

        if ($checkoutSession->payment_status !== 'paid') {
            return redirect()->route('panier.index')->with('error', 'Le paiement Stripe n a pas ete confirme.');
        }

        $existingCommandes = Commande::where('stripe_checkout_session_id', $sessionId)
            ->with('produit')
            ->get();

        if ($existingCommandes->isNotEmpty()) {
            $infos = [
                'adresse' => $existingCommandes->first()->adresse,
                'ville' => $existingCommandes->first()->ville,
                'code_postal' => $existingCommandes->first()->code_postal,
            ];

            return view('boutique.recu', ['items' => $existingCommandes, 'infos' => $infos]);
        }

        $items = Panier::where('user_id', Auth::id())
            ->with('produit')
            ->get();

        if ($items->isEmpty()) {
            return redirect()->route('boutique.index')->with('error', 'Le panier est vide apres retour Stripe.');
        }

        $metadata = $checkoutSession->metadata ?? [];

        DB::transaction(function () use ($items, $sessionId, $metadata) {
            foreach ($items as $item) {
                $commande = Commande::create([
                    'user_id' => Auth::id(),
                    'produit_id' => $item->produit_id,
                    'quantite' => $item->quantite,
                    'total' => $item->produit->prix * $item->quantite,
                    'adresse' => $metadata->adresse ?? null,
                    'ville' => $metadata->ville ?? null,
                    'code_postal' => $metadata->code_postal ?? null,
                    'statut' => 'paye',
                    'payment_provider' => 'stripe',
                    'stripe_checkout_session_id' => $sessionId,
                ]);

                $tvaRate = 20;
                $totalTtc = (float) $commande->total;
                $totalHt = $tvaRate > 0 ? $totalTtc / (1 + ($tvaRate / 100)) : $totalTtc;

                $facture = Facture::create([
                    'numero' => Facture::generateNumero(),
                    'user_id' => $commande->user_id,
                    'coach_id' => null,
                    'type' => 'commande',
                    'reference_id' => $commande->id,
                    'total_ht' => $totalHt,
                    'tva' => $tvaRate,
                    'total_ttc' => $totalTtc,
                    'statut' => 'paye',
                    'issued_at' => now(),
                ]);

                Paiement::create([
                    'facture_id' => $facture->id,
                    'provider' => 'stripe',
                    'amount' => $totalTtc,
                    'currency' => 'EUR',
                    'statut' => 'paye',
                    'paid_at' => now(),
                    'reference' => $sessionId,
                ]);

                $item->produit->decrement('stock', $item->quantite);
            }

            Panier::where('user_id', Auth::id())->delete();
        });

        $commandes = Commande::where('stripe_checkout_session_id', $sessionId)
            ->with('produit')
            ->get();

        $infos = [
            'adresse' => $commandes->first()?->adresse,
            'ville' => $commandes->first()?->ville,
            'code_postal' => $commandes->first()?->code_postal,
        ];

        return view('boutique.recu', ['items' => $commandes, 'infos' => $infos]);
    }

    public function paiementAnnule(): RedirectResponse
    {
        return redirect()->route('panier.index')->with('error', 'Paiement annule. Votre panier a ete conserve.');
    }

    public function validerPanier(Request $request)
    {
        $items = Panier::where('user_id', Auth::id())->with('produit')->get();

        if ($items->isEmpty()) {
            return redirect()->route('boutique.index')->with('error', 'Panier vide.');
        }

        foreach ($items as $item) {
            $commande = Commande::create([
                'user_id' => Auth::id(),
                'produit_id' => $item->produit_id,
                'quantite' => $item->quantite,
                'total' => $item->produit->prix * $item->quantite,
                'adresse' => $request->adresse,
                'ville' => $request->ville,
                'code_postal' => $request->code_postal,
            ]);

            $tvaRate = 20;
            $totalTtc = (float) $commande->total;
            $totalHt = $tvaRate > 0 ? $totalTtc / (1 + ($tvaRate / 100)) : $totalTtc;

            $facture = Facture::create([
                'numero' => Facture::generateNumero(),
                'user_id' => $commande->user_id,
                'coach_id' => null,
                'type' => 'commande',
                'reference_id' => $commande->id,
                'total_ht' => $totalHt,
                'tva' => $tvaRate,
                'total_ttc' => $totalTtc,
                'statut' => 'paye',
                'issued_at' => now(),
            ]);

            Paiement::create([
                'facture_id' => $facture->id,
                'provider' => 'manual',
                'amount' => $totalTtc,
                'currency' => 'EUR',
                'statut' => 'paye',
                'paid_at' => now(),
            ]);

            $item->produit->decrement('stock', $item->quantite);
        }

        $recapitulatif = $items;
        $infos = $request->only(['adresse', 'ville', 'code_postal']);

        Panier::where('user_id', Auth::id())->delete();

        return view('boutique.recu', ['items' => $recapitulatif, 'infos' => $infos]);
    }

    public function incrementer($id): RedirectResponse
    {
        $item = Panier::where('user_id', Auth::id())
            ->where('id', $id)
            ->firstOrFail();

        if ($item->quantite < $item->produit->stock) {
            $item->increment('quantite');

            return redirect()->back();
        }

        return redirect()->back()->with('error', 'Stock maximum atteint.');
    }

    public function decrementer($id): RedirectResponse
    {
        $item = Panier::where('user_id', Auth::id())
            ->where('id', $id)
            ->firstOrFail();

        if ($item->quantite > 1) {
            $item->decrement('quantite');
        } else {
            $item->delete();
        }

        return redirect()->back();
    }
}
