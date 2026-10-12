<x-app-layout>
    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                <div class="flex items-center justify-between mb-6">
                    <h2 class="text-2xl font-bold text-gray-800">Mes Conversations</h2>
                    <span class="bg-indigo-100 text-indigo-700 text-xs font-bold px-2.5 py-0.5 rounded-full">
                        {{ $users->count() }} contact(s)
                    </span>
                </div>
                
                <div id="contacts-list" class="divide-y divide-gray-100 border-t border-gray-100">
                    @forelse($users as $user)
                        <a href="{{ route('messages.show', $user->id) }}" class="group block p-4 hover:bg-indigo-50 transition-all duration-200">
                            <div class="flex items-center justify-between">
                                <div class="flex items-center">
                                    <div class="h-12 w-12 rounded-full bg-indigo-600 flex items-center justify-center text-white font-bold shadow-sm group-hover:scale-105 transition-transform">
                                        {{ strtoupper(substr($user->name, 0, 1)) }}
                                    </div>
                                    <div class="ml-4">
                                        <div class="flex items-center">
                                            <div class="text-sm font-semibold text-gray-900 group-hover:text-indigo-700">{{ $user->name }}</div>
                                            
                                            @if($user->unread_count > 0)
                                                <span class="ml-2 inline-flex items-center justify-center px-2 py-1 text-xs font-bold leading-none text-white bg-red-500 rounded-full animate-pulse">
                                                    {{ $user->unread_count }}
                                                </span>
                                            @endif
                                        </div>
                                        
                                        <div class="flex items-center text-xs text-gray-500">
                                            <span class="w-2 h-2 rounded-full bg-green-400 mr-1.5"></span>
                                            {{ ucfirst($user->role) }}
                                        </div>
                                    </div>
                                </div>
                                <div class="text-indigo-600 text-sm font-medium opacity-0 group-hover:opacity-100 transition-opacity">
                                    Discuter &rarr;
                                </div>
                            </div>
                        </a>
                    @empty
                        <div class="text-center py-12">
                            <p class="text-gray-500 italic">Aucun contact disponible pour le moment.</p>
                        </div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const contactsList = document.getElementById('contacts-list');

            async function fetchUpdates() {
                try {
                    const response = await fetch(window.location.href);
                    const html = await response.text();
                    const parser = new DOMParser();
                    const doc = parser.parseFromString(html, 'text/html');

                    // Mise à jour de la liste des contacts et des badges
                    const newContacts = doc.getElementById('contacts-list');
                    if (newContacts && contactsList && contactsList.innerHTML !== newContacts.innerHTML) {
                        contactsList.innerHTML = newContacts.innerHTML;
                    }
                } catch (e) { console.error("Erreur polling index"); }
            }

           
            setInterval(fetchUpdates, 4000);
        });
    </script>
</x-app-layout>