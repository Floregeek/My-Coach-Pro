<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Créer une nouvelle Séance') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                
                <form action="{{ route('coach.seances.store') }}" method="POST">
                    @csrf

                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700">Titre de la séance</label>
                        <input type="text" name="titre" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" required>
                    </div>

                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700">Description</label>
                        <textarea name="description" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm"></textarea>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Date et Heure de début</label>
                            <input type="datetime-local" name="debut_a" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" required>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Date et Heure de fin</label>
                            <input type="datetime-local" name="fin_a" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                        </div>
                    </div>

                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700">Nombre max de participants</label>
                        <input type="number" name="max_participants" min="1" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" required>
                    </div>

                <div class="mb-6">
                    <label class="block text-sm font-bold text-gray-700 mb-3">Sélectionner les exercices pour cette séance</label>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 bg-gray-50 p-4 rounded-lg border">
                        @foreach($exercises as $exercise)
                            <div class="flex items-center space-x-3 p-2 bg-white rounded border hover:shadow-sm">
                                <input type="checkbox" name="exercises[]" value="{{ $exercise->id }}" class="rounded text-indigo-600">
                                <div>
                                    <p class="text-sm font-bold text-gray-800">{{ $exercise->Nom }}</p>
                                    <p class="text-xs text-gray-500">{{ $exercise->Categorie }}</p>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>

                    <div class="flex justify-end">
                        <button type="submit" class="bg-indigo-600 text-white px-4 py-2 rounded-md hover:bg-indigo-700">
                            Enregistrer la séance
                        </button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</x-app-layout>