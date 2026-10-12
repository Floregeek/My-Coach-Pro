<x-app-layout>
    <div class="bg-white rounded-3xl border border-slate-200 shadow-sm p-6">
        <h1 class="text-2xl font-extrabold text-slate-900">Contrats salle - coach</h1>
        <p class="text-slate-500 mb-4">Commissions et partenariats entre salle et coachs.</p>

        @if(session('success'))
            <div class="mb-4 p-3 rounded-2xl bg-emerald-50 text-emerald-700 font-semibold">
                {{ session('success') }}
            </div>
        @endif

        <form method="POST" action="{{ route('responsable.contrats.store') }}" class="grid grid-cols-1 md:grid-cols-4 gap-4 mb-6">
            @csrf
            <select name="coach_id" class="rounded-2xl border border-slate-200 px-4 py-3">
                <option value="">Coach</option>
                @foreach($coachs as $coach)
                    <option value="{{ $coach->id }}">{{ $coach->name }}</option>
                @endforeach
            </select>
            <select name="salle_id" class="rounded-2xl border border-slate-200 px-4 py-3">
                <option value="">Salle</option>
                @foreach($salles as $salle)
                    <option value="{{ $salle->id }}">{{ $salle->nom }}</option>
                @endforeach
            </select>
            <input name="commission_rate" type="number" step="0.1" value="15" class="rounded-2xl border border-slate-200 px-4 py-3" placeholder="Commission %">
            <select name="type" class="rounded-2xl border border-slate-200 px-4 py-3">
                <option value="commission">Commission</option>
                <option value="location">Location</option>
            </select>
            <button class="bg-slate-900 text-white px-4 py-2 rounded-2xl text-sm font-bold">Creer contrat</button>
        </form>

        <div class="space-y-3">
            @forelse($contrats as $contrat)
                <div class="border border-slate-200 rounded-2xl p-4 flex items-center justify-between">
                    <div>
                        <div class="font-semibold text-slate-900">{{ $contrat->coach->name ?? 'Coach' }} - {{ $contrat->salle->nom ?? 'Salle' }}</div>
                        <div class="text-xs text-slate-500">Type: {{ $contrat->type }} | Commission: {{ $contrat->commission_rate }}%</div>
                    </div>
                    <div class="text-xs text-slate-500">{{ $contrat->statut }}</div>
                </div>
            @empty
                <div class="text-slate-500 text-sm">Aucun contrat pour le moment.</div>
            @endforelse
        </div>
    </div>
</x-app-layout>
