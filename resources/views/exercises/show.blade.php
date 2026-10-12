<x-app-layout>
    <div class="max-w-5xl mx-auto py-12 px-4">
        <div class="mb-6">
            <a href="{{ route('exercises.index') }}" class="inline-flex items-center gap-2 text-indigo-600 hover:text-indigo-800 font-bold">
                <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 18l-6-6 6-6" />
                </svg>
                Retour au catalogue
            </a>
        </div>

        <div class="bg-white shadow-2xl rounded-3xl overflow-hidden border border-gray-100">
            <div class="grid grid-cols-1 md:grid-cols-2">
                <div class="bg-black flex items-center justify-center min-h-[300px]">
                    @if($exercise->Media_url)
                        {{-- Un simple lecteur si c'est un lien YouTube --}}
                        <p class="text-white text-sm p-4">Vidéo disponible : <a href="{{ $exercise->Media_url }}" target="_blank" class="underline text-blue-400">Cliquez pour voir</a></p>
                    @else
                        <div class="text-gray-500 text-center p-10">
                            <svg class="h-12 w-12 mx-auto" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" aria-hidden="true">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M3 10v4M7 8v8M17 8v8M21 10v4M7 12h10" />
                            </svg>
                            <p class="mt-2 text-sm italic">Aucune vidéo enregistrée</p>
                        </div>
                    @endif
                </div>

                <div class="p-10">
                    <div class="flex items-center space-x-2 mb-4">
                        <span class="px-3 py-1 bg-indigo-100 text-indigo-700 text-xs font-black rounded-full uppercase">{{ $exercise->Categorie }}</span>
                        <span class="px-3 py-1 bg-gray-100 text-gray-700 text-xs font-bold rounded-full uppercase">{{ $exercise->Niveau }}</span>
                    </div>

                    <h1 class="text-4xl font-extrabold text-gray-900 mb-4">{{ $exercise->Nom }}</h1>
                    <p class="text-gray-600 text-lg mb-6 leading-relaxed">{{ $exercise->Description }}</p>

                    <div class="p-4 bg-gray-50 rounded-xl border-l-4 border-indigo-500">
                        <h3 class="font-bold text-gray-900 mb-2">Matériel nécessaire :</h3>
                        <p class="text-gray-700">{{ $exercise->Equipement ?? 'Aucun matériel (Poids du corps)' }}</p>
                    </div>
                </div>
            </div>

            <div class="p-10 border-t border-gray-100 bg-white">
                <h3 class="text-2xl font-bold text-gray-900 mb-6">Consignes de sécurité & Exécution</h3>
                <div class="prose max-w-none text-gray-700 whitespace-pre-line">
                    {{ $exercise->Consignes }}
                </div>
            </div>

            <div class="px-10 py-6 bg-gray-50 flex justify-end space-x-4">
                <a href="{{ route('exercises.edit', $exercise->id) }}" class="bg-yellow-400 text-black px-6 py-2 rounded-xl font-bold hover:bg-yellow-500 transition">Modifier</a>
                <form action="{{ route('exercises.destroy', $exercise->id) }}" method="POST" onsubmit="return confirm('Supprimer cet exercice ?');">
                    @csrf @method('DELETE')
                    <button type="submit" class="bg-red-600 text-white px-6 py-2 rounded-xl font-bold hover:bg-red-700 transition">Supprimer</button>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
