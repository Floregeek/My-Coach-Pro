<x-app-layout>
    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="flex flex-col h-[650px] bg-white shadow-xl sm:rounded-xl border border-gray-200 overflow-hidden">
                
                <div class="p-4 border-b bg-white flex items-center justify-between shadow-sm">
                    <div class="flex items-center">
                        <a href="{{ route('messages.index') }}" class="mr-4 text-gray-400 hover:text-indigo-600 transition">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                            </svg>
                        </a>
                        <div>
                            <div class="font-bold text-gray-800">{{ $user->name }}</div>
                            <div class="text-xs text-green-500 flex items-center">
                                <span class="w-1.5 h-1.5 rounded-full bg-green-500 mr-1"></span> En ligne
                            </div>
                        </div>
                    </div>
                </div>

                <div id="chat-box" class="flex-1 p-6 overflow-y-auto space-y-4 bg-slate-50">
                    @foreach($messages as $message)
                        <div class="flex {{ $message->sender_id == auth()->id() ? 'justify-end' : 'justify-start' }}">
                            <div class="max-w-[75%] px-4 py-2 rounded-2xl shadow-sm text-sm {{ $message->sender_id == auth()->id() ? 'bg-indigo-600 text-white rounded-tr-none' : 'bg-white text-gray-800 border border-gray-200 rounded-tl-none' }}">
                                {{ $message->content }}
                            </div>
                        </div>
                    @endforeach
                </div>

                <div class="p-4 border-t bg-white">
                    <form id="chat-form" class="flex gap-2">
                        @csrf
                        <input type="hidden" id="receiver_id" value="{{ $user->id }}">
                        <input type="text" id="message-input" placeholder="Ecrivez votre message..." class="flex-1 border-gray-200 focus:border-indigo-500 focus:ring-indigo-500 rounded-full px-4 text-sm" autocomplete="off">
                        <button type="submit" id="send-btn" class="bg-indigo-600 text-white px-6 py-2 rounded-full hover:bg-indigo-700 font-semibold text-sm transition-colors shadow-md disabled:bg-gray-400">
                            Envoyer
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const chatBox = document.getElementById('chat-box');
            const chatForm = document.getElementById('chat-form');
            const messageInput = document.getElementById('message-input');
            
            // On descend le scroll au chargement
            chatBox.scrollTop = chatBox.scrollHeight;

            // Fonction pour récupérer les messages et mettre à jour les badges
            async function fetchMessages() {
                try {
                    const response = await fetch(window.location.href); 
                    const html = await response.text();
                    
                    const parser = new DOMParser();
                    const doc = parser.parseFromString(html, 'text/html');

                    // 1. Rafraîchir la boîte de chat
                    const newChatBox = doc.getElementById('chat-box');
                    if (newChatBox && chatBox.innerHTML !== newChatBox.innerHTML) {
                        chatBox.innerHTML = newChatBox.innerHTML;
                        chatBox.scrollTop = chatBox.scrollHeight;
                    }

                    // 2. Rafraîchir la liste des contacts (et les badges individuels)
                    const newContacts = doc.getElementById('contacts-list');
                    const currentContacts = document.getElementById('contacts-list');
                    if (newContacts && currentContacts) {
                        currentContacts.innerHTML = newContacts.innerHTML;
                    }

                    // 3. Rafraîchir le badge global dans le menu
                    const newGlobalBadge = doc.getElementById('badge-global');
                    const currentGlobalBadge = document.getElementById('badge-global');
                    if (newGlobalBadge && currentGlobalBadge) {
                        currentGlobalBadge.innerHTML = newGlobalBadge.innerHTML;
                    }

                } catch (e) { console.error("Erreur polling"); }
            }

            // VÉRIFIER TOUTES LES 3 SECONDES
            setInterval(fetchMessages, 3000);

            // Envoi AJAX (ton code qui marche)
            chatForm.addEventListener('submit', async (e) => {
                e.preventDefault();
                const content = messageInput.value.trim();
                if (!content) return;
                
                const res = await fetch("{{ route('messages.store') }}", {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: JSON.stringify({
                        receiver_id: document.getElementById('receiver_id').value,
                        content: content
                    })
                });

                if (res.ok) {
                    messageInput.value = '';
                    fetchMessages(); 
                }
            });
        });
    </script>
</x-app-layout>