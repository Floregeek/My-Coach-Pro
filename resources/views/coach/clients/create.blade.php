<x-app-layout>
    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white rounded-2xl shadow border border-slate-200 overflow-hidden">
                <div class="px-8 py-6 border-b bg-slate-50">
                    <h2 class="text-2xl font-extrabold text-slate-900">
                        Inscription d un nouveau client
                    </h2>
                    <p class="text-slate-500 mt-1 font-medium">
                        Creation du profil et du dossier medical
                    </p>
                </div>

                <form action="{{ route('clients.store') }}" method="POST" class="p-8 space-y-6">
                    @csrf

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                        <div>
                            <label class="block text-sm font-semibold text-slate-700 mb-1">Prenom</label>
                            <input type="text" name="Prenom" required
                                   class="w-full rounded-xl border-slate-300 focus:border-indigo-500 focus:ring-indigo-500">
                        </div>

                        <div>
                            <label class="block text-sm font-semibold text-slate-700 mb-1">Nom</label>
                            <input type="text" name="Nom" required
                                   class="w-full rounded-xl border-slate-300 focus:border-indigo-500 focus:ring-indigo-500">
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                        <div>
                            <label class="block text-sm font-semibold text-slate-700 mb-1">Email</label>
                            <input type="email" name="Email" required
                                   class="w-full rounded-xl border-slate-300 focus:border-indigo-500 focus:ring-indigo-500">
                        </div>

                        <div>
                            <label class="block text-sm font-semibold text-slate-700 mb-1">Date de naissance</label>
                            <input type="date" name="Date_nais"
                                   class="w-full rounded-xl border-slate-300 focus:border-indigo-500 focus:ring-indigo-500">
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                        <div>
                            <label class="block text-sm font-semibold text-slate-700 mb-1">Telephone</label>
                            <input type="text" name="Telephone" placeholder="06..."
                                   class="w-full rounded-xl border-slate-300 focus:border-indigo-500 focus:ring-indigo-500">
                        </div>

                        <div>
                            <label class="block text-sm font-semibold text-slate-700 mb-1">Niveau sportif</label>
                            <select name="Niveau"
                                    class="w-full rounded-xl border-slate-300 focus:border-indigo-500 focus:ring-indigo-500">
                                <option value="Debutant">Debutant</option>
                                <option value="Intermediaire">Intermediaire</option>
                                <option value="Avance">Avance</option>
                            </select>
                        </div>
                    </div>

                    <div>
                        <label class="block text-sm font-semibold text-slate-700 mb-1">Adresse</label>
                        <input type="text" name="Adresse"
                               placeholder="Adresse, Code postal, Ville"
                               class="w-full rounded-xl border-slate-300 focus:border-indigo-500 focus:ring-indigo-500">
                    </div>

                    <div>
                        <label class="block text-sm font-semibold text-slate-700 mb-1">Objectifs initiaux</label>
                        <textarea name="Objectifs" required rows="3"
                                  class="w-full rounded-xl border-slate-300 focus:border-indigo-500 focus:ring-indigo-500"
                                  placeholder="Perte de poids, prise de masse, remise en forme..."></textarea>
                    </div>

                    <div class="bg-red-50 border border-red-200 rounded-xl p-4">
                        <label class="block text-sm font-bold text-red-700 mb-1">
                            Pathologies et restrictions medicales
                        </label>
                        <textarea name="Pathologies" rows="4"
                                  class="w-full rounded-xl border-red-300 bg-white focus:border-red-500 focus:ring-red-500"
                                  placeholder="Antecedents, blessures, allergies..."></textarea>
                        <p class="text-xs text-red-600 mt-2 italic">
                            Informations strictement confidentielles.
                        </p>
                    </div>

                    <div class="flex items-start gap-3 p-4 bg-slate-50 border rounded-xl">
                        <input type="checkbox" name="consentement_rgpd" id="rgpd" required
                               class="mt-1 text-indigo-600 focus:ring-indigo-500">
                        <label for="rgpd" class="text-sm font-semibold text-slate-700">
                            Le client autorise le stockage de ses donnees personnelles et medicales (RGPD).
                        </label>
                    </div>

                    <input type="hidden" name="user_id" value="{{ Auth::id() }}">

                    <button type="submit"
                            class="w-full rounded-2xl bg-indigo-600 py-4 text-white font-extrabold tracking-wide hover:bg-indigo-700 transition">
                        Valider l inscription
                    </button>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
