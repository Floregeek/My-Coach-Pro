<x-app-layout>
    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8 text-center">
            <div class="bg-white p-8 shadow-sm sm:rounded-lg border-t-4 border-blue-500">
                <h2 class="text-2xl font-bold mb-4">Mon Dossier Personnel</h2>
                <hr class="mb-6">
                
                <div class="text-left space-y-4">
                    <p><strong>Niveau :</strong> {{ $client->Niveau }}</p>
                    <p><strong>Objectifs :</strong> {{ $client->Objectifs }}</p>
                    <div class="p-4 bg-red-50 rounded">
                        <p class="font-bold text-red-700">Mes Informations de Santé :</p>
                        <p>{{ $client->Pathologies ?? 'Aucune information enregistrée par le coach.' }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>