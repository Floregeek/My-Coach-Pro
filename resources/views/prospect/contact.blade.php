<x-public-layout :title="'Contact - My Coach Pro'">
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
        <div class="bg-white rounded-3xl border border-slate-100 p-8 shadow-sm">
            <h1 class="text-3xl font-extrabold mb-2">Contact Prospect</h1>
            <p class="text-slate-600 mb-6">Expliquez vos objectifs, nous vous recontactons rapidement.</p>

            @if(session('status'))
                <div class="bg-emerald-50 text-emerald-700 px-4 py-3 rounded-2xl text-sm font-semibold mb-4">
                    {{ session('status') }}
                </div>
            @endif

            <form method="POST" action="{{ route('prospect.contact.send') }}" class="space-y-4">
                @csrf
                <div>
                    <label class="text-sm font-semibold text-slate-700">Nom complet</label>
                    <input name="name" value="{{ old('name') }}" class="mt-2 w-full rounded-2xl border border-slate-200 px-4 py-3 focus:border-indigo-500 focus:ring-indigo-500" required>
                    @error('name')
                        <p class="text-xs text-red-500 mt-1">{{ $message }}</p>
                    @enderror
                </div>
                <div>
                    <label class="text-sm font-semibold text-slate-700">Email</label>
                    <input name="email" type="email" value="{{ old('email') }}" class="mt-2 w-full rounded-2xl border border-slate-200 px-4 py-3 focus:border-indigo-500 focus:ring-indigo-500" required>
                    @error('email')
                        <p class="text-xs text-red-500 mt-1">{{ $message }}</p>
                    @enderror
                </div>
                <div>
                    <label class="text-sm font-semibold text-slate-700">Coach vise (optionnel)</label>
                    <select name="coach_id" class="mt-2 w-full rounded-2xl border border-slate-200 px-4 py-3 focus:border-indigo-500 focus:ring-indigo-500">
                        <option value="">Choisir un coach</option>
                        @foreach($coaches as $coach)
                            <option value="{{ $coach->id }}" @selected(old('coach_id', optional($selectedCoach)->id) == $coach->id)>
                                {{ $coach->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label class="text-sm font-semibold text-slate-700">Message</label>
                    <textarea name="message" rows="5" class="mt-2 w-full rounded-2xl border border-slate-200 px-4 py-3 focus:border-indigo-500 focus:ring-indigo-500" required>{{ old('message') }}</textarea>
                    @error('message')
                        <p class="text-xs text-red-500 mt-1">{{ $message }}</p>
                    @enderror
                </div>
                <button class="bg-indigo-600 text-white px-6 py-3 rounded-2xl font-bold text-sm">Envoyer la demande</button>
            </form>
        </div>

        <div class="bg-slate-900 rounded-3xl p-8 text-white shadow-sm">
            <h2 class="text-2xl font-bold mb-4">Pourquoi My Coach Pro</h2>
            <ul class="text-sm space-y-3 text-slate-200">
                <li>Des coachs verifies avec des retours clients.</li>
                <li>Suivi et planning personnalise.</li>
                <li>Paiement securise et transparence.</li>
            </ul>
            <div class="mt-8 bg-white/10 rounded-2xl p-6">
                <p class="text-sm font-semibold">Besoin d'un devis rapide ?</p>
                <p class="text-xs text-slate-200 mt-2">Decrivez vos objectifs, le coach repond sous 24h.</p>
            </div>
        </div>
    </div>
</x-public-layout>
