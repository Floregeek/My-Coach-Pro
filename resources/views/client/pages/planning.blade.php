<x-client-layout :pageTitle="'Planning'">
    <div class="space-y-6">
        <div class="rounded-3xl border border-slate-200 bg-white p-6 shadow-sm">
            <h1 class="text-3xl font-extrabold text-slate-900">Mon planning</h1>
            <p class="mt-2 text-slate-500">Visualisez vos seances reservees dans un agenda proche de celui du coach.</p>
        </div>

        <div class="rounded-3xl border border-slate-200 bg-white p-6 shadow-sm">
            <div id="client-calendar"></div>
        </div>

        @if($seances->isEmpty())
            <div class="rounded-3xl border border-dashed border-slate-300 bg-white p-10 text-center shadow-sm">
                <div class="text-5xl">📅</div>
                <h2 class="mt-4 text-2xl font-bold text-slate-900">Aucune seance reservee</h2>
                <p class="mt-2 text-slate-500">Vous n'avez pas encore de reservation. Consultez le catalogue pour reserver votre prochaine seance.</p>
                <a href="{{ route('client.seances.index') }}" class="mt-6 inline-flex items-center justify-center rounded-2xl bg-indigo-600 px-6 py-3 font-bold text-white hover:bg-indigo-700">
                    Voir le catalogue
                </a>
            </div>
        @else
            <div class="grid gap-4">
                @foreach($seances as $seance)
                    <div class="rounded-3xl border border-slate-200 bg-white p-6 shadow-sm">
                        <div class="flex flex-col gap-4 md:flex-row md:items-start md:justify-between">
                            <div>
                                <div class="text-sm font-semibold uppercase tracking-wide text-indigo-600">
                                    {{ $seance->type === 'collective' ? 'Seance collective' : 'Seance individuelle' }}
                                </div>
                                <h2 class="mt-1 text-2xl font-extrabold text-slate-900">{{ $seance->titre }}</h2>
                                <p class="mt-2 text-slate-500">
                                    {{ \Carbon\Carbon::parse($seance->debut_a)->translatedFormat('l d F Y') }}
                                    de {{ \Carbon\Carbon::parse($seance->debut_a)->format('H:i') }}
                                    a {{ \Carbon\Carbon::parse($seance->fin_a)->format('H:i') }}
                                </p>
                            </div>

                            <div class="rounded-2xl bg-slate-50 px-4 py-3 text-sm font-semibold text-slate-600">
                                {{ $seance->max_participants }} participant{{ $seance->max_participants > 1 ? 's' : '' }} max
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </div>

    <script src="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.10/index.global.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const calendarEl = document.getElementById('client-calendar');

            if (!calendarEl) {
                return;
            }

            const calendar = new FullCalendar.Calendar(calendarEl, {
                initialView: 'timeGridWeek',
                locale: 'fr',
                headerToolbar: {
                    left: 'prev,next today',
                    center: 'title',
                    right: 'dayGridMonth,timeGridWeek,timeGridDay'
                },
                buttonText: {
                    today: 'Aujourd\'hui',
                    month: 'Mois',
                    week: 'Semaine',
                    day: 'Jour'
                },
                noEventsContent: 'Aucune seance reservee',
                allDayText: 'Toute la journee',
                height: 'auto',
                slotLabelFormat: {
                    hour: '2-digit',
                    minute: '2-digit',
                    omitZeroMinute: false,
                    meridiem: false,
                    hour12: false
                },
                events: @json($calendarEvents)
            });

            calendar.render();
        });
    </script>

    <style>
        .fc-event { cursor: default; }
    </style>
</x-client-layout>
