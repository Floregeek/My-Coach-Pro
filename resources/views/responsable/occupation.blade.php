<x-app-layout>
    <div class="bg-white rounded-3xl border border-slate-200 shadow-sm p-6">
        <h1 class="text-2xl font-extrabold text-slate-900">Suivi occupation</h1>
        <p class="text-slate-500 mb-6">Salle: {{ $salle->nom ?? 'Non definie' }}</p>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
            <div class="rounded-2xl border border-slate-200 p-4">
                <div class="text-sm text-slate-500">Seances</div>
                <div class="text-3xl font-extrabold text-slate-900">{{ $totalSeances }}</div>
            </div>
            <div class="rounded-2xl border border-slate-200 p-4">
                <div class="text-sm text-slate-500">Reservations</div>
                <div class="text-3xl font-extrabold text-slate-900">{{ $totalReservations }}</div>
            </div>
            <div class="rounded-2xl border border-slate-200 p-4">
                <div class="text-sm text-slate-500">Taux de remplissage</div>
                <div class="text-3xl font-extrabold text-slate-900">{{ $tauxRemplissage }}%</div>
            </div>
        </div>

        <div class="mt-6">
            <h2 class="text-lg font-bold text-slate-900 mb-3">Detail des seances</h2>
            <div class="space-y-3">
                @forelse($seances as $seance)
                    <div class="border border-slate-200 rounded-2xl p-4 flex items-center justify-between">
                        <div>
                            <div class="font-semibold text-slate-900">{{ $seance->titre }}</div>
                            <div class="text-xs text-slate-500">{{ $seance->debut_a }}</div>
                        </div>
                        <div class="text-xs text-slate-500">
                            {{ $seance->reservations_count }} / {{ $seance->max_participants ?? 0 }} places
                        </div>
                    </div>
                @empty
                    <div class="text-slate-500 text-sm">Aucune seance pour l instant.</div>
                @endforelse
            </div>
        </div>
    </div>
</x-app-layout>
