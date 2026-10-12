<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Détails de la séance : {{ $seance->titre }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                
                <div class="mb-6">
                    <h3 class="text-lg font-bold">Informations</h3>
                    <p><strong>Date :</strong> {{ \Carbon\Carbon::parse($seance->debut_a)->format('d/m/Y H:i') }}</p>
                    <p><strong>Capacité :</strong> {{ $seance->clients->count() }} / {{ $seance->max_participants }}</p>
                </div>

                <div class="mb-10 p-6 bg-indigo-50 rounded-xl border border-indigo-100">
                    <h3 class="text-lg font-bold text-indigo-900 mb-4 flex items-center">
                        <svg class="h-5 w-5 mr-2" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M3 10v4M7 8v8M17 8v8M21 10v4M7 12h10" />
                        </svg>
                        Programme technique de la séance
                    </h3>

                    @if($seance->exercises->isEmpty())
                        <p class="text-indigo-600 italic text-sm">Aucun exercice n'a été rattaché à cette séance.</p>
                    @else
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            @foreach($seance->exercises as $exercise)
                                <div class="flex items-center p-3 bg-white rounded-lg shadow-sm border border-indigo-200">
                                    <div class="h-8 w-8 bg-indigo-600 text-white rounded-full flex items-center justify-center font-bold text-xs">
                                        {{ $loop->iteration }}
                                    </div>
                                    <div class="ml-3">
                                        <h4 class="text-sm font-bold text-gray-900">{{ $exercise->Nom }}</h4>
                                        <p class="text-xs text-indigo-600">{{ $exercise->Categorie }}</p>
                                    </div>
                                    <div class="ml-auto">
                                        <a href="{{ route('exercises.show', $exercise->id) }}" class="text-xs text-indigo-500 hover:underline">
                                            Fiche technique
                                        </a>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @endif
                </div>

                <h3 class="text-lg font-bold mb-4">Liste des clients inscrits</h3>
                
                @if($seance->clients->isEmpty())
                    <p class="text-gray-500 italic">Aucune réservation pour le moment.</p>
                @else
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Nom</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Email</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Date d'inscription</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @foreach($seance->clients as $client)
                                <tr>
                                    <td class="px-6 py-4">{{ $client->name }}</td>
                                    <td class="px-6 py-4">{{ $client->email }}</td>
                                    <td class="px-6 py-4">{{ $client->pivot->created_at->format('d/m/Y H:i') }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @endif

                <div class="mt-8">
                    <a href="{{ route('coach.seances.index') }}" class="inline-flex items-center gap-2 text-blue-600 hover:underline font-bold">
                        <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15 18l-6-6 6-6" />
                        </svg>
                        Retour à la liste des séances
                    </a>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
