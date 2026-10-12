<x-app-layout>
    <div class="bg-white rounded-3xl border border-slate-200 shadow-sm p-6">
        <h1 class="text-2xl font-extrabold text-slate-900">Gestion des coachs</h1>
        <p class="text-slate-500 mb-4">Salle: {{ $salle->nom ?? 'Non definie' }}</p>

        @if(session('success'))
            <div class="mb-4 p-3 rounded-2xl bg-emerald-50 text-emerald-700 font-semibold">
                {{ session('success') }}
            </div>
        @endif
        @if(session('error'))
            <div class="mb-4 p-3 rounded-2xl bg-red-50 text-red-700 font-semibold">
                {{ session('error') }}
            </div>
        @endif

        <form method="POST" action="{{ route('responsable.coachs.update') }}">
            @csrf
            <div class="space-y-3">
                @foreach($coachs as $coach)
                    @php
                        $countSeances = $stats->get($coach->id)?->total ?? 0;
                    @endphp
                    <label class="flex items-center justify-between gap-3 border border-slate-200 rounded-2xl p-3">
                        <div class="flex items-center gap-3">
                            <input type="checkbox" name="coachs[]" value="{{ $coach->id }}" @checked(in_array($coach->id, $affilies))>
                            <div>
                                <div class="font-semibold text-slate-900">{{ $coach->name }}</div>
                                <div class="text-xs text-slate-500">{{ $coach->email }}</div>
                            </div>
                        </div>
                        <div class="text-xs text-slate-500">{{ $countSeances }} seances</div>
                    </label>
                @endforeach
            </div>

            <button class="mt-4 bg-slate-900 text-white px-6 py-3 rounded-2xl font-bold text-sm">Enregistrer</button>
        </form>
    </div>
</x-app-layout>
