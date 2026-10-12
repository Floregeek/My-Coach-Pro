<?php

use App\Http\Controllers\AgendaController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\ContratController;
use App\Http\Controllers\ExerciseController;
use App\Http\Controllers\FacturationController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\OffreController;
use App\Http\Controllers\ProgrammeController;
use App\Http\Controllers\NutritionController;
use App\Http\Controllers\PartenariatController;
use App\Http\Controllers\ProspectController;
use App\Http\Controllers\ProduitController;
use App\Http\Controllers\ResponsableController;
use App\Http\Controllers\CoachSalleContratController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SeanceController;
use App\Models\Client;
use App\Models\Commande;
use App\Models\Seance;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| 1. ROUTES PUBLIQUES
|--------------------------------------------------------------------------
*/
Route::get('/', function () {
    return view('welcome');
});

Route::controller(ProspectController::class)->group(function () {
    Route::get('/coachs', 'index')->name('prospect.index');
    Route::get('/coachs/{id}', 'show')->name('prospect.show');
    Route::get('/contact', 'contact')->name('prospect.contact');
    Route::post('/contact', 'sendContact')->name('prospect.contact.send');
});

/*
|--------------------------------------------------------------------------
| 2. ROUTES COMMUNES (AUTHENTIFICATION)
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard', function () {
        $user = Auth::user();

        if ($user->role === 'coach') {
            $clients = Client::all();
            $clientsCount = $clients->count();
            $now = now();
            $seancesUpcoming = Seance::where('coach_id', $user->id)
                ->whereNotNull('debut_a')
                ->where(function ($query) use ($now) {
                    $query->where('debut_a', '>=', $now)
                        ->orWhere('fin_a', '>=', $now);
                })
                ->count();
            $nextSeance = Seance::where('coach_id', $user->id)
                ->whereNotNull('debut_a')
                ->where(function ($query) use ($now) {
                    $query->where('debut_a', '>=', $now)
                        ->orWhere('fin_a', '>=', $now);
                })
                ->orderBy('debut_a')
                ->first();
            $commandesCount = Commande::count();
            $revenueTotal = Commande::sum('total');
            $revenueSeries = collect(range(5, 0))->map(function ($offset) {
                $start = Carbon::now()->subMonths($offset)->startOfMonth();
                $end = Carbon::now()->subMonths($offset)->endOfMonth();
                $total = Commande::whereBetween('created_at', [$start, $end])->sum('total');

                return [
                    'label' => $start->format('M'),
                    'total' => (float) $total,
                ];
            });

            return view('dashboard', compact(
                'clients',
                'clientsCount',
                'seancesUpcoming',
                'nextSeance',
                'commandesCount',
                'revenueTotal',
                'revenueSeries'
            ));
        }

        if ($user->role === 'client') {
            return view('client.pages.dashboard');
        }

        if ($user->role === 'responsable') {
            return redirect()->route('responsable.dashboard');
        }

        return redirect('/');
    })->name('dashboard');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::resource('exercises', ExerciseController::class);

    Route::controller(MessageController::class)->group(function () {
        Route::get('/messages', 'index')->name('messages.index');
        Route::get('/messages/{user}', 'show')->name('messages.show');
        Route::post('/messages', 'store')->name('messages.store');
    });

    Route::controller(AgendaController::class)->group(function () {
        Route::get('/agenda', 'index')->name('agenda.index');
        Route::post('/agenda', 'store')->name('agenda.store');
    });
});

/*
|--------------------------------------------------------------------------
| 3. ESPACE COACH
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'role:coach'])->prefix('coach')->group(function () {
    Route::get('/gestion', function () {
        return 'Bienvenue sur votre espace de gestion, Coach !';
    });

    Route::controller(ClientController::class)->group(function () {
        Route::get('/clients', 'index')->name('clients.index');
        Route::get('/clients/creer', 'create')->name('clients.create');
        Route::post('/clients', 'store')->name('clients.store');
        Route::get('/clients/{id}', 'show')->name('clients.show');
        Route::get('/clients/{id}/edit', 'edit')->name('clients.edit');
        Route::put('/clients/{id}', 'update')->name('clients.update');
    });

    Route::controller(SeanceController::class)->group(function () {
        Route::get('/seances', 'index')->name('coach.seances.index');
        Route::get('/seances/creer', 'create')->name('coach.seances.create');
        Route::post('/seances', 'store')->name('coach.seances.store');
        Route::get('/seances/{id}', 'show')->name('coach.seances.show');
    });

    Route::controller(ProgrammeController::class)->group(function () {
        Route::get('/programmes', 'coachIndex')->name('coach.programmes.index');
        Route::get('/programmes/creer', 'coachCreate')->name('coach.programmes.create');
        Route::post('/programmes', 'coachStore')->name('coach.programmes.store');
    });

    Route::controller(NutritionController::class)->group(function () {
        Route::get('/nutrition', 'coachIndex')->name('coach.nutrition.index');
        Route::get('/nutrition/creer', 'coachCreate')->name('coach.nutrition.create');
        Route::post('/nutrition', 'coachStore')->name('coach.nutrition.store');
    });

    Route::controller(OffreController::class)->group(function () {
        Route::get('/offres', 'index')->name('coach.offres.index');
        Route::get('/offres/creer', 'create')->name('coach.offres.create');
        Route::post('/offres', 'store')->name('coach.offres.store');
    });

    Route::controller(ContratController::class)->group(function () {
        Route::get('/contrats', 'indexCoach')->name('coach.contrats.index');
        Route::get('/contrats/creer', 'createCoach')->name('coach.contrats.create');
        Route::post('/contrats', 'storeCoach')->name('coach.contrats.store');
        Route::post('/contrats/{id}/consommer', 'consume')->name('coach.contrats.consume');
    });

    Route::controller(FacturationController::class)->group(function () {
        Route::get('/facturation', 'index')->name('coach.facturation.index');
        Route::get('/facturation/export', 'export')->name('coach.facturation.export');
    });

    Route::controller(PartenariatController::class)->group(function () {
        Route::get('/partenariats', 'index')->name('coach.partenariats.index');
        Route::get('/partenariats/creer', 'create')->name('coach.partenariats.create');
        Route::post('/partenariats', 'store')->name('coach.partenariats.store');
    });
});

/*
|--------------------------------------------------------------------------
| 4. ESPACE CLIENT
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'role:client'])->prefix('client')->group(function () {
    Route::controller(ClientController::class)->group(function () {
        Route::get('/mon-suivi-sante', 'myProfile')->name('client.my-profile');
        Route::get('/coach', 'monCoach')->name('client.coach');
    });

    Route::controller(SeanceController::class)->group(function () {
        Route::get('/catalogue', 'catalogue')->name('client.seances.index');
        Route::post('/seances/{id}/reserver', 'reserver')->name('seances.reserver');
        Route::post('/seances/{id}/performance', 'simulerPerformance')->name('seances.performance');
        Route::get('/mes-performances', 'mesPerformances')->name('client.performances');
        Route::post('/performances/import', 'importerDonneesSportives')->name('client.performances.import');
        Route::get('/planning', 'planningClient')->name('client.planning');
    });

    Route::controller(ProgrammeController::class)->group(function () {
        Route::get('/programmes', 'clientIndex')->name('client.programmes');
        Route::post('/programmes/{id}/acheter', 'acheter')->name('client.programmes.acheter');
    });

    Route::controller(NutritionController::class)->group(function () {
        Route::get('/nutrition', 'clientIndex')->name('client.nutrition');
        Route::post('/nutrition/{id}/acheter', 'acheterStripe')->name('client.nutrition.acheter');
        Route::get('/nutrition/paiement/succes', 'paiementSucces')->name('client.nutrition.success');
        Route::get('/nutrition/paiement/annule', 'paiementAnnule')->name('client.nutrition.cancel');
    });

    Route::controller(ContratController::class)->group(function () {
        Route::get('/contrats', 'indexClient')->name('client.contrats');
    });

    Route::controller(ProduitController::class)->group(function () {
        Route::get('/boutique', 'index')->name('boutique.index');
        Route::post('/boutique/acheter/{id}', 'acheter')->name('boutique.acheter');
        Route::get('/panier', 'panier')->name('panier.index');
        Route::post('/panier/ajouter/{id}', 'ajouterAuPanier')->name('panier.ajouter');
        Route::post('/panier/retirer/{id}', 'retirerDuPanier')->name('panier.retirer');
        Route::post('/panier/incrementer/{id}', 'incrementer')->name('panier.incrementer');
        Route::post('/panier/decrementer/{id}', 'decrementer')->name('panier.decrementer');
        Route::get('/produit/{id}', 'show')->name('produit.show');
        Route::get('/boutique/checkout', 'checkout')->name('checkout.index');
        Route::post('/boutique/paiement', 'traiterPaiement')->name('checkout.paiement');
        Route::post('/boutique/paiement/stripe', 'lancerPaiementStripe')->name('checkout.stripe');
        Route::get('/boutique/paiement/succes', 'paiementSucces')->name('checkout.success');
        Route::get('/boutique/paiement/annule', 'paiementAnnule')->name('checkout.cancel');
    });
});

Route::middleware(['auth', 'role:responsable'])->prefix('responsable')->group(function () {
    Route::controller(ResponsableController::class)->group(function () {
        Route::get('/dashboard', 'dashboard')->name('responsable.dashboard');
        Route::get('/coachs', 'coachs')->name('responsable.coachs');
        Route::post('/coachs', 'updateCoachs')->name('responsable.coachs.update');
        Route::get('/planning', 'planning')->name('responsable.planning');
        Route::post('/planning/affecter', 'affecterSeance')->name('responsable.planning.affecter');
        Route::get('/occupation', 'occupation')->name('responsable.occupation');
        Route::get('/facturation', 'facturation')->name('responsable.facturation');
        Route::get('/facturation/export', 'exportFacturation')->name('responsable.facturation.export');
    });

    Route::controller(CoachSalleContratController::class)->group(function () {
        Route::get('/contrats', 'index')->name('responsable.contrats.index');
        Route::post('/contrats', 'store')->name('responsable.contrats.store');
    });
});

require __DIR__ . '/auth.php';
