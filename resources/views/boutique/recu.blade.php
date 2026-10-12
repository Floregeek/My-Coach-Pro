<x-app-layout>
    <div class="py-12 bg-[#F5F5F7] min-h-screen">
        <div class="max-w-2xl mx-auto p-10 bg-white border-2 border-gray-100 rounded-[40px] shadow-2xl">
            
            {{-- En-tête Succès --}}
            <div class="text-center mb-10">
                <div class="bg-green-100 w-16 h-16 rounded-full flex items-center justify-center mx-auto mb-4">
                    <svg class="w-8 h-8 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path>
                    </svg>
                </div>
                <h1 class="text-3xl font-black uppercase tracking-tighter text-gray-900">Paiement Accepté.</h1>
                <p class="text-gray-400">Merci pour votre commande chez My Coach Pro.</p>
            </div>

            {{-- Détails de Livraison --}}
            <div class="space-y-4 mb-10 border-b border-dashed border-gray-200 pb-10">
                <h3 class="text-[10px] font-black uppercase text-gray-400 tracking-widest">Détails de livraison</h3>
                <p class="text-gray-900 font-bold leading-relaxed">
                    {{ Auth::user()->name }}<br>
                    {{ $infos['adresse'] ?? 'Adresse non spécifiée' }}<br>
                    {{ $infos['code_postal'] ?? '' }} {{ $infos['ville'] ?? '' }}
                </p>
            </div>

            {{-- Liste des Produits --}}
            <table class="w-full mb-10">
                <tbody>
                    @foreach($items as $item)
                    <tr class="border-b border-gray-50">
                        {{-- CORRECTION : Accès via l'objet et sa relation produit --}}
                        <td class="py-4 text-gray-600 font-medium">
                            <span class="text-indigo-600 font-black">{{ $item->quantite }}x</span> 
                            {{ $item->produit->nom }}
                        </td>
                        <td class="py-4 text-right font-bold text-gray-900">
                            {{ number_format($item->produit->prix * $item->quantite, 2) }} €
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>

            {{-- Total Final --}}
            <div class="flex justify-between items-center bg-gray-50 p-6 rounded-3xl">
                <span class="font-black uppercase text-[10px] tracking-[0.2em] text-gray-400">Total Payé</span>
                <span class="text-3xl font-black text-indigo-600 tracking-tighter">
                    {{-- Calcul sur la collection d'objets --}}
                    {{ number_format($items->sum(fn($i) => $i->produit->prix * $i->quantite), 2) }} €
                </span>
            </div>

            {{-- Actions --}}
            <div class="mt-10 space-y-4">
                <button onclick="window.print()" class="w-full flex items-center justify-center gap-2 text-xs font-black text-gray-400 hover:text-indigo-600 transition uppercase tracking-widest">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z"></path></svg>
                    Imprimer mon reçu
                </button>

                <a href="{{ route('boutique.index') }}" class="block w-full text-center bg-gray-900 text-white font-bold py-4 rounded-2xl hover:bg-indigo-600 transition shadow-lg">
                    Retourner à la boutique
                </a>
            </div>
        </div>
    </div>
</x-app-layout>