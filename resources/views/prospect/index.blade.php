<x-public-layout :title="'Coachs - My Coach Pro'">
    <div class="flex flex-col gap-6">
        <div class="bg-white rounded-3xl border border-slate-100 p-8 shadow-sm">
            <h1 class="text-3xl font-extrabold mb-2">Nos coachs</h1>
            <p class="text-slate-600">Decouvrez les coachs disponibles et contactez celui qui correspond a vos objectifs.</p>
        </div>

        @if($coaches->isEmpty())
            <div class="bg-white rounded-3xl border border-slate-100 p-10 text-center text-slate-600">
                Aucun coach n'est disponible pour le moment.
            </div>
        @else
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach($coaches as $coach)
                    <div class="bg-white rounded-3xl border border-slate-100 p-6 shadow-sm flex flex-col">
                        <div class="flex items-center gap-3 mb-4">
                            <div class="h-12 w-12 rounded-2xl bg-indigo-600 text-white flex items-center justify-center font-bold">
                                {{ strtoupper(substr($coach->name, 0, 1)) }}
                            </div>
                            <div>
                                <p class="font-semibold text-lg">{{ $coach->name }}</p>
                                <p class="text-xs text-slate-500">Coach sportif</p>
                            </div>
                        </div>
                        <p class="text-sm text-slate-600 flex-1">
                            Specialites a definir. Programme personnalise, suivi et accompagnement.
                        </p>
                        <div class="mt-6 flex items-center gap-3">
                            <a href="{{ route('prospect.show', $coach->id) }}" class="text-indigo-600 text-sm font-semibold hover:text-indigo-700">Voir la fiche</a>
                            <a href="{{ route('prospect.contact', ['coach' => $coach->id]) }}" class="ml-auto bg-indigo-600 text-white px-4 py-2 rounded-xl text-xs font-bold">Contacter</a>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </div>
</x-public-layout>
