<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight"> Ajouter un Nouveau Patient</h2>
    </x-slot>
    <div class="py-8">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white rounded-2xl shadow p-8">
                @if($errors->any())
                    <div class="mb-4 bg-red-50 border border-red-200 text-red-700 rounded-lg p-4 text-sm">
                        <ul class="list-disc list-inside">
                            @foreach($errors->all() as $e)<li>{{ $e }}</li>@endforeach
                        </ul>
                    </div>
                @endif
                <form action="{{ route('patients.store') }}" method="POST" class="space-y-5">
                    @csrf
                    <div style="display:grid;grid-template-columns:1fr 1fr;gap:1rem">
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-1"> Nom complet</label>
                            <input type="text" name="name" required
                                class="w-full rounded-lg border border-gray-300 px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500"
                                placeholder="Alami Yassine">
                        </div>
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-1"> Email</label>
                            <input type="email" name="email" required
                                class="w-full rounded-lg border border-gray-300 px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500"
                                placeholder="patient@email.com">
                        </div>
                    </div>
                    <div style="display:grid;grid-template-columns:1fr 1fr;gap:1rem">
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-1"> Date de naissance</label>
                            <input type="date" name="birth_date" required
                                class="w-full rounded-lg border border-gray-300 px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                        </div>
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-1"> Genre</label>
                            <select name="genre" class="w-full rounded-lg border border-gray-300 px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                                <option value="Homme">Homme</option>
                                <option value="Femme">Femme</option>
                            </select>
                        </div>
                    </div>
                    <div style="display:grid;grid-template-columns:1fr 1fr;gap:1rem">
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-1"> Téléphone</label>
                            <input type="text" name="telephone"
                                class="w-full rounded-lg border border-gray-300 px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500"
                                placeholder="0612345678">
                        </div>
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-1"> Groupe Sanguin</label>
                            <select name="groupe_sanguin" class="w-full rounded-lg border border-gray-300 px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                                <option value="">-- Sélectionner --</option>
                                <option>A+</option><option>A-</option>
                                <option>B+</option><option>B-</option>
                                <option>AB+</option><option>AB-</option>
                                <option>O+</option><option>O-</option>
                            </select>
                        </div>
                    </div>
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-1"> Historique Médical</label>
                        <textarea name="medical_history" rows="3"
                            class="w-full rounded-lg border border-gray-300 px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500"
                            placeholder="Antécédents médicaux..."></textarea>
                    </div>
                    <div style="display:flex;gap:1rem;padding-top:0.5rem">
                        <button type="submit" style="background:#2563eb" class="flex-1 text-white font-bold py-3 rounded-xl hover:opacity-90 transition">
                             Enregistrer la Fiche Patient
                        </button>
                        <a href="{{ route('patients.index') }}" style="background:#6b7280" class="flex-1 text-white font-bold py-3 rounded-xl hover:opacity-90 transition text-center">
                             Annuler
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
