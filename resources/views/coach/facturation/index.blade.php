<x-app-layout>
    <div class="py-10">
        <div class="max-w-6xl mx-auto sm:px-6 lg:px-8">
            @if(session('success'))
                <div class="mb-6 p-4 rounded-2xl bg-emerald-50 text-emerald-700 font-semibold">
                    {{ session('success') }}
                </div>
            @endif

            <div class="bg-white rounded-3xl border border-slate-200 shadow-sm p-6">
                <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-4 mb-6">
                    <div>
                        <h1 class="text-2xl font-extrabold text-slate-900">Facturation</h1>
                        <p class="text-slate-500">Factures clients et paiements.</p>
                    </div>
                    <a href="{{ route('coach.facturation.export') }}" class="bg-slate-900 text-white px-4 py-2 rounded-xl text-sm font-bold">
                        Exporter CSV
                    </a>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-6">
                    <div class="rounded-2xl border border-slate-200 p-4">
                        <div class="text-sm text-slate-500">Total HT</div>
                        <div class="text-2xl font-extrabold text-slate-900">{{ number_format($totalHt, 2, ',', ' ') }} EUR</div>
                    </div>
                    <div class="rounded-2xl border border-slate-200 p-4">
                        <div class="text-sm text-slate-500">TVA collectee</div>
                        <div class="text-2xl font-extrabold text-slate-900">{{ number_format($totalTva, 2, ',', ' ') }} EUR</div>
                    </div>
                    <div class="rounded-2xl border border-slate-200 p-4">
                        <div class="text-sm text-slate-500">Total TTC</div>
                        <div class="text-2xl font-extrabold text-slate-900">{{ number_format($totalTtc, 2, ',', ' ') }} EUR</div>
                    </div>
                </div>

                <div class="text-sm text-slate-500 mb-3">Factures payees : {{ $facturesPayees }}</div>

                <div class="space-y-3">
                    @forelse($factures as $facture)
                        <div class="border border-slate-200 rounded-2xl p-4 flex flex-col lg:flex-row lg:items-center lg:justify-between gap-4">
                            <div>
                                <div class="font-bold text-slate-900">{{ $facture->numero }}</div>
                                <div class="text-sm text-slate-500">
                                    {{ $facture->user?->name ?? 'Client' }} | {{ ucfirst(str_replace('_', ' ', $facture->type)) }}
                                </div>
                                <div class="text-xs text-slate-400">
                                    {{ $facture->issued_at?->format('d/m/Y') ?? 'n/a' }}
                                </div>
                            </div>
                            <div class="text-right">
                                <div class="text-sm text-slate-500">Total TTC</div>
                                <div class="text-lg font-extrabold text-slate-900">{{ number_format($facture->total_ttc, 2, ',', ' ') }} EUR</div>
                                <div class="text-xs {{ $facture->statut === 'paye' ? 'text-emerald-600' : 'text-amber-600' }}">
                                    {{ strtoupper($facture->statut) }}
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="text-slate-500 text-sm">Aucune facture pour le moment.</div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
