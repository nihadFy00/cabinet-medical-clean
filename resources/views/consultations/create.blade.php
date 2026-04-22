<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">📋 Nouvelle Consultation</h2>
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
                <form action="{{ route('consultations.store') }}" method="POST" class="space-y-5">
                    @csrf
                    <div style="display:grid; grid-template-columns:1fr 1fr; gap:1rem">
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-1">👤 Patient</label>
                            <select name="patient_id" required class="w-full rounded-lg border border-gray-300 px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                                <option value="">-- Choisir --</option>
                                @foreach($patients as $p)
                                    <option value="{{ $p->id }}">{{ $p->nom }} {{ $p->prenom }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-1">👨‍⚕️ Médecin</label>
                            <select name="medecin_id" required class="w-full rounded-lg border border-gray-300 px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                                <option value="">-- Choisir --</option>
                                @foreach($medecins as $m)
                                    <option value="{{ $m->id }}">{{ $m->nom }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-1">📅 Date de consultation</label>
                        <input type="date" name="date_consultation" required value="{{ date('Y-m-d') }}"
                            class="w-full rounded-lg border border-gray-300 px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                    </div>
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-1">📝 Notes du médecin</label>
                        <textarea name="notes_medecin" rows="4" required
                            class="w-full rounded-lg border border-gray-300 px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500"
                            placeholder="Observations, compte-rendu..."></textarea>
                    </div>
                    <div style="display:grid; grid-template-columns:1fr 1fr; gap:1rem">
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-1">⚖️ Poids (kg)</label>
                            <input type="number" step="0.1" name="poids"
                                class="w-full rounded-lg border border-gray-300 px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500"
                                placeholder="70.5">
                        </div>
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-1">💉 Tension</label>
                            <input type="number" step="0.1" name="tension"
                                class="w-full rounded-lg border border-gray-300 px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500"
                                placeholder="12.5">
                        </div>
                    </div>
                    <div style="display:flex; gap:1rem; padding-top:0.5rem">
                        <button type="submit" style="background:#2563eb" class="flex-1 text-white font-bold py-3 rounded-xl hover:opacity-90 transition">
                            ✅ Enregistrer
                        </button>
                        <a href="{{ route('consultations.index') }}" style="background:#6b7280" class="flex-1 text-white font-bold py-3 rounded-xl hover:opacity-90 transition text-center">
                            ❌ Annuler
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
