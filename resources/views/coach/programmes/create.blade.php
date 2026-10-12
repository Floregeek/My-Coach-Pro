<x-app-layout>
    <div class="py-10">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white rounded-3xl border border-slate-200 shadow-sm p-6">
                <h1 class="text-2xl font-extrabold text-slate-900 mb-2">Nouveau programme</h1>
                <p class="text-slate-500 mb-6">Creer un programme et definir la planification auto.</p>

                <form method="POST" action="{{ route('coach.programmes.store') }}" class="space-y-4">
                    @csrf
                    <div>
                        <label class="text-sm font-semibold text-slate-700">Titre</label>
                        <input name="titre" value="{{ old('titre') }}" class="mt-2 w-full rounded-2xl border border-slate-200 px-4 py-3" required>
                        @error('titre') <p class="text-xs text-red-500 mt-1">{{ $message }}</p> @enderror
                    </div>

                    <div>
                        <label class="text-sm font-semibold text-slate-700">Description</label>
                        <textarea name="description" rows="4" class="mt-2 w-full rounded-2xl border border-slate-200 px-4 py-3">{{ old('description') }}</textarea>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label class="text-sm font-semibold text-slate-700">Prix HT</label>
                            <input type="number" step="0.01" name="prix_ht" value="{{ old('prix_ht', 0) }}" class="mt-2 w-full rounded-2xl border border-slate-200 px-4 py-3" required>
                        </div>
                        <div>
                            <label class="text-sm font-semibold text-slate-700">TVA (%)</label>
                            <input type="number" step="0.01" name="tva" value="{{ old('tva', 20) }}" class="mt-2 w-full rounded-2xl border border-slate-200 px-4 py-3" required>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label class="text-sm font-semibold text-slate-700">Duree (semaines)</label>
                            <input type="number" name="duree_semaines" value="{{ old('duree_semaines', 4) }}" class="mt-2 w-full rounded-2xl border border-slate-200 px-4 py-3" required>
                        </div>
                        <div>
                            <label class="text-sm font-semibold text-slate-700">Seances par semaine</label>
                            <input type="number" name="seances_par_semaine" value="{{ old('seances_par_semaine', 2) }}" class="mt-2 w-full rounded-2xl border border-slate-200 px-4 py-3" required>
                        </div>
                    </div>

                    <div class="flex items-center gap-3">
                        <button class="bg-slate-900 text-white px-6 py-3 rounded-2xl font-bold text-sm">Enregistrer</button>
                        <a href="{{ route('coach.programmes.index') }}" class="text-slate-500 text-sm font-semibold">Annuler</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
