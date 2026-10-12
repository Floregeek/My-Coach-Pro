<x-public-layout :title="'Coach - My Coach Pro'">
    <div class="bg-white rounded-3xl border border-slate-100 p-8 shadow-sm">
        <div class="flex flex-col md:flex-row gap-6 items-start">
            <div class="h-20 w-20 rounded-3xl bg-indigo-600 text-white flex items-center justify-center text-3xl font-bold">
                {{ strtoupper(substr($coach->name, 0, 1)) }}
            </div>
            <div class="flex-1">
                <h1 class="text-3xl font-extrabold mb-2">{{ $coach->name }}</h1>
                <p class="text-slate-600 mb-4">Coach sportif - accompagnement personnalise et suivi complet.</p>
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 text-sm text-slate-600">
                    <div class="bg-slate-50 rounded-2xl p-4">
                        <p class="font-semibold text-slate-800">Specialites</p>
                        <p>Force, remise en forme, cardio.</p>
                    </div>
                    <div class="bg-slate-50 rounded-2xl p-4">
                        <p class="font-semibold text-slate-800">Disponibilites</p>
                        <p>Sur rendez-vous.</p>
                    </div>
                </div>
                <div class="mt-6 flex flex-wrap gap-3">
                    <a href="{{ route('prospect.contact', ['coach' => $coach->id]) }}" class="bg-indigo-600 text-white px-5 py-3 rounded-2xl text-sm font-bold">Contacter ce coach</a>
                    <a href="{{ route('prospect.index') }}" class="text-indigo-600 text-sm font-semibold">Retour aux coachs</a>
                </div>
            </div>
        </div>
    </div>
</x-public-layout>
