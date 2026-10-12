<x-client-layout :pageTitle="'Contrats'">
    <div class="bg-white rounded-3xl border border-slate-200 shadow-sm p-6">
        <div class="flex items-center justify-between mb-6">
            <div>
                <h1 class="text-2xl font-extrabold text-slate-900">Mes contrats</h1>
                <p class="text-slate-500">Packs et abonnements en cours.</p>
            </div>
        </div>

        <div class="space-y-4">
            @forelse($contrats as $contrat)
                <div class="border border-slate-200 rounded-2xl p-4 flex flex-col md:flex-row md:items-center md:justify-between gap-4">
                    <div>
                        <div class="font-bold text-lg text-slate-900">{{ $contrat->offre->titre ?? 'Offre' }}</div>
                        <div class="text-sm text-slate-500">
                            Coach: {{ $contrat->coach->name ?? 'Coach' }} |
                            Restantes: {{ $contrat->seances_restantes }} / {{ $contrat->total_seances }}
                        </div>
                        <div class="text-xs text-slate-400">
                            Expiration: {{ $contrat->date_expiration ? $contrat->date_expiration->format('d/m/Y') : 'n/a' }}
                        </div>
                    </div>
                    <div class="text-right">
                        <div class="text-sm text-slate-500">Prix TTC</div>
                        <div class="text-xl font-extrabold text-slate-900">{{ number_format($contrat->prix_ttc, 2, ',', ' ') }} EUR</div>
                        <div class="text-xs text-slate-500">Consommees: {{ $contrat->seances_consommees }}</div>
                    </div>
                </div>
            @empty
                <div class="text-slate-500 text-sm">Aucun contrat pour le moment.</div>
            @endforelse
        </div>
    </div>
</x-client-layout>
