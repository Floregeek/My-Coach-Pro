<?php

namespace App\Http\Controllers;

use App\Models\Facture;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FacturationController extends Controller
{
    public function index()
    {
        $factures = Facture::with(['user'])
            ->where('coach_id', Auth::id())
            ->orderByDesc('issued_at')
            ->get();

        $totalTtc = $factures->sum('total_ttc');
        $totalHt = $factures->sum('total_ht');
        $totalTva = $totalTtc - $totalHt;
        $facturesPayees = $factures->where('statut', 'paye')->count();

        return view('coach.facturation.index', compact(
            'factures',
            'totalTtc',
            'totalHt',
            'totalTva',
            'facturesPayees'
        ));
    }

    public function export()
    {
        $factures = Facture::with('user')
            ->where('coach_id', Auth::id())
            ->orderByDesc('issued_at')
            ->get();

        $headers = [
            'Content-Type' => 'text/csv; charset=UTF-8',
            'Content-Disposition' => 'attachment; filename="factures-coach.csv"',
        ];

        $callback = function () use ($factures) {
            $handle = fopen('php://output', 'w');
            fputcsv($handle, ['Numero', 'Client', 'Type', 'Total HT', 'TVA', 'Total TTC', 'Statut', 'Date']);

            foreach ($factures as $facture) {
                fputcsv($handle, [
                    $facture->numero,
                    $facture->user?->name ?? 'Client',
                    $facture->type,
                    number_format($facture->total_ht, 2, '.', ''),
                    number_format($facture->tva, 2, '.', ''),
                    number_format($facture->total_ttc, 2, '.', ''),
                    $facture->statut,
                    optional($facture->issued_at)->format('Y-m-d'),
                ]);
            }

            fclose($handle);
        };

        return response()->stream($callback, 200, $headers);
    }
}
