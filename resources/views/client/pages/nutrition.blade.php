<x-client-layout :pageTitle="'Nutrition'">
    <div class="space-y-8">
        @if(session('success'))
            <div class="p-4 rounded-2xl bg-emerald-50 text-emerald-700 font-semibold">
                {{ session('success') }}
            </div>
        @endif
        @if(session('error'))
            <div class="p-4 rounded-2xl bg-red-50 text-red-700 font-semibold">
                {{ session('error') }}
            </div>
        @endif

        <div class="bg-white rounded-3xl border border-slate-200 shadow-sm p-6">
            <h1 class="text-2xl font-extrabold text-slate-900">Mes plans nutrition</h1>
            <p class="text-slate-500 mb-4">Plans nutrition achetes.</p>

            <div class="space-y-4">
                @php
                    $achatsList = $achats ?? collect();
                @endphp

                @forelse($achatsList as $achat)
                    <div class="border border-slate-200 rounded-2xl p-4 flex flex-col md:flex-row md:items-center md:justify-between gap-4">
                        <div>
                            <div class="font-bold text-lg text-slate-900">{{ $achat->plan->titre }}</div>
                            <div class="text-sm text-slate-500">
                                Achete le: {{ $achat->paid_at?->format('d/m/Y') ?? 'n/a' }}
                            </div>
                        </div>
                        <div class="text-right text-sm text-slate-500">
                            Prix TTC: {{ number_format($achat->prix_ttc, 2, ',', ' ') }} EUR
                        </div>
                    </div>
                @empty
                    <div class="text-slate-500 text-sm">Aucun plan achete pour le moment.</div>
                @endforelse
            </div>
        </div>

        <div class="bg-white rounded-3xl border border-slate-200 shadow-sm p-6">
            <h2 class="text-xl font-extrabold text-slate-900">Catalogue plans nutrition</h2>
            <p class="text-slate-500 mb-4">Choisissez un plan et payez via Stripe.</p>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                @forelse($plans as $plan)
                    @php
                        $dejaAchete = $achatsList->has($plan->id);
                    @endphp
                    <div class="border border-slate-200 rounded-2xl p-4">
                        <div class="font-bold text-lg text-slate-900">{{ $plan->titre }}</div>
                        <div class="text-sm text-slate-500">
                            Calories: {{ $plan->calories ?? 'n/a' }} | P: {{ $plan->proteines ?? 'n/a' }}g
                        </div>
                        <div class="text-sm text-slate-600 mt-2">{{ $plan->description }}</div>
                        <div class="mt-4 flex items-center justify-between">
                            <div class="font-bold text-slate-900">
                                {{ number_format($plan->prix_ttc, 2, ',', ' ') }} EUR
                            </div>
                            @if($dejaAchete)
                                <span class="text-xs font-bold text-emerald-600">Achete</span>
                            @else
                                <form method="POST" action="{{ route('client.nutrition.acheter', $plan->id) }}">
                                    @csrf
                                    <button class="bg-indigo-600 text-white px-4 py-2 rounded-xl text-xs font-bold">
                                        Acheter
                                    </button>
                                </form>
                            @endif
                        </div>
                    </div>
                @empty
                    <div class="text-slate-500 text-sm">Aucun plan nutrition disponible.</div>
                @endforelse
            </div>
        </div>
    </div>
</x-client-layout>
