<x-app-layout>
    <div class="min-h-screen bg-[#F5F5F7] py-16">
        <div class="mx-auto max-w-5xl px-4">
            <nav class="mb-12 flex justify-center gap-8 text-[10px] font-black uppercase tracking-[0.2em] text-gray-400">
                <span class="flex items-center gap-2">
                    <svg class="h-3 w-3 text-green-500" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                    </svg>
                    Livraison
                </span>
                <span class="h-3 w-px bg-gray-200"></span>
                <span class="text-indigo-600">Paiement</span>
                <span class="h-3 w-px bg-gray-200"></span>
                <span class="opacity-50">Confirmation</span>
            </nav>

            <div class="grid gap-10 lg:grid-cols-2">
                <div class="rounded-[40px] border border-gray-100 bg-white p-10 shadow-sm">
                    <div class="mb-8 flex items-center justify-between">
                        <h2 class="text-3xl font-black tracking-tighter text-gray-900">Paiement Stripe.</h2>
                        <div class="rounded-full bg-indigo-50 px-3 py-1 text-xs font-bold uppercase tracking-widest text-indigo-600">
                            Test mode
                        </div>
                    </div>

                    <div class="space-y-6">
                        <div class="rounded-3xl border border-indigo-100 bg-indigo-50 p-6">
                            <h3 class="text-lg font-bold text-indigo-900">Paiement securise via Stripe Checkout</h3>
                            <p class="mt-2 text-sm text-indigo-800">
                                Vous allez etre redirige vers Stripe pour finaliser le paiement. Le panier sera valide uniquement apres confirmation du paiement.
                            </p>
                        </div>

                        <div class="rounded-3xl border border-gray-100 bg-gray-50 p-6">
                            <h3 class="text-sm font-black uppercase tracking-widest text-gray-400">Carte de test Stripe</h3>
                            <div class="mt-4 space-y-2 text-sm text-gray-700">
                                <p><span class="font-bold">Numero :</span> 4242 4242 4242 4242</p>
                                <p><span class="font-bold">Expiration :</span> n importe quelle date future</p>
                                <p><span class="font-bold">CVC :</span> n importe quels 3 chiffres</p>
                            </div>
                        </div>

                        @if(!$stripeKeyConfigured)
                            <div class="rounded-3xl border border-red-200 bg-red-50 p-6 text-red-800">
                                <h3 class="font-bold">Configuration Stripe manquante</h3>
                                <p class="mt-2 text-sm">
                                    Ajoutez <code>STRIPE_KEY</code> et <code>STRIPE_SECRET</code> dans le fichier <code>.env</code> avant de lancer un paiement.
                                </p>
                            </div>
                        @endif

                        <form action="{{ route('checkout.stripe') }}" method="POST">
                            @csrf
                            <input type="hidden" name="adresse" value="{{ $infos['adresse'] ?? '' }}">
                            <input type="hidden" name="ville" value="{{ $infos['ville'] ?? '' }}">
                            <input type="hidden" name="code_postal" value="{{ $infos['code_postal'] ?? '' }}">

                            <button
                                type="submit"
                                class="flex w-full items-center justify-center gap-3 rounded-2xl bg-indigo-600 py-5 text-xs font-black uppercase tracking-widest text-white shadow-xl shadow-indigo-100 transition-all hover:bg-gray-900 disabled:cursor-not-allowed disabled:bg-gray-300"
                                @disabled(!$stripeKeyConfigured)
                            >
                                <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path>
                                </svg>
                                Payer {{ number_format($total ?? 0, 2) }} EUR avec Stripe
                            </button>
                        </form>
                    </div>
                </div>

                <div class="rounded-[40px] border border-gray-100 bg-white p-8 shadow-sm">
                    <h3 class="mb-6 text-xl font-bold text-gray-900">Resume de commande</h3>

                    <div class="mb-6 space-y-4 border-b border-gray-100 pb-6">
                        @foreach($items as $item)
                            <div class="flex items-center gap-4">
                                <div class="h-16 w-16 overflow-hidden rounded-xl bg-gray-50">
                                    <img src="{{ asset($item->produit->image) }}" alt="{{ $item->produit->nom }}" class="h-full w-full object-cover">
                                </div>
                                <div class="flex-1">
                                    <div class="font-bold text-gray-900">{{ $item->produit->nom }}</div>
                                    <div class="text-xs font-semibold text-gray-400">Qte : {{ $item->quantite }}</div>
                                </div>
                                <div class="font-bold text-gray-900">
                                    {{ number_format($item->produit->prix * $item->quantite, 2) }} EUR
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <div class="space-y-3 border-b border-gray-100 pb-6 text-sm text-gray-500">
                        <div class="flex justify-between">
                            <span>Sous-total</span>
                            <span>{{ number_format($total, 2) }} EUR</span>
                        </div>
                        <div class="flex justify-between">
                            <span>Livraison</span>
                            <span class="font-bold uppercase text-green-500">Gratuit</span>
                        </div>
                    </div>

                    <div class="mt-6 flex items-end justify-between">
                        <span class="text-lg font-medium text-gray-900">Total</span>
                        <span class="text-4xl font-black tracking-tighter text-indigo-600">{{ number_format($total, 2) }} EUR</span>
                    </div>

                    <div class="mt-8 rounded-3xl bg-gray-50 p-6">
                        <h3 class="text-[10px] font-black uppercase tracking-widest text-gray-400">Livraison</h3>
                        <p class="mt-3 font-bold text-gray-900">
                            {{ Auth::user()->name }}<br>
                            {{ $infos['adresse'] ?? '---' }}<br>
                            {{ $infos['code_postal'] ?? '' }} {{ $infos['ville'] ?? '' }}
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
