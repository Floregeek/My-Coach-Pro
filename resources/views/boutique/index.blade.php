<x-app-layout>
    {{-- PANIER EN HAUT À DROITE --}}
    <div class="fixed top-24 right-8 z-50">
        <a href="{{ route('panier.index') }}" class="bg-white p-4 rounded-2xl shadow-2xl flex items-center gap-3 hover:scale-105 transition border border-gray-100 group">
            <div class="relative">
                <svg class="w-7 h-7 text-gray-900 group-hover:text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"></path>
                </svg>

                {{-- CORRECTION : On compte les articles en base de données --}}
                @php 
                    $count = \App\Models\Panier::where('user_id', Auth::id())->sum('quantite'); 
                @endphp

                @if($count > 0)
                    <span class="absolute -top-2 -right-2 bg-red-600 text-white text-[10px] font-black px-1.5 py-0.5 rounded-full shadow-sm">
                        {{ $count }}
                    </span>
                @endif
            </div>
            <span class="font-bold text-gray-900 hidden md:block">Mon Panier</span>
        </a>
    </div>

    <div class="py-12 bg-gray-100 min-h-screen">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            {{-- En-tête --}}
            <div class="text-center mb-12">
                <h1 class="text-4xl font-black text-gray-900 uppercase tracking-tighter">
                    La Boutique <span class="text-indigo-600">My Coach Pro</span>
                </h1>
            </div>

            {{-- Barre de recherche --}}
            <div class="max-w-md mx-auto mb-10">
                <form action="{{ route('boutique.index') }}" method="GET" class="relative">
                    <input type="text" name="search" placeholder="Rechercher un produit..." 
                           class="w-full pl-10 pr-4 py-3 rounded-full border-none shadow-sm focus:ring-2 focus:ring-indigo-500"
                           value="{{ request('search') }}">
                    <div class="absolute left-3 top-3.5 text-gray-400">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                        </svg>
                    </div>
                </form>
            </div>

            {{-- Grille Produits --}}
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-8">
                @foreach($produits as $produit)
                <div class="bg-white rounded-3xl shadow-sm border border-gray-100 overflow-hidden flex flex-col h-full transition-all hover:shadow-xl group">
                    
                    {{-- Lien vers le détail --}}
                    <a href="{{ route('produit.show', $produit->id) }}" class="h-60 bg-gray-50 relative overflow-hidden block">
                        <img src="{{ asset($produit->image) }}" alt="{{ $produit->nom }}" class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-110">
                        <span class="absolute top-4 left-4 bg-white/90 backdrop-blur px-3 py-1 rounded-full text-[10px] font-bold text-indigo-600 uppercase">
                            {{ $produit->categorie }}
                        </span>
                    </a>

                    <div class="p-6 flex flex-col flex-grow text-center">
                        <a href="{{ route('produit.show', $produit->id) }}" class="hover:text-indigo-600 transition">
                            <h2 class="text-lg font-bold text-gray-900 mb-1">{{ $produit->nom }}</h2>
                        </a>
                        
                        <div class="mt-auto pt-4 border-t border-gray-50 flex flex-col items-center">
                            <div class="mb-3">
                                <span class="text-2xl font-black text-gray-900">{{ number_format($produit->prix, 2) }} €</span>
                                <p class="text-[9px] text-gray-400 font-bold uppercase tracking-widest">Stock : {{ $produit->stock }}</p>
                            </div>

                            {{-- BOUTON AJOUTER AU PANIER --}}
                            <form action="{{ route('panier.ajouter', $produit->id) }}" method="POST">
                                @csrf
                                @if($produit->stock > 0)
                                    <button type="submit" class="bg-indigo-600 hover:bg-gray-900 text-white text-[11px] font-bold py-2 px-6 rounded-full transition-all duration-300 shadow-md active:scale-95 uppercase tracking-wider flex items-center gap-2">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                                        </svg>
                                        Ajouter au panier
                                    </button>
                                @else
                                    <button type="button" disabled class="bg-gray-100 text-gray-400 text-[11px] font-bold py-2 px-6 rounded-full cursor-not-allowed italic">
                                        Épuisé
                                    </button>
                                @endif
                            </form>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</x-app-layout>