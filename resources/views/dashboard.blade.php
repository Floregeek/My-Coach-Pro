<x-app-layout>
    <div class="py-8 bg-gray-50">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">

            <div class="flex flex-col gap-4 lg:flex-row lg:items-center lg:justify-between">
                <div>
                    <h1 class="text-3xl font-extrabold text-slate-900">
                        Bonjour, {{ Auth::user()->name ?? 'Coach' }}
                    </h1>
                    <p class="text-slate-500 mt-1">
                        Voici ce qui se passe aujourd'hui dans votre activite.
                    </p>
                </div>
                <div class="flex flex-col sm:flex-row gap-3">
                    <a href="{{ route('agenda.index') }}"
                       class="inline-flex items-center justify-center gap-2 rounded-xl border border-slate-200 bg-white px-4 py-2 font-semibold text-slate-800 hover:bg-slate-50 transition">
                        Voir Agenda
                    </a>

                    <a href="{{ route('coach.seances.create') }}"
                       class="inline-flex items-center justify-center gap-2 rounded-xl bg-indigo-600 px-4 py-2 font-semibold text-white hover:bg-indigo-700 transition">
                        Nouvelle Seance
                    </a>
                </div>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
                <div class="bg-white rounded-2xl p-5 shadow-sm border border-slate-100">
                    <div class="flex items-start justify-between">
                        <p class="text-sm text-slate-500">Chiffre d'affaires</p>
                        <span class="text-slate-400">CA</span>
                    </div>
                    <p class="mt-2 text-3xl font-extrabold text-slate-900">
                        {{ number_format($revenueTotal ?? 0, 2, ',', ' ') }} EUR
                    </p>
                    <p class="mt-1 text-sm text-slate-500">
                        {{ $commandesCount ?? 0 }} commande(s) enregistree(s)
                    </p>
                </div>

                <div class="bg-white rounded-2xl p-5 shadow-sm border border-slate-100">
                    <div class="flex items-start justify-between">
                        <p class="text-sm text-slate-500">Clients actifs</p>
                        <span class="text-slate-400">CL</span>
                    </div>
                    <p class="mt-2 text-3xl font-extrabold text-slate-900">
                        {{ $clientsCount ?? (isset($clients) ? $clients->count() : 0) }}
                    </p>
                    <p class="mt-1 text-sm text-slate-500">Clients suivis par le coach</p>
                </div>

                <div class="bg-white rounded-2xl p-5 shadow-sm border border-slate-100">
                    <div class="flex items-start justify-between">
                        <p class="text-sm text-slate-500">Seances a venir</p>
                        <span class="text-slate-400">SV</span>
                    </div>
                    <p class="mt-2 text-3xl font-extrabold text-slate-900">
                        {{ $seancesUpcoming ?? 0 }}
                    </p>
                    <p class="mt-1 text-sm text-slate-500">Sur les prochains jours</p>
                </div>

                <div class="rounded-2xl p-5 shadow-sm bg-indigo-600 text-white">
                    <div class="flex items-start justify-between">
                        <p class="text-sm opacity-90">Prochaine seance</p>
                        <span class="opacity-90">SE</span>
                    </div>
                    @if(isset($nextSeance) && $nextSeance)
                        <p class="mt-3 text-3xl font-extrabold">
                            {{ \Carbon\Carbon::parse($nextSeance->debut_a)->format('H:i') }}
                        </p>
                        <p class="mt-1 font-semibold">{{ $nextSeance->titre }}</p>
                        <p class="mt-1 text-sm opacity-90">
                            {{ \Carbon\Carbon::parse($nextSeance->debut_a)->diffForHumans() }}
                        </p>
                    @else
                        <p class="mt-3 text-3xl font-extrabold">--:--</p>
                        <p class="mt-1 font-semibold">Aucune seance</p>
                        <p class="mt-1 text-sm opacity-90">Planifiez une seance</p>
                    @endif
                </div>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                <div class="bg-white rounded-2xl p-6 shadow-sm border border-slate-100">
                    <div class="flex items-start justify-between mb-4">
                        <div>
                            <h2 class="text-lg font-bold text-slate-900">Apercu des revenus</h2>
                            <p class="text-sm text-slate-500">Performance financiere sur les 6 derniers mois.</p>
                        </div>
                        <span class="text-slate-400">GR</span>
                    </div>

                    @php
                        $series = $revenueSeries ?? collect([]);
                        $maxRevenue = $series->max('total') ?: 1;
                    @endphp

                    <div class="h-56 rounded-xl bg-gradient-to-b from-indigo-50 to-white border border-slate-100 px-4 py-6 flex items-end gap-3">
                        @forelse($series as $point)
                            @php
                                $height = (int) round(($point['total'] / $maxRevenue) * 160);
                            @endphp
                            <div class="flex-1 flex flex-col items-center gap-2">
                                <div class="w-full rounded-lg bg-indigo-500/80" style="height: {{ $height }}px;"></div>
                                <div class="text-[10px] font-semibold text-slate-500">{{ $point['label'] }}</div>
                            </div>
                        @empty
                            <div class="w-full h-full flex items-center justify-center text-slate-400 text-sm">
                                Aucun revenu sur les 6 derniers mois.
                            </div>
                        @endforelse
                    </div>
                </div>

                <div class="bg-white rounded-2xl p-6 shadow-sm border border-slate-100">
                    <div class="flex items-start justify-between mb-4">
                        <div>
                            <h2 class="text-lg font-bold text-slate-900">Seances du jour</h2>
                            <p class="text-sm text-slate-500">Exemple de planning journalier.</p>
                        </div>
                        <span class="text-slate-400">JD</span>
                    </div>

                    <div class="space-y-4">
                        @php
                            $todaySessions = [
                                ['time'=>'09:00','title'=>'Seance individuelle','meta'=>'Marie Laurent - Musculation','status'=>'Termine','badge'=>'bg-emerald-50 text-emerald-700'],
                                ['time'=>'11:30','title'=>'Coaching prive','meta'=>'Thomas Dubois - Cardio','status'=>'En cours','badge'=>'bg-indigo-50 text-indigo-700'],
                                ['time'=>'14:00','title'=>'CrossFit group','meta'=>'8 participants - Collectif','status'=>'A venir','badge'=>'bg-slate-100 text-slate-700'],
                                ['time'=>'16:30','title'=>'Bilan mensuel','meta'=>'Sophie Martin - Visio','status'=>'A venir','badge'=>'bg-slate-100 text-slate-700'],
                            ];
                        @endphp

                        @foreach($todaySessions as $s)
                            <div class="flex items-start justify-between gap-4">
                                <div class="w-16 text-slate-600 font-semibold">{{ $s['time'] }}</div>
                                <div class="flex-1">
                                    <div class="font-bold text-slate-900">{{ $s['title'] }}</div>
                                    <div class="text-sm text-slate-500">{{ $s['meta'] }}</div>
                                </div>
                                <span class="px-3 py-1 rounded-full text-xs font-semibold {{ $s['badge'] }}">
                                    {{ $s['status'] }}
                                </span>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>

            @isset($clients)
                <div class="bg-white rounded-2xl p-6 shadow-sm border border-slate-100">
                    <div class="flex items-center justify-between">
                        <h2 class="text-lg font-bold text-slate-900">Mes clients</h2>
                        <a href="{{ url('/coach/clients') }}" class="text-sm font-semibold text-indigo-600 hover:text-indigo-700">Voir tout</a>
                    </div>

                    <div class="mt-4 grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                        @foreach($clients->take(6) as $client)
                            @php
                                $initials = strtoupper(substr($client->Prenom ?? 'X', 0, 1) . substr($client->Nom ?? 'X', 0, 1));
                            @endphp
                            <div class="rounded-2xl border border-slate-100 p-4 hover:shadow-sm transition bg-slate-50">
                                <div class="flex items-center gap-3">
                                    <div class="h-10 w-10 rounded-full bg-indigo-100 text-indigo-700 flex items-center justify-center font-bold">
                                        {{ $initials }}
                                    </div>
                                    <div>
                                        <div class="font-bold text-slate-900">{{ $client->Prenom }} {{ $client->Nom }}</div>
                                        <div class="text-sm text-slate-500">{{ $client->Objectifs }}</div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endisset

        </div>
    </div>
</x-app-layout>
