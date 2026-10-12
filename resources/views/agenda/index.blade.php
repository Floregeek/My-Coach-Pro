<x-app-layout>
    <div class="min-h-screen bg-gray-50 p-6">
        <div class="mx-auto max-w-6xl">
            <div class="mb-8 flex items-center justify-between">
                <h1 class="text-3xl font-bold text-gray-800">Mon agenda coach</h1>
                <button
                    id="open-seance-modal"
                    type="button"
                    class="rounded-lg bg-indigo-600 px-6 py-2 font-semibold text-white shadow-md transition hover:bg-indigo-700"
                >
                    + Nouvelle seance
                </button>
            </div>

            @if (session('success'))
                <div class="mb-4 rounded-lg border border-emerald-200 bg-emerald-50 px-4 py-3 text-emerald-800">
                    {{ session('success') }}
                </div>
            @endif

            <div class="rounded-xl border border-gray-200 bg-white p-6 shadow-sm">
                <div id="calendar"></div>
            </div>

            <div id="seance-modal" class="fixed inset-0 z-50 hidden items-center justify-center bg-gray-900/50">
                <div id="seance-modal-panel" class="w-full max-w-md rounded-2xl bg-white p-8 shadow-2xl">
                    <h2 class="mb-6 text-2xl font-bold text-gray-800">Planifier une seance</h2>

                    <form action="{{ route('agenda.store') }}" method="POST">
                        @csrf

                        <div class="space-y-4">
                            <input
                                type="text"
                                name="titre"
                                placeholder="Titre"
                                required
                                class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                            >

                            <div class="grid grid-cols-2 gap-4">
                                <div>
                                    <label class="mb-1 block text-xs font-bold uppercase text-gray-500">Debut</label>
                                    <input
                                        id="seance-debut"
                                        type="datetime-local"
                                        name="debut_a"
                                        class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                                    >
                                </div>

                                <div>
                                    <label class="mb-1 block text-xs font-bold uppercase text-gray-500">Fin</label>
                                    <input
                                        id="seance-fin"
                                        type="datetime-local"
                                        name="fin_a"
                                        class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                                    >
                                </div>
                            </div>

                            <div>
                                <label class="mb-1 block text-xs font-bold uppercase text-gray-500">Participants max</label>
                                <input
                                    type="number"
                                    name="max_participants"
                                    value="1"
                                    min="1"
                                    class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                                >
                            </div>
                        </div>

                        <div class="mt-8 flex justify-end space-x-3">
                            <button id="close-seance-modal" type="button" class="font-medium text-gray-500 hover:text-gray-700">
                                Annuler
                            </button>
                            <button type="submit" class="rounded-lg bg-indigo-600 px-5 py-2 font-bold text-white shadow-sm transition hover:bg-indigo-700">
                                Enregistrer
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.10/index.global.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const calendarEl = document.getElementById('calendar');
            const modal = document.getElementById('seance-modal');
            const modalPanel = document.getElementById('seance-modal-panel');
            const openModalButton = document.getElementById('open-seance-modal');
            const closeModalButton = document.getElementById('close-seance-modal');
            const debutInput = document.getElementById('seance-debut');
            const finInput = document.getElementById('seance-fin');

            const openModal = function (start = '', end = '') {
                if (debutInput) {
                    debutInput.value = start;
                }

                if (finInput) {
                    finInput.value = end;
                }

                modal.classList.remove('hidden');
                modal.classList.add('flex');
            };

            const closeModal = function () {
                modal.classList.add('hidden');
                modal.classList.remove('flex');
            };

            if (openModalButton) {
                openModalButton.addEventListener('click', function () {
                    openModal();
                });
            }

            if (closeModalButton) {
                closeModalButton.addEventListener('click', function () {
                    closeModal();
                });
            }

            if (modal) {
                modal.addEventListener('click', function (event) {
                    if (!modalPanel.contains(event.target)) {
                        closeModal();
                    }
                });
            }

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
                noEventsContent: 'Aucune seance planifiee',
                allDayText: 'Toute la journee',
                height: 'auto',
                slotLabelFormat: {
                    hour: '2-digit',
                    minute: '2-digit',
                    omitZeroMinute: false,
                    meridiem: false,
                    hour12: false
                },
                events: @json($seances),
                selectable: true,
                select: function (info) {
                    openModal(info.startStr.slice(0, 16), info.endStr.slice(0, 16));
                }
            });

            calendar.render();
        });
    </script>

    <style>
        .fc-event { cursor: pointer; }
    </style>
</x-app-layout>
