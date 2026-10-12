<x-app-layout>
    <div class="py-10">
        <div class="max-w-6xl mx-auto sm:px-6 lg:px-8">
            @if(session('success'))
                <div class="mb-6 p-4 rounded-2xl bg-emerald-50 text-emerald-700 font-semibold">
                    {{ session('success') }}
                </div>
            @endif

            <div class="bg-white rounded-3xl border border-slate-200 shadow-sm p-6">
                <div class="flex items-center justify-between mb-6">
                    <div>
                        <h1 class="text-2xl font-extrabold text-slate-900">Plans nutrition</h1>
                        <p class="text-slate-500">Bibliotheque de plans nutritionnels.</p>
                    </div>
                    <a href="{{ route('coach.nutrition.create') }}" class="bg-slate-900 text-white px-4 py-2 rounded-xl text-sm font-bold">
                        Nouveau plan
                    </a>
                </div>

                <div class="space-y-4">
                    @forelse($plans as $plan)
                        <div class="border border-slate-200 rounded-2xl p-4 flex flex-col md:flex-row md:items-center md:justify-between gap-4">
                            <div>
                                <div class="font-bold text-lg text-slate-900">{{ $plan->titre }}</div>
                                <div class="text-sm text-slate-500">
                                    Calories: {{ $plan->calories ?? 'n/a' }} | P: {{ $plan->proteines ?? 'n/a' }}g
                                </div>
                            </div>
                            <div class="text-right">
                                <div class="text-sm text-slate-500">Prix TTC</div>
                                <div class="text-xl font-extrabold text-slate-900">{{ number_format($plan->prix_ttc, 2, ',', ' ') }} EUR</div>
                                <div class="text-xs text-slate-500">TVA {{ $plan->tva }}%</div>
                            </div>
                        </div>
                    @empty
                        <div class="text-slate-500 text-sm">Aucun plan nutrition pour le moment.</div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
