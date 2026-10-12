<x-app-layout>
    <div class="max-w-4xl mx-auto py-12 px-4 sm:px-6 lg:px-8">
        <div class="mb-8">
            <h1 class="text-3xl font-extrabold text-gray-900">Nouvel Exercice</h1>
            <p class="mt-2 text-sm text-gray-600">Enrichissez votre bibliothèque métier pour vos futurs programmes.</p>
        </div>

        <form action="{{ route('exercises.store') }}" method="POST" class="bg-white shadow-xl rounded-2xl overflow-hidden border border-gray-100">
            @csrf
            
            <div class="p-8 space-y-6">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    
                    <div class="md:col-span-2">
                        <label class="block text-sm font-semibold text-gray-700 mb-1">Nom de l'exercice</label>
                        <input type="text" name="Nom" required placeholder="Ex: Squat Gobelet, Burpees, Tirage élastique..." 
                               class="w-full rounded-xl border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 transition">
                    </div>

                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-1">Catégorie</label>
                        <select name="Categorie" required class="w-full rounded-xl border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                            <option value="Renforcement Musculaire">Renforcement Musculaire</option>
                            <option value="Cardio & Endurance">Cardio & Endurance</option>
                            <option value="Mobilité & Souplesse">Mobilité & Souplesse</option>
                            <option value="Rééquilibrage / Posture">Rééquilibrage / Posture</option>
                            <option value="Explosivité & Force">Explosivité & Force</option>
                            <option value="Récupération Active">Récupération Active</option>
                        </select>
                    </div>

                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-1">Niveau requis</label>
                        <select name="Niveau" required class="w-full rounded-xl border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                            <option value="Débutant">Débutant (Sans matériel / Simple)</option>
                            <option value="Intermédiaire">Intermédiaire (Technique modérée)</option>
                            <option value="Avancé">Avancé (Charge lourde / Explosif)</option>
                        </select>
                    </div>

                    <div class="md:col-span-2">
                        <label class="block text-sm font-semibold text-gray-700 mb-1">Équipement (Optionnel)</label>
                        <input type="text" name="Equipement" placeholder="Ex: Haltères, Élastique, Kettlebell, Poids du corps..." 
                               class="w-full rounded-xl border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                    </div>

                    <div class="md:col-span-2">
                    <label class="block text-sm font-semibold text-gray-700 mb-1">Lien de la vidéo (YouTube, Vimeo, etc.)</label>
                    <div class="mt-1 flex rounded-xl shadow-sm">
                        <span class="inline-flex items-center px-3 rounded-l-xl border border-r-0 border-gray-300 bg-gray-50 text-gray-500 text-sm">
                            https://
                        </span>
                        <input type="text" name="Media_url" placeholder="www.youtube.com/watch?v=..." 
                            class="flex-1 block w-full rounded-none rounded-r-xl border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 transition">
                    </div>
                    <p class="mt-1 text-xs text-gray-500 italic">Copiez-collez l'URL de votre vidéo pour que le client puisse voir le mouvement.</p>
                    </div>

                    <div class="md:col-span-2">
                        <label class="block text-sm font-semibold text-gray-700 mb-1">Description (Résumé pour le client)</label>
                        <input type="text" name="Description" required placeholder="Ex: Un exercice complet pour travailler les jambes et le cardio." 
                               class="w-full rounded-xl border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                    </div>

                    <div class="md:col-span-2">
                        <label class="block text-sm font-semibold text-gray-700 mb-1">Consignes techniques & Sécurité</label>
                        <textarea name="Consignes" rows="5" required placeholder="1. Garder le dos droit&#10;2. Descendre les fesses en arrière&#10;3. Inspirer à la descente..." 
                                  class="w-full rounded-xl border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"></textarea>
                    </div>
                </div>
            </div>

            <div class="px-8 py-6 bg-gray-50 border-t border-gray-100 flex justify-end items-center space-x-6">
            <a href="{{ route('exercises.index') }}" class="text-sm font-medium text-gray-600 hover:text-gray-900 transition">
                Annuler
            </a>
            <button type="submit" class="inline-flex items-center px-6 py-3 border border-transparent text-base font-bold rounded-xl shadow-lg text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition-all transform hover:scale-105">
                💾 Enregistrer l'exercice
            </button>
            </div>
        </form>
    </div>
</x-app-layout>