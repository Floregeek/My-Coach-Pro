<x-app-layout>
    <div class="max-w-4xl mx-auto py-12 px-4 sm:px-6 lg:px-8">
        <div class="mb-8">
            <h1 class="text-3xl font-extrabold text-gray-900">Modifier l'Exercice</h1>
            <p class="mt-2 text-sm text-gray-600">Mettez à jour les informations techniques de "{{ $exercise->Nom }}".</p>
        </div>

        <form action="{{ route('exercises.update', $exercise->id) }}" method="POST" class="bg-white shadow-xl rounded-2xl overflow-hidden border border-gray-100">
            @csrf
            @method('PUT')
            
            <div class="p-8 space-y-6">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    
                    <div class="md:col-span-2">
                        <label class="block text-sm font-semibold text-gray-700 mb-1">Nom de l'exercice</label>
                        <input type="text" name="Nom" value="{{ $exercise->Nom }}" required 
                               class="w-full rounded-xl border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 transition">
                    </div>

                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-1">Catégorie</label>
                        <select name="Categorie" required class="w-full rounded-xl border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                            @foreach(['Renforcement Musculaire', 'Cardio & Endurance', 'Mobilité & Souplesse', 'Rééquilibrage / Posture', 'Explosivité & Force', 'Récupération Active'] as $cat)
                                <option value="{{ $cat }}" {{ $exercise->Categorie == $cat ? 'selected' : '' }}>{{ $cat }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-1">Niveau requis</label>
                        <select name="Niveau" required class="w-full rounded-xl border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                            <option value="Débutant" {{ $exercise->Niveau == 'Débutant' ? 'selected' : '' }}>Débutant (Sans matériel / Simple)</option>
                            <option value="Intermédiaire" {{ $exercise->Niveau == 'Intermédiaire' ? 'selected' : '' }}>Intermédiaire (Technique modérée)</option>
                            <option value="Avancé" {{ $exercise->Niveau == 'Avancé' ? 'selected' : '' }}>Avancé (Charge lourde / Explosif)</option>
                        </select>
                    </div>

                    <div class="md:col-span-2">
                        <label class="block text-sm font-semibold text-gray-700 mb-1">Équipement (Optionnel)</label>
                        <input type="text" name="Equipement" value="{{ $exercise->Equipement }}" placeholder="Ex: Haltères, Élastique..." 
                               class="w-full rounded-xl border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                    </div>

                    <div class="md:col-span-2">
                        <label class="block text-sm font-semibold text-gray-700 mb-1">Lien de la vidéo (YouTube, etc.)</label>
                        <input type="text" name="Media_url" value="{{ $exercise->Media_url }}" placeholder="https://www.youtube.com/..." 
                               class="w-full rounded-xl border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                    </div>

                    <div class="md:col-span-2">
                        <label class="block text-sm font-semibold text-gray-700 mb-1">Description (Résumé)</label>
                        <input type="text" name="Description" value="{{ $exercise->Description }}" required 
                               class="w-full rounded-xl border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                    </div>

                    <div class="md:col-span-2">
                        <label class="block text-sm font-semibold text-gray-700 mb-1">Consignes techniques</label>
                        <textarea name="Consignes" rows="5" required 
                                  class="w-full rounded-xl border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">{{ $exercise->Consignes }}</textarea>
                    </div>
                </div>
            </div>

            <div class="px-8 py-6 bg-gray-50 border-t border-gray-100 flex justify-end items-center space-x-6">
                <a href="{{ route('exercises.index') }}" class="text-sm font-medium text-gray-600 hover:text-gray-900 transition">Annuler</a>
                <button type="submit" class="inline-flex items-center px-6 py-3 border border-transparent text-base font-bold rounded-xl shadow-lg text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition-all transform hover:scale-105">
                    ✅ Mettre à jour l'exercice
                </button>
            </div>
        </form>
    </div>
</x-app-layout>