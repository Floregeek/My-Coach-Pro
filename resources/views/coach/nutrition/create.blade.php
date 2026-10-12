<x-app-layout>
    <div class="py-10">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white rounded-3xl border border-slate-200 shadow-sm p-6">
                <h1 class="text-2xl font-extrabold text-slate-900 mb-2">Nouveau plan nutrition</h1>
                <p class="text-slate-500 mb-6">Definir un plan alimentaire.</p>

                <form method="POST" action="{{ route('coach.nutrition.store') }}" class="space-y-4">
                    @csrf
                    <div>
                        <label class="text-sm font-semibold text-slate-700">Titre</label>
                        <input name="titre" value="{{ old('titre') }}" class="mt-2 w-full rounded-2xl border border-slate-200 px-4 py-3" required>
                    </div>

                    <div>
                        <label class="text-sm font-semibold text-slate-700">Description</label>
                        <textarea name="description" rows="4" class="mt-2 w-full rounded-2xl border border-slate-200 px-4 py-3">{{ old('description') }}</textarea>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label class="text-sm font-semibold text-slate-700">Calories</label>
                            <input type="number" name="calories" value="{{ old('calories') }}" class="mt-2 w-full rounded-2xl border border-slate-200 px-4 py-3">
                        </div>
                        <div>
                            <label class="text-sm font-semibold text-slate-700">Proteines (g)</label>
                            <input type="number" name="proteines" value="{{ old('proteines') }}" class="mt-2 w-full rounded-2xl border border-slate-200 px-4 py-3">
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label class="text-sm font-semibold text-slate-700">Glucides (g)</label>
                            <input type="number" name="glucides" value="{{ old('glucides') }}" class="mt-2 w-full rounded-2xl border border-slate-200 px-4 py-3">
                        </div>
                        <div>
                            <label class="text-sm font-semibold text-slate-700">Lipides (g)</label>
                            <input type="number" name="lipides" value="{{ old('lipides') }}" class="mt-2 w-full rounded-2xl border border-slate-200 px-4 py-3">
                        </div>
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

                    <div class="flex items-center gap-3">
                        <button class="bg-slate-900 text-white px-6 py-3 rounded-2xl font-bold text-sm">Enregistrer</button>
                        <a href="{{ route('coach.nutrition.index') }}" class="text-slate-500 text-sm font-semibold">Annuler</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
