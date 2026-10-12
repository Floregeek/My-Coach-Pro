<x-app-layout>
    <div class="py-10">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white rounded-3xl border border-slate-200 shadow-sm p-6">
                <h1 class="text-2xl font-extrabold text-slate-900 mb-2">Nouveau contrat</h1>
                <p class="text-slate-500 mb-6">Associer un client a une offre.</p>

                <form method="POST" action="{{ route('coach.contrats.store') }}" class="space-y-4">
                    @csrf
                    <div>
                        <label class="text-sm font-semibold text-slate-700">Client</label>
                        <select name="client_id" class="mt-2 w-full rounded-2xl border border-slate-200 px-4 py-3" required>
                            <option value="">Choisir un client</option>
                            @foreach($clients as $client)
                                <option value="{{ $client->user_id }}">{{ $client->Prenom }} {{ $client->Nom }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div>
                        <label class="text-sm font-semibold text-slate-700">Offre</label>
                        <select name="offre_id" class="mt-2 w-full rounded-2xl border border-slate-200 px-4 py-3" required>
                            <option value="">Choisir une offre</option>
                            @foreach($offres as $offre)
                                <option value="{{ $offre->id }}">{{ $offre->titre }} ({{ $offre->type }})</option>
                            @endforeach
                        </select>
                    </div>

                    <div>
                        <label class="text-sm font-semibold text-slate-700">Date expiration (optionnelle)</label>
                        <input type="date" name="date_expiration" class="mt-2 w-full rounded-2xl border border-slate-200 px-4 py-3">
                    </div>

                    <div class="flex items-center gap-3">
                        <button class="bg-slate-900 text-white px-6 py-3 rounded-2xl font-bold text-sm">Creer le contrat</button>
                        <a href="{{ route('coach.contrats.index') }}" class="text-slate-500 text-sm font-semibold">Annuler</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
