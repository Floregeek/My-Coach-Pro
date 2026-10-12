<x-app-layout>
    <div class="max-w-7xl mx-auto py-12 px-4 sm:px-6 lg:px-8">
        
        <div class="flex justify-between items-center mb-10">
            <div>
                <h1 class="text-3xl font-extrabold text-gray-900">Catalogue d'Exercices</h1>
                <p class="text-gray-600">Gérez votre bibliothèque métier pour vos coachings.</p>
            </div>
            <a href="{{ route('exercises.create') }}" class="inline-flex items-center px-6 py-3 border border-transparent text-base font-bold rounded-xl shadow-lg text-white bg-black hover:bg-gray-900 transition-all transform hover:scale-105">
                ➕ Ajouter un exercice
            </a>
        </div>

        @if(session('success'))
            <div class="mb-6 p-4 bg-green-100 border-l-4 border-green-500 text-green-700 font-bold rounded-r-lg">
                {{ session('success') }}
            </div>
        @endif

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            @forelse($exercises as $exercise)
                <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden hover:shadow-md transition-shadow">
                    <div class="p-6">
                        <div class="flex justify-between items-start mb-4">
                            <span class="px-3 py-1 bg-indigo-50 text-indigo-700 text-xs font-bold rounded-full uppercase">
                                {{ $exercise->Categorie }}
                            </span>
                            <span class="text-xs font-medium text-gray-500 italic">
                                {{ $exercise->Niveau }}
                            </span>
                        </div>
                        
                        <h2 class="text-xl font-bold text-gray-900 mb-2">{{ $exercise->Nom }}</h2>
                        <p class="text-gray-600 text-sm mb-4 line-clamp-2">{{ $exercise->Description }}</p>
                        
                        <div class="pt-4 border-t border-gray-50 flex justify-between items-center">
                            <span class="text-xs text-gray-400">🛠️ {{ $exercise->Equipement ?? 'Sans matériel' }}</span>
                            <a href="{{ route('exercises.show', $exercise->id) }}" class="text-sm font-bold text-black hover:underline">Détails →</a>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-span-full bg-gray-50 rounded-2xl p-12 text-center border-2 border-dashed border-gray-200">
                    <p class="text-gray-500 font-medium">Aucun exercice dans votre catalogue pour le moment.</p>
                    <a href="{{ route('exercises.create') }}" class="mt-4 inline-block text-indigo-600 font-bold hover:text-indigo-500">
                        Créez votre premier exercice maintenant
                    </a>
                </div>
            @endforelse
        </div>
    </div>
</x-app-layout>