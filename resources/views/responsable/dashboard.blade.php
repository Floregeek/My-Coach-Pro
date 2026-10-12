<x-app-layout>
    <div class="space-y-6">
        <div class="bg-white rounded-3xl border border-slate-200 shadow-sm p-6">
            <h1 class="text-2xl font-extrabold text-slate-900">Dashboard Responsable</h1>
            <p class="text-slate-500">Salle: {{ $salle->nom ?? 'Non definie' }}</p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
            <div class="bg-white rounded-3xl border border-slate-200 shadow-sm p-6">
                <div class="text-sm text-slate-500">Coachs affilies</div>
                <div class="text-3xl font-extrabold text-slate-900">{{ $coachsCount }}</div>
            </div>
            <div class="bg-white rounded-3xl border border-slate-200 shadow-sm p-6">
                <div class="text-sm text-slate-500">Seances planifiees</div>
                <div class="text-3xl font-extrabold text-slate-900">{{ $seancesCount }}</div>
            </div>
            <div class="bg-white rounded-3xl border border-slate-200 shadow-sm p-6">
                <div class="text-sm text-slate-500">Reservations</div>
                <div class="text-3xl font-extrabold text-slate-900">{{ $reservationsCount }}</div>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-4">
            <div class="bg-white rounded-3xl border border-slate-200 shadow-sm p-6">
                <h2 class="text-lg font-bold text-slate-900 mb-4">Dernieres seances</h2>
                <div class="space-y-3">
                    @forelse($recentSeances as $seance)
                        <div class="border border-slate-200 rounded-2xl p-3 flex items-center justify-between">
                            <div>
                                <div class="font-semibold text-slate-900">{{ $seance->titre }}</div>
                                <div class="text-xs text-slate-500">{{ $seance->debut_a }}</div>
                            </div>
                            <div class="text-xs text-slate-500">{{ $seance->coach?->name ?? 'n/a' }}</div>
                        </div>
                    @empty
                        <div class="text-slate-500 text-sm">Aucune seance recente.</div>
                    @endforelse
                </div>
            </div>

            <div class="bg-white rounded-3xl border border-slate-200 shadow-sm p-6">
                <h2 class="text-lg font-bold text-slate-900 mb-4">Top coachs (seances)</h2>
                <div class="space-y-3">
                    @forelse($topCoachs as $row)
                        <div class="border border-slate-200 rounded-2xl p-3 flex items-center justify-between">
                            <div class="font-semibold text-slate-900">{{ $row->coach?->name ?? 'Coach' }}</div>
                            <div class="text-sm text-slate-500">{{ $row->total }} seances</div>
                        </div>
                    @empty
                        <div class="text-slate-500 text-sm">Aucune donnee.</div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
