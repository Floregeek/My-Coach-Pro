<x-app-layout>
    <div class="py-16 bg-[#F5F5F7] min-h-screen">
        <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
            
            <header class="mb-12">
                <h1 class="text-4xl font-black text-gray-900 tracking-tighter">Finaliser la commande.</h1>
                <p class="text-gray-500 mt-2">Étape 1 sur 2 : Informations de livraison</p>
            </header>

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-12 items-start">
                
                {{-- COLONNE GAUCHE : FORMULAIRE --}}
                <div class="lg:col-span-2">
                    <form action="{{ route('checkout.paiement') }}" method="POST" class="bg-white p-10 rounded-[40px] shadow-sm border border-gray-100">
                        @csrf
                        
                        <div class="flex items-center gap-4 mb-8">
                            <span class="w-8 h-8 rounded-full bg-gray-900 text-white flex items-center justify-center font-bold text-sm">1</span>
                            <h2 class="text-2xl font-bold text-gray-900">Adresse de livraison</h2>
                        </div>

                        <div class="space-y-6">
                            <div>
                                <label class="block text-[10px] font-black uppercase text-gray-400 tracking-widest ml-1 mb-2">Adresse de résidence</label>
                                <input type="text" name="adresse" placeholder="123 Rue de la République" required 
                                    class="w-full bg-gray-50 border-none rounded-2xl py-4 px-6 focus:ring-2 focus:ring-indigo-500 transition-all placeholder:text-gray-300">
                            </div>

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div>
                                    <label class="block text-[10px] font-black uppercase text-gray-400 tracking-widest ml-1 mb-2">Ville</label>
                                    <input type="text" name="ville" placeholder="Paris" required 
                                        class="w-full bg-gray-50 border-none rounded-2xl py-4 px-6 focus:ring-2 focus:ring-indigo-500 transition-all placeholder:text-gray-300">
                                </div>
                                <div>
                                    <label class="block text-[10px] font-black uppercase text-gray-400 tracking-widest ml-1 mb-2">Code Postal</label>
                                    <input type="text" name="code_postal" placeholder="75000" required 
                                        class="w-full bg-gray-50 border-none rounded-2xl py-4 px-6 focus:ring-2 focus:ring-indigo-500 transition-all placeholder:text-gray-300">
                                </div>
                            </div>

                            <div class="pt-8">
                                <button type="submit" class="w-full bg-indigo-600 text-white font-bold py-5 rounded-2xl hover:bg-gray-900 transition-all shadow-xl shadow-indigo-100 uppercase tracking-widest text-xs">
                                    Continuer vers le paiement
                                </button>
                            </div>
                        </div>
                    </form>
                </div>

                {{-- COLONNE DROITE : RÉCAPITULATIF (STICKY) --}}
                <div class="lg:sticky lg:top-24">
                    <div class="bg-white rounded-[40px] p-8 shadow-sm border border-gray-100">
                        <h3 class="text-xl font-bold text-gray-900 mb-6">Dans votre sac.</h3>
                        
                        <div class="space-y-4 max-h-60 overflow-y-auto pr-2 mb-6">
                            {{-- CORRECTION : On utilise $items (Collection de la DB) au lieu de session('panier') --}}
                            @foreach($items as $item)
                            <div class="flex items-center gap-4">
                                <div class="w-16 h-16 bg-gray-50 rounded-xl overflow-hidden flex-shrink-0">
                                    {{-- On accède aux propriétés via la relation ->produit --}}
                                    <img src="{{ asset($item->produit->image) }}" class="w-full h-full object-cover">
                                </div>
                                <div class="flex-grow">
                                    <h4 class="text-sm font-bold text-gray-900 line-clamp-1">{{ $item->produit->nom }}</h4>
                                    <p class="text-xs text-gray-400">Qté : {{ $item->quantite }}</p>
                                </div>
                                <span class="text-sm font-bold text-gray-900">{{ number_format($item->produit->prix * $item->quantite, 2) }}€</span>
                            </div>
                            @endforeach
                        </div>

                        <div class="border-t border-gray-50 pt-6 space-y-3">
                            <div class="flex justify-between text-sm text-gray-500">
                                <span>Sous-total</span>
                                {{-- Calcul via la collection $items --}}
                                <span>{{ number_format($items->sum(fn($i) => $i->produit->prix * $i->quantite), 2) }} €</span>
                            </div>
                            <div class="flex justify-between text-sm text-gray-500">
                                <span>Livraison</span>
                                <span class="text-green-500 font-bold uppercase text-[10px]">Gratuit</span>
                            </div>
                            <div class="flex justify-between text-xl font-black text-gray-900 pt-4 border-t border-gray-50">
                                <span>Total</span>
                                <span class="text-indigo-600 tracking-tighter">{{ number_format($items->sum(fn($i) => $i->produit->prix * $i->quantite), 2) }} €</span>
                            </div>
                        </div>
                    </div>
                    
                    <p class="text-center mt-6 text-[10px] text-gray-400 font-bold uppercase tracking-widest">Paiement sécurisé SSL</p>
                </div>

            </div>
        </div>
    </div>
</x-app-layout>