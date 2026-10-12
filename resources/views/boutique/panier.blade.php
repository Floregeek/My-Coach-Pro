<x-app-layout>
    <div class="py-12 bg-[#F5F5F7] min-h-screen font-sans">
        <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
            
            <header class="mb-10">
                <h1 class="text-4xl font-black text-gray-900 tracking-tight">Panier.</h1>
                <p class="text-gray-500 mt-2 text-lg">Vos articles sont sauvegardés dans votre compte.</p>
            </header>

            @if(isset($items) && $items->count() > 0)
                <div class="grid grid-cols-1 lg:grid-cols-3 gap-12 items-start">
                    
                    {{-- COLONNE GAUCHE : LISTE DES ARTICLES --}}
                    <div class="lg:col-span-2 space-y-6">
                        @php $total = 0 @endphp
                        @foreach($items as $item)
                            @php $total += $item->produit->prix * $item->quantite @endphp
                            
                            <div class="bg-white rounded-3xl p-6 flex flex-col md:flex-row items-center gap-6 shadow-sm border border-transparent hover:border-indigo-100 transition-all">
                                {{-- Image --}}
                                <div class="w-32 h-32 flex-shrink-0 rounded-2xl overflow-hidden bg-gray-50">
                                    <img src="{{ asset($item->produit->image) }}" class="w-full h-full object-cover">
                                </div>

                                {{-- Infos --}}
                                <div class="flex-grow text-center md:text-left">
                                    <div class="flex flex-col md:flex-row md:justify-between md:items-start">
                                        <div>
                                            <h3 class="text-xl font-bold text-gray-900">{{ $item->produit->nom }}</h3>
                                            <p class="text-indigo-600 font-medium mt-1">{{ number_format($item->produit->prix, 2) }} € / unité</p>
                                        </div>
                                        <p class="text-xl font-black text-gray-900 mt-2 md:mt-0">
                                            {{ number_format($item->produit->prix * $item->quantite, 2) }} €
                                        </p>
                                    </div>

                                    {{-- Actions --}}
                                    <div class="mt-6 flex flex-col md:flex-row items-center justify-between border-t border-gray-50 pt-4 gap-4">
                                        
                                        {{-- SÉLECTEUR DE QUANTITÉ INTERACTIF --}}
                                        <div class="flex items-center gap-4">
                                            <span class="text-[10px] font-black uppercase text-gray-400 tracking-widest">Quantité</span>
                                            
                                            <div class="flex items-center bg-gray-50 rounded-2xl p-1 border border-gray-100 shadow-inner">
                                                {{-- Bouton MOINS --}}
                                                <form action="{{ route('panier.decrementer', $item->id) }}" method="POST">
                                                    @csrf
                                                    <button type="submit" class="w-8 h-8 flex items-center justify-center bg-white rounded-xl shadow-sm hover:bg-gray-100 transition text-gray-600 active:scale-90">
                                                        <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M20 12H4"></path></svg>
                                                    </button>
                                                </form>

                                                {{-- Affichage du chiffre --}}
                                                <span class="w-10 text-center font-black text-gray-900 text-sm">
                                                    {{ $item->quantite }}
                                                </span>

                                                {{-- Bouton PLUS --}}
                                                <form action="{{ route('panier.incrementer', $item->id) }}" method="POST">
                                                    @csrf
                                                    <button type="submit" class="w-8 h-8 flex items-center justify-center bg-white rounded-xl shadow-sm hover:bg-gray-100 transition text-gray-600 active:scale-90">
                                                        <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M12 4v16m8-8H4"></path></svg>
                                                    </button>
                                                </form>
                                            </div>
                                        </div>

                                        {{-- BOUTON SUPPRIMER --}}
                                        <form action="{{ route('panier.retirer', $item->id) }}" method="POST">
                                            @csrf
                                            <button type="submit" class="group flex items-center gap-2 text-[10px] font-black uppercase tracking-widest text-red-400 hover:text-red-600 transition">
                                                <div class="w-8 h-8 flex items-center justify-center rounded-xl bg-red-50 group-hover:bg-red-100 transition">
                                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" /></svg>
                                                </div>
                                                Supprimer
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    {{-- COLONNE DROITE : RÉCAPITULATIF FIXE --}}
                    <div class="lg:sticky lg:top-24">
                        <div class="bg-white rounded-[40px] p-8 shadow-sm border border-gray-100">
                            <h2 class="text-2xl font-bold text-gray-900 mb-6">Récapitulatif.</h2>
                            
                            <div class="space-y-4 text-gray-600 border-b border-gray-50 pb-6">
                                <div class="flex justify-between">
                                    <span>Sous-total</span>
                                    <span class="font-bold text-gray-900">{{ number_format($total, 2) }} €</span>
                                </div>
                                <div class="flex justify-between">
                                    <span>Livraison</span>
                                    <span class="text-green-500 font-bold uppercase text-xs">Gratuit</span>
                                </div>
                            </div>

                            <div class="mt-6 flex justify-between items-end mb-8">
                                <span class="text-lg font-medium text-gray-900">Total TTC</span>
                                <span class="text-4xl font-black text-indigo-600 tracking-tighter">{{ number_format($total, 2) }} €</span>
                            </div>

                            <a href="{{ route('checkout.index') }}" class="block w-full bg-indigo-600 text-white text-center font-bold py-5 rounded-2xl hover:bg-gray-900 transition-all shadow-xl shadow-indigo-100 uppercase tracking-widest text-xs active:scale-95">
                                Passer à la caisse
                            </a>

                            <p class="text-[10px] text-gray-400 text-center mt-6 uppercase font-bold tracking-widest italic">Paiement 100% sécurisé</p>
                        </div>
                        
                        <a href="{{ route('boutique.index') }}" class="block text-center mt-6 text-sm font-bold text-gray-400 hover:text-indigo-600 transition">
                            ← Retourner à la boutique
                        </a>
                    </div>

                </div>
            @else
                {{-- État vide inchangé --}}
                <div class="bg-white rounded-[40px] p-20 text-center shadow-sm">
                    <div class="bg-gray-50 w-24 h-24 rounded-full flex items-center justify-center mx-auto mb-6 text-gray-300">
                        <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z" /></svg>
                    </div>
                    <h2 class="text-2xl font-bold text-gray-900">Votre panier est vide.</h2>
                    <p class="text-gray-400 mt-2 mb-10">Il semble que vous n'ayez pas encore fait votre choix.</p>
                    <a href="{{ route('boutique.index') }}" class="bg-gray-900 text-white px-10 py-4 rounded-2xl font-bold hover:scale-105 transition">
                        Commencer mon shopping
                    </a>
                </div>
            @endif
        </div>
    </div>
</x-app-layout>