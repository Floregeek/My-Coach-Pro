<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Réserver une séance') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @if(session('success'))
                <div class="mb-4 p-4 bg-green-100 text-green-700 rounded">{{ session('success') }}</div>
            @endif
            @if(session('error'))
                <div class="mb-4 p-4 bg-red-100 text-red-700 rounded">{{ session('error') }}</div>
            @endif

            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                @foreach($seances as $seance)
                    <div class="bg-white p-6 rounded-lg shadow border border-gray-100">
                        <h3 class="text-lg font-bold">{{ $seance->titre }}</h3>
                        <p class="text-sm text-gray-600">{{ \Carbon\Carbon::parse($seance->debut_a)->format('d/m/Y H:i') }}</p>
                        
                        <div class="mt-2 mb-3">
                            <span class="inline-flex items-center gap-2 px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                                <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" aria-hidden="true">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M3 10v4M7 8v8M17 8v8M21 10v4M7 12h10" />
                                </svg>
                                {{ $seance->exercises->count() }} exercices au programme
                            </span>
                        </div>

                        <p class="text-sm">Places : {{ $seance->clients->count() }} / {{ $seance->max_participants }}</p>

                        <form action="{{ route('seances.reserver', $seance->id) }}" method="POST" class="mt-4">
                            @csrf
                            <button type="submit" 
                                class="w-full bg-indigo-600 text-white py-2 rounded hover:bg-indigo-700 {{ $seance->clients->count() >= $seance->max_participants ? 'opacity-50 cursor-not-allowed' : '' }}"
                                {{ $seance->clients->count() >= $seance->max_participants ? 'disabled' : '' }}>
                                {{ $seance->clients->count() >= $seance->max_participants ? 'Complet' : 'Réserver' }}
                            </button>
                        </form>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</x-app-layout>
