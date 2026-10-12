<x-app-layout>
    <div class="py-10">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white rounded-3xl border border-slate-200 shadow-sm p-6">
                <h1 class="text-2xl font-extrabold text-slate-900 mb-2">Nouveau partenariat</h1>
                <p class="text-slate-500 mb-6">Co-traitance ou sous-traitance entre coachs.</p>

                <form method="POST" action="{{ route('coach.partenariats.store') }}" class="space-y-4">
                    @csrf
                    <div>
                        <label class="text-sm font-semibold text-slate-700">Coach partenaire</label>
                        <select name="partner_coach_id" class="mt-2 w-full rounded-2xl border border-slate-200 px-4 py-3" required>
                            <option value="">Choisir un coach</option>
                            @foreach($coachs as $coach)
                                <option value="{{ $coach->id }}">{{ $coach->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label class="text-sm font-semibold text-slate-700">Type</label>
                            <select name="type" class="mt-2 w-full rounded-2xl border border-slate-200 px-4 py-3" required>
                                <option value="co-traitance">Co-traitance</option>
                                <option value="sous-traitance">Sous-traitance</option>
                            </select>
                        </div>
                        <div>
                            <label class="text-sm font-semibold text-slate-700">Commission (%)</label>
                            <input type="number" step="0.1" name="commission_rate" value="20" class="mt-2 w-full rounded-2xl border border-slate-200 px-4 py-3" required>
                        </div>
                    </div>

                    <div class="flex items-center gap-3">
                        <button class="bg-slate-900 text-white px-6 py-3 rounded-2xl font-bold text-sm">Creer</button>
                        <a href="{{ route('coach.partenariats.index') }}" class="text-slate-500 text-sm font-semibold">Annuler</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
