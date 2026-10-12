<x-app-layout>
    <div class="space-y-6">
        <div class="bg-white rounded-3xl border border-slate-200 shadow-sm p-6">
            <h1 class="text-2xl font-extrabold text-slate-900">Planning salle</h1>
            <p class="text-slate-500">Gestion des seances en salle et attribution aux coachs.</p>
        </div>

        @if(session('success'))
            <div class="p-3 rounded-2xl bg-emerald-50 text-emerald-700 font-semibold">
                {{ session('success') }}
            </div>
        @endif
        @if(session('error'))
            <div class="p-3 rounded-2xl bg-red-50 text-red-700 font-semibold">
                {{ session('error') }}
            </div>
        @endif

        <div class="bg-white rounded-3xl border border-slate-200 shadow-sm p-6">
            <h2 class="text-lg font-bold text-slate-900 mb-4">Affecter une seance</h2>
            <form method="POST" action="{{ route('responsable.planning.affecter') }}" class="grid grid-cols-1 md:grid-cols-3 gap-4">
                @csrf
                <select name="seance_id" class="rounded-2xl border border-slate-200 px-4 py-3">
                    <option value="">Choisir une seance</option>
                    @foreach($seancesDisponibles as $seance)
                        <option value="{{ $seance->id }}">{{ $seance->titre }}</option>
                    @endforeach
                </select>
                <select name="coach_id" class="rounded-2xl border border-slate-200 px-4 py-3">
                    <option value="">Choisir un coach</option>
                    @foreach($coachs as $coach)
                        <option value="{{ $coach->id }}">{{ $coach->name }}</option>
                    @endforeach
                </select>
                <button class="bg-slate-900 text-white px-4 py-2 rounded-2xl text-sm font-bold">Affecter</button>
            </form>
        </div>

        <div class="bg-white rounded-3xl border border-slate-200 shadow-sm p-6">
            <h2 class="text-lg font-bold text-slate-900 mb-4">Seances de la salle</h2>
            <div class="space-y-3">
                @forelse($seances as $seance)
                    <div class="border border-slate-200 rounded-2xl p-4 flex items-center justify-between">
                        <div>
                            <div class="font-semibold text-slate-900">{{ $seance->titre }}</div>
                            <div class="text-xs text-slate-500">{{ $seance->debut_a }}</div>
                        </div>
                        <div class="text-xs text-slate-500">Coach: {{ $seance->coach?->name ?? 'n/a' }}</div>
                    </div>
                @empty
                    <div class="text-slate-500 text-sm">Aucune seance planifiee pour la salle.</div>
                @endforelse
            </div>
        </div>
    </div>
</x-app-layout>
