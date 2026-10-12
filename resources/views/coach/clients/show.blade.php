<x-app-layout>
    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white p-8 shadow-sm sm:rounded-lg border-t-4 border-black">
                <h2 class="text-2xl font-bold mb-6 italic">Modifier le Dossier : {{ $client->Prenom }} {{ $client->Nom }}</h2>

                <form action="{{ route('clients.update', $client->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="grid grid-cols-2 gap-4 mb-4">
                        <div>
                            <label class="block font-bold">Prenom</label>
                            <input type="text" name="Prenom" value="{{ $client->Prenom }}" required class="w-full border-gray-300 rounded shadow-sm">
                        </div>
                        <div>
                            <label class="block font-bold">Nom</label>
                            <input type="text" name="Nom" value="{{ $client->Nom }}" required class="w-full border-gray-300 rounded shadow-sm">
                        </div>
                    </div>

                    <div class="grid grid-cols-2 gap-4 mb-4">
                        <div>
                            <label class="block font-bold">Email</label>
                            <input type="email" name="Email" value="{{ $client->Email }}" required class="w-full border-gray-300 rounded shadow-sm">
                        </div>
                        <div>
                            <label class="block font-bold">Date de Naissance</label>
                            <input type="date" name="Date_nais" value="{{ $client->Date_nais }}" class="w-full border-gray-300 rounded shadow-sm">
                        </div>
                    </div>

                    <div class="grid grid-cols-2 gap-4 mb-4">
                        <div>
                            <label class="block font-bold">Telephone</label>
                            <input type="text" name="Telephone" value="{{ $client->Telephone }}" class="w-full border-gray-300 rounded shadow-sm">
                        </div>
                        <div>
                            <label class="block font-bold">Niveau Sportif</label>
                            <select name="Niveau" class="w-full border-gray-300 rounded shadow-sm">
                                <option value="Debutant" {{ $client->Niveau == 'Debutant' ? 'selected' : '' }}>Debutant</option>
                                <option value="Intermediaire" {{ $client->Niveau == 'Intermediaire' ? 'selected' : '' }}>Intermediaire</option>
                                <option value="Avance" {{ $client->Niveau == 'Avance' ? 'selected' : '' }}>Avance</option>
                            </select>
                        </div>
                    </div>

                    <div class="mb-4">
                        <label class="block font-bold">Adresse</label>
                        <input type="text" name="Adresse" value="{{ $client->Adresse }}" class="w-full border-gray-300 rounded shadow-sm">
                    </div>

                    <div class="mb-4">
                        <label class="block font-bold">Objectifs</label>
                        <textarea name="Objectifs" class="w-full border-gray-300 rounded shadow-sm h-24">{{ $client->Objectifs }}</textarea>
                    </div>

                    <div class="mb-4 p-4 bg-red-50 border border-red-200">
                        <label class="block font-bold text-red-700">Pathologies / Blessures (Confidentiel)</label>
                        <textarea name="Pathologies" class="w-full border-gray-300 rounded shadow-sm h-24">{{ $client->Pathologies }}</textarea>
                    </div>

                    <div class="mb-6 flex items-center p-4 bg-gray-50 border">
                        <input type="checkbox" name="consentement_rgpd" id="rgpd" required {{ $client->consentement_rgpd ? 'checked' : '' }}>
                        <label for="rgpd" class="ml-2 text-sm font-bold text-red-600">
                            Le client consent au stockage de ses donnees de sante (Obligatoire RGPD)
                        </label>
                    </div>

                    <button type="submit" style="background-color: black; color: white; width: 100%; padding: 14px; font-weight: bold; border-radius: 4px; text-transform: uppercase;">
                        METTRE A JOUR LE DOSSIER COMPLET
                    </button>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
