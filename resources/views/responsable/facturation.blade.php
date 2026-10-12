<x-app-layout>
    <div class="bg-white rounded-3xl border border-slate-200 shadow-sm p-6">
        <h1 class="text-2xl font-extrabold text-slate-900">Facturation salle</h1>
        <p class="text-slate-500 mb-6">Resume financier (factures des coachs affilies).</p>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
            <div class="rounded-2xl border border-slate-200 p-4">
                <div class="text-sm text-slate-500">Total HT</div>
                <div class="text-3xl font-extrabold text-slate-900">{{ number_format($totalHt, 2, ',', ' ') }} EUR</div>
            </div>
            <div class="rounded-2xl border border-slate-200 p-4">
                <div class="text-sm text-slate-500">TVA collectee</div>
                <div class="text-3xl font-extrabold text-slate-900">{{ number_format($totalTva, 2, ',', ' ') }} EUR</div>
            </div>
            <div class="rounded-2xl border border-slate-200 p-4">
                <div class="text-sm text-slate-500">Total TTC</div>
                <div class="text-3xl font-extrabold text-slate-900">{{ number_format($totalTtc, 2, ',', ' ') }} EUR</div>
            </div>
        </div>

        <div class="mt-6 rounded-2xl border border-slate-200 p-4">
            <div class="flex items-center justify-between mb-3">
                <h2 class="text-lg font-bold text-slate-900">Dernieres factures</h2>
                <a href="{{ route('responsable.facturation.export') }}" class="text-sm font-bold text-slate-900">
                    Exporter CSV
                </a>
            </div>
            <div class="space-y-3">
                @forelse($recentFactures as $facture)
                    <div class="border border-slate-200 rounded-2xl p-3 flex items-center justify-between">
                        <div>
                            <div class="font-semibold text-slate-900">{{ $facture->numero }}</div>
                            <div class="text-xs text-slate-500">{{ $facture->coach?->name ?? 'Coach' }} | {{ $facture->user?->name ?? 'Client' }}</div>
                        </div>
                        <div class="text-xs text-slate-500">{{ number_format($facture->total_ttc, 2, ',', ' ') }} EUR</div>
                    </div>
                @empty
                    <div class="text-slate-500 text-sm">Aucune facture recente.</div>
                @endforelse
            </div>
        </div>
    </div>
</x-app-layout>
