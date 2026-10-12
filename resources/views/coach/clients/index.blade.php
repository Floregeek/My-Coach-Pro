<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            @if(session('success'))
                <div id="success-message" class="mb-6 p-4 bg-green-600 text-white font-bold rounded shadow-lg flex justify-between items-center transition-opacity duration-500">
                    <div class="flex items-center">
                        <svg class="w-6 h-6 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                        </svg>
                        {{ session('success') }}
                    </div>
                    <button onclick="document.getElementById('success-message').remove()" class="text-white hover:text-gray-200 text-2xl leading-none">
                        &times;
                    </button>
                </div>
            @endif

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                <div class="flex justify-between items-center mb-8 border-b pb-6">
                    <h2 class="text-2xl font-extrabold text-gray-900 tracking-tight">Repertoire des Clients</h2>
                    
                    <a href="{{ route('clients.create') }}" 
                       style="background-color: black; color: white; padding: 12px 24px; border-radius: 4px; font-weight: bold; text-decoration: none; display: inline-flex; align-items: center; transition: all 0.3s;"
                       onmouseover="this.style.backgroundColor='#333'" onmouseout="this.style.backgroundColor='black'">
                        <span class="mr-2 text-xl">+</span> INSCRIRE UN NOUVEAU CLIENT
                    </a>
                </div>

                <table class="w-full border-collapse">
                    <thead>
                        <tr class="bg-gray-50 border-b">
                            <th class="p-4 text-left font-bold text-gray-600 uppercase text-xs tracking-wider">Nom & Prenom</th>
                            <th class="p-4 text-left font-bold text-gray-600 uppercase text-xs tracking-wider">Niveau</th>
                            <th class="p-4 text-center font-bold text-gray-600 uppercase text-xs tracking-wider">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100">
                        @foreach($clients as $client)
                        <tr class="hover:bg-gray-50 transition-colors">
                            <td class="p-4 text-gray-700 font-semibold">{{ $client->Nom }} {{ $client->Prenom }}</td>
                            <td class="p-4">
                                @php
                                    $colorClass = match($client->Niveau) {
                                        'Debutant' => 'bg-green-100 text-green-800 border-green-200',
                                        'Intermediaire' => 'bg-blue-100 text-blue-800 border-blue-200',
                                        'Avance' => 'bg-purple-100 text-purple-800 border-purple-200',
                                        default => 'bg-gray-100 text-gray-800 border-gray-200'
                                    };
                                @endphp
                                <span class="px-3 py-1 border rounded-full text-xs font-black uppercase {{ $colorClass }}">
                                    {{ $client->Niveau }}
                                </span>
                            </td>
                            <td class="p-4 text-center">
                                <a href="{{ route('clients.show', $client->id) }}" 
                                   style="background-color: black; color: white; padding: 8px 16px; border-radius: 4px; text-decoration: none; font-size: 0.85rem; font-weight: bold;">
                                    VOIR LE DOSSIER
                                </a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const alert = document.getElementById('success-message');
            if (alert) {
                setTimeout(() => {
                    alert.style.opacity = '0';
                    setTimeout(() => alert.remove(), 500);
                }, 4000);
            }
        });
    </script>
</x-app-layout>
