<x-app-layout>
    <div class="py-12 bg-white min-h-screen">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            
            {{-- Fil d'ariane / Retour --}}
            <a href="{{ route('boutique.index') }}" class="text-sm font-bold text-gray-400 hover:text-indigo-600 transition flex items-center gap-2 mb-8">
                ← Retour à la boutique
            </a>

            <div class="lg:grid lg:grid-cols-2 lg:gap-x-16 items-start">
                {{-- Image du produit --}}
                <div class="rounded-[40px] overflow-hidden bg-gray-50 shadow-inner">
                    <img src="{{ asset($produit->image) }}" class="w-full h-[500px] object-cover">
                </div>

                {{-- Informations --}}
                <div class="mt-10 lg:mt-0">
                    <span class="text-indigo-600 font-black uppercase tracking-widest text-xs">{{ $produit->categorie }}</span>
                    <h1 class="text-5xl font-black text-gray-900 mt-2 tracking-tighter">{{ $produit->nom }}</h1>
                    
                    <div class="flex items-center gap-4 mt-4">
                        <span class="text-3xl font-black text-gray-900">{{ number_format($produit->prix, 2) }} €</span>
                        @if($produit->stock > 0)
                            <span class="text-green-500 text-xs font-bold uppercase bg-green-50 px-3 py-1 rounded-full">En Stock ({{ $produit->stock }})</span>
                        @else
                            <span class="text-red-500 text-xs font-bold uppercase bg-red-50 px-3 py-1 rounded-full">Épuisé</span>
                        @endif
                    </div>

                    <div class="mt-8 pt-8 border-t border-gray-100">
                        <h3 class="text-sm font-black uppercase text-gray-400 tracking-widest">Description</h3>
                        <p class="mt-4 text-gray-600 leading-relaxed text-lg">{{ $produit->description }}</p>
                    </div>

                    {{-- Bouton Panier --}}
                    <div class="mt-10">
                        <form action="{{ route('panier.ajouter', $produit->id) }}" method="POST">
                            @csrf
                            <button type="submit" @if($produit->stock <= 0) disabled @endif
                                class="w-full lg:w-auto bg-gray-900 text-white px-12 py-5 rounded-2xl font-black hover:bg-indigo-600 transition-all shadow-xl shadow-gray-200 uppercase tracking-widest text-sm active:scale-95 disabled:bg-gray-200">
                                {{ $produit->stock > 0 ? 'Ajouter au panier' : 'Indisponible' }}
                            </button>
                        </form>
                    </div>
                </div>
            </div>

            {{-- Section Avis --}}
            <div class="mt-24 border-t border-gray-100 pt-16">
                <h2 class="text-3xl font-black text-gray-900 tracking-tighter">Avis de la communauté My Coach Pro.</h2>
                <div class="mt-8 grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="bg-gray-50 p-8 rounded-3xl border border-transparent hover:border-indigo-100 transition">
                        <div class="flex text-yellow-400 mb-4 text-xs">★★★★★</div>
                        <p class="text-gray-700 font-medium leading-relaxed italic">"La qualité est au rendez-vous. Livraison rapide et produit conforme."</p>
                        <div class="mt-4 flex items-center gap-3">
                            <div class="w-8 h-8 rounded-full bg-indigo-200"></div>
                            <span class="text-sm font-bold text-gray-900">Thomas R.</span>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Produits Similaires --}}
            @if($similaires->count() > 0)
            <div class="mt-24">
                <h2 class="text-3xl font-black text-gray-900 tracking-tighter mb-10">Dans la même catégorie.</h2>
                <div class="grid grid-cols-2 md:grid-cols-4 gap-8">
                    @foreach($similaires as $item)
                        <a href="{{ route('produit.show', $item->id) }}" class="group">
                            <div class="aspect-square rounded-3xl overflow-hidden bg-gray-100 mb-4">
                                <img src="{{ asset($item->image) }}" class="w-full h-full object-cover group-hover:scale-110 transition duration-500">
                            </div>
                            <h3 class="font-bold text-gray-900 group-hover:text-indigo-600 transition">{{ $item->nom }}</h3>
                            <p class="text-gray-400 font-black text-sm">{{ $item->prix }} €</p>
                        </a>
                    @endforeach
                </div>
            </div>
            @endif

        </div>
    </div>
</x-app-layout>