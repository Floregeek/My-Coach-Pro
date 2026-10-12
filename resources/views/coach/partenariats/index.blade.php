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
                        <h1 class="text-2xl font-extrabold text-slate-900">Partenariats coachs</h1>
                        <p class="text-slate-500">Co-traitance ou sous-traitance entre coachs.</p>
                    </div>
                    <a href="{{ route('coach.partenariats.create') }}" class="bg-slate-900 text-white px-4 py-2 rounded-xl text-sm font-bold">
                        Nouveau partenariat
                    </a>
                </div>

                <div class="space-y-4">
                    @forelse($partenariats as $partenariat)
                        <div class="border border-slate-200 rounded-2xl p-4 flex items-center justify-between">
                            <div>
                                <div class="font-semibold text-slate-900">
                                    {{ $partenariat->coach->name ?? 'Coach' }} &amp; {{ $partenariat->partenaire->name ?? 'Partenaire' }}
                                </div>
                                <div class="text-xs text-slate-500">
                                    Type: {{ $partenariat->type }} | Commission: {{ $partenariat->commission_rate }}%
                                </div>
                            </div>
                            <div class="text-xs text-slate-500">{{ $partenariat->statut }}</div>
                        </div>
                    @empty
                        <div class="text-slate-500 text-sm">Aucun partenariat pour le moment.</div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
