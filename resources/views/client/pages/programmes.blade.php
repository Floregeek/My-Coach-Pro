<x-client-layout :pageTitle="'Programmes'">
    <div class="space-y-8">
        @if(session('success'))
            <div class="p-4 rounded-2xl bg-emerald-50 text-emerald-700 font-semibold">
                {{ session('success') }}
            </div>
        @endif

        <div class="bg-white rounded-3xl border border-slate-200 shadow-sm p-6">
            <h1 class="text-2xl font-extrabold text-slate-900">Mes programmes</h1>
            <p class="text-slate-500 mb-4">Programmes auxquels vous etes inscrit.</p>

            <div class="space-y-4">
                @forelse($mesProgrammes as $inscription)
                    <div class="border border-slate-200 rounded-2xl p-4 flex flex-col md:flex-row md:items-center md:justify-between gap-4">
                        <div>
                            <div class="font-bold text-lg text-slate-900">{{ $inscription->programme->titre }}</div>
                            <div class="text-sm text-slate-500">
                                Statut: {{ $inscription->statut }} | Termine le: {{ $inscription->termine_le ?? 'n/a' }}
                            </div>
                        </div>
                        <div class="text-right text-sm text-slate-500">
                            Prix TTC: {{ number_format($inscription->programme->prix_ttc, 2, ',', ' ') }} EUR
                        </div>
                    </div>
                @empty
                    <div class="text-slate-500 text-sm">Aucun programme en cours.</div>
                @endforelse
            </div>
        </div>

        <div class="bg-white rounded-3xl border border-slate-200 shadow-sm p-6">
            <h2 class="text-xl font-extrabold text-slate-900">Catalogue programmes</h2>
            <p class="text-slate-500 mb-4">Choisissez un programme payant ou gratuit.</p>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                @forelse($programmes as $programme)
                    <div class="border border-slate-200 rounded-2xl p-4">
                        <div class="font-bold text-lg text-slate-900">{{ $programme->titre }}</div>
                        <div class="text-sm text-slate-500">
                            Duree: {{ $programme->duree_semaines }} semaines | {{ $programme->seances_par_semaine }} seances/semaine
                        </div>
                        <div class="text-sm text-slate-600 mt-2">{{ $programme->description }}</div>
                        <div class="mt-4 flex items-center justify-between">
                            <div class="font-bold text-slate-900">
                                {{ number_format($programme->prix_ttc, 2, ',', ' ') }} EUR
                            </div>
                            <form method="POST" action="{{ route('client.programmes.acheter', $programme->id) }}">
                                @csrf
                                <button class="bg-indigo-600 text-white px-4 py-2 rounded-xl text-xs font-bold">
                                    Acheter
                                </button>
                            </form>
                        </div>
                    </div>
                @empty
                    <div class="text-slate-500 text-sm">Aucun programme disponible.</div>
                @endforelse
            </div>
        </div>
    </div>
</x-client-layout>
