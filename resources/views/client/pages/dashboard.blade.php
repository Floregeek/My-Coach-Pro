<x-client-layout :pageTitle="'Dashboard'">
    <!-- HERO -->
    <div class="rounded-3xl overflow-hidden bg-slate-900 text-white shadow-sm">
        <div class="p-6 sm:p-10 grid grid-cols-1 lg:grid-cols-3 gap-8 items-center">
            <div class="lg:col-span-2">
                <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-emerald-500/15 text-emerald-300 text-sm font-semibold">
                    Semaine 4 • Phase Hypertrophie
                </div>

                <h1 class="mt-4 text-4xl sm:text-5xl font-extrabold leading-tight">
                    Prêt à vous dépasser, <span class="text-emerald-400">{{ Auth::user()->name ?? 'Client' }}</span> ?
                </h1>

                <p class="mt-4 text-white/70 text-lg">
                    Votre séance <span class="text-white font-semibold">"Upper Body Power"</span> est programmée pour aujourd'hui à <span class="font-semibold">18h00</span>.
                </p>

                <div class="mt-6 flex flex-col sm:flex-row gap-3">
                    <a href="{{ url('/client/seances') }}"
                       class="inline-flex items-center justify-center gap-2 rounded-2xl bg-emerald-500 px-6 py-3 font-bold hover:bg-emerald-600">
                        <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M7 5l10 7-10 7V5z" />
                        </svg>
                        Commencer la séance
                    </a>
                    <a href="{{ url('/client/planning') }}"
                       class="inline-flex items-center justify-center gap-2 rounded-2xl bg-white/10 px-6 py-3 font-bold hover:bg-white/15">
                        Voir mon planning
                    </a>
                </div>
            </div>

            <!-- Progress ring (simple, sans lib) -->
            <div class="lg:justify-self-end">
                <div class="bg-white/5 border border-white/10 rounded-3xl p-6 w-full max-w-sm">
                    <div class="mx-auto h-40 w-40 rounded-full border-8 border-white/10 relative flex items-center justify-center">
                        <div class="absolute inset-0 rounded-full border-8 border-emerald-400"
                             style="clip-path: polygon(50% 50%, 100% 0, 100% 100%, 0 100%, 0 0); opacity:.35"></div>
                        <div class="text-center">
                            <div class="text-4xl font-extrabold">76%</div>
                            <div class="text-white/60 font-semibold mt-1">Objectif Hebdo</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- GRID -->
    <div class="mt-8 grid grid-cols-1 xl:grid-cols-3 gap-6">
        <!-- Planning -->
        <section class="xl:col-span-2 bg-white rounded-3xl border border-slate-200 shadow-sm">
            <div class="p-5 sm:p-6 flex items-center justify-between">
                <div class="flex items-center gap-3">
                    <svg class="h-5 w-5 text-slate-700" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M8 7V3m8 4V3M4 11h16M5 5h14a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V7a2 2 0 0 1 2-2z" />
                    </svg>
                    <h2 class="text-xl font-extrabold text-slate-900">Planning à venir</h2>
                </div>
                <a href="{{ url('/client/planning') }}" class="text-indigo-600 font-semibold hover:text-indigo-700">
                    Voir tout →
                </a>
            </div>

            <div class="px-5 sm:px-6 pb-6 space-y-4">
                @php
                    $items = [
                        ['day'=>'Aujourd\'hui','time'=>'18:00','title'=>'Upper Body Power','meta'=>'60 min • Musculation','status'=>'À faire'],
                        ['day'=>'Demain','time'=>'07:30','title'=>'Morning Cardio','meta'=>'45 min • Cardio','status'=>''],
                        ['day'=>'Jeudi','time'=>'19:00','title'=>'Yoga Recovery','meta'=>'60 min • Mobilité','status'=>''],
                    ];
                @endphp

                @foreach($items as $it)
                    <div class="flex items-center justify-between gap-4 p-4 rounded-2xl border border-slate-200 hover:bg-slate-50">
                        <div class="w-28 sm:w-40">
                            <div class="text-slate-500 font-semibold">{{ $it['day'] }}</div>
                            <div class="text-2xl font-extrabold text-slate-900">{{ $it['time'] }}</div>
                        </div>

                        <div class="flex-1 min-w-0">
                            <div class="text-lg font-extrabold text-slate-900 truncate">{{ $it['title'] }}</div>
                            <div class="text-slate-500 font-semibold">{{ $it['meta'] }}</div>
                        </div>

                        <div class="flex items-center gap-3">
                            @if($it['status'])
                                <span class="px-3 py-1 rounded-full text-sm font-bold bg-indigo-50 text-indigo-700">
                                    {{ $it['status'] }}
                                </span>
                            @endif
                            <svg class="h-5 w-5 text-slate-400" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M9 18l6-6-6-6" />
                            </svg>
                        </div>
                    </div>
                @endforeach
            </div>
        </section>

        <!-- Stats -->
        <aside class="bg-white rounded-3xl border border-slate-200 shadow-sm">
            <div class="p-5 sm:p-6">
                <h2 class="text-xl font-extrabold text-slate-900">Mes Statistiques</h2>

                <div class="mt-5 space-y-4">
                    <div class="p-4 rounded-2xl bg-slate-50 border border-slate-200 flex items-center gap-4">
                        <div class="h-12 w-12 rounded-2xl bg-orange-100 flex items-center justify-center">
                            <svg class="h-6 w-6 text-orange-600" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" aria-hidden="true">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M13 2L3 14h7l-1 8 10-12h-7l1-8z" />
                            </svg>
                        </div>
                        <div>
                            <div class="text-slate-500 font-semibold">Calories</div>
                            <div class="text-2xl font-extrabold text-slate-900">2,450 kcal</div>
                        </div>
                    </div>

                    <div class="p-4 rounded-2xl bg-slate-50 border border-slate-200 flex items-center gap-4">
                        <div class="h-12 w-12 rounded-2xl bg-blue-100 flex items-center justify-center">
                            <svg class="h-6 w-6 text-blue-600" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" aria-hidden="true">
                                <circle cx="12" cy="12" r="8" />
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 8v4l3 3" />
                            </svg>
                        </div>
                        <div>
                            <div class="text-slate-500 font-semibold">Durée totale</div>
                            <div class="text-2xl font-extrabold text-slate-900">4h 30m</div>
                        </div>
                    </div>

                    <div class="p-4 rounded-2xl bg-slate-50 border border-slate-200 flex items-center gap-4">
                        <div class="h-12 w-12 rounded-2xl bg-purple-100 flex items-center justify-center">
                            <svg class="h-6 w-6 text-purple-600" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" aria-hidden="true">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M3 10v4M7 8v8M17 8v8M21 10v4M7 12h10" />
                            </svg>
                        </div>
                        <div>
                            <div class="text-slate-500 font-semibold">Volume</div>
                            <div class="text-2xl font-extrabold text-slate-900">12,500 kg</div>
                        </div>
                    </div>
                </div>
            </div>
        </aside>
    </div>

    <!-- Perf + record -->
    <div class="mt-6 grid grid-cols-1 xl:grid-cols-3 gap-6">
        <section class="xl:col-span-2 bg-white rounded-3xl border border-slate-200 shadow-sm">
            <div class="p-5 sm:p-6">
                <div class="flex items-center gap-3">
                    <svg class="h-5 w-5 text-slate-700" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M4 20h16M7 16l4-4 3 3 4-6" />
                        <path stroke-linecap="round" stroke-linejoin="round" d="M7 16v4M11 12v8M14 15v5M18 9v11" />
                    </svg>
                    <div>
                        <h2 class="text-xl font-extrabold text-slate-900">Performance physique</h2>
                        <p class="text-slate-500 font-semibold">Votre charge de travail sur les 7 derniers jours.</p>
                    </div>
                </div>

                @php
                    $mockValues = [12, 18, 9, 14, 20, 7];
                    $maxValue = max($mockValues);
                @endphp
                <div class="mt-6 h-56 rounded-2xl bg-emerald-50 border border-emerald-100 p-4">
                    <div class="h-full flex items-end gap-3">
                        @foreach($mockValues as $value)
                            @php
                                $height = $maxValue > 0 ? intval(($value / $maxValue) * 100) : 0;
                            @endphp
                            <div class="flex-1 flex flex-col items-center justify-end h-full">
                                <div class="w-full rounded-xl bg-emerald-400/80" style="height: {{ $height }}%"></div>
                                <div class="text-xs text-emerald-700 mt-2 font-semibold">{{ $value }}</div>
                            </div>
                        @endforeach
                    </div>
                </div>

                <div class="mt-3 flex justify-between text-sm text-slate-500 font-semibold">
                    <span>Mar</span><span>Mer</span><span>Jeu</span><span>Ven</span><span>Sam</span><span>Dim</span>
                </div>
            </div>
        </section>

        <aside class="rounded-3xl bg-indigo-600 text-white p-6 shadow-sm">
            <div class="flex items-start gap-3">
                <div class="h-10 w-10 rounded-2xl bg-white/15 flex items-center justify-center">
                    <svg class="h-6 w-6" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" aria-hidden="true">
                        <circle cx="12" cy="7" r="4" />
                        <path stroke-linecap="round" stroke-linejoin="round" d="M8 11v9l4-2 4 2v-9" />
                    </svg>
                </div>
                <div>
                    <h3 class="text-2xl font-extrabold">Record Battu !</h3>
                    <p class="mt-2 text-white/90 font-semibold">
                        Vous avez battu votre record personnel au Squat hier : <span class="text-white font-extrabold">100kg</span>
                    </p>
                    <a href="#" class="mt-5 inline-flex items-center justify-center w-full rounded-2xl bg-white/15 px-4 py-3 font-bold hover:bg-white/20">
                        Voir l'historique
                    </a>
                </div>
            </div>
        </aside>
    </div>
</x-client-layout>
