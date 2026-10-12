<x-app-layout>
    <div class="py-10">
        <div class="max-w-6xl mx-auto sm:px-6 lg:px-8">
            @if(session('success'))
                <div class="mb-6 p-4 rounded-2xl bg-emerald-50 text-emerald-700 font-semibold">
                    {{ session('success') }}
                </div>
            @endif

            <div class="bg-white rounded-3xl border border-slate-200 shadow-sm p-6">
                <div class="flex items-center justify-between mb-6">
                    <div>
                        <h1 class="text-2xl font-extrabold text-slate-900">Contrats clients</h1>
                        <p class="text-slate-500">Suivi des packs et abonnements.</p>
                    </div>
                    <a href="{{ route('coach.contrats.create') }}" class="bg-slate-900 text-white px-4 py-2 rounded-xl text-sm font-bold">
                        Nouveau contrat
                    </a>
                </div>

                <div class="space-y-4">
                    @forelse($contrats as $contrat)
                        <div class="border border-slate-200 rounded-2xl p-4 flex flex-col lg:flex-row lg:items-center lg:justify-between gap-4">
                            <div>
                                <div class="font-bold text-lg text-slate-900">
                                    {{ $contrat->client->name ?? 'Client' }} - {{ $contrat->offre->titre ?? 'Offre' }}
                                </div>
                                <div class="text-sm text-slate-500">
                                    Type: {{ $contrat->type }} |
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
                            <form method="POST" action="{{ route('coach.contrats.consume', $contrat->id) }}">
                                @csrf
                                <button class="bg-indigo-600 text-white px-4 py-2 rounded-xl text-xs font-bold">
                                    Consommer 1 seance
                                </button>
                            </form>
                        </div>
                    @empty
                        <div class="text-slate-500 text-sm">Aucun contrat pour le moment.</div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
