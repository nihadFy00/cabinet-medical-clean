<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                 Dossier Patient  {{ $patient->nom }} {{ $patient->prenom }}
            </h2>
            <a href="{{ route('patients.index') }}" style="background:#6b7280" class="text-white text-sm font-semibold px-4 py-2 rounded-lg hover:opacity-90 transition">
                 Retour
            </a>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 space-y-6">

            {{-- Infos principales --}}
            <div class="bg-white rounded-2xl shadow p-6">
                <h3 class="font-bold text-gray-700 text-lg mb-4"> Informations Personnelles</h3>
                <div style="display:grid;grid-template-columns:1fr 1fr;gap:1rem">
                    <div>
                        <p class="text-sm text-gray-500">Nom complet</p>
                        <p class="font-semibold text-gray-800">{{ $patient->nom }} {{ $patient->prenom }}</p>
                    </div>
                    <div>
                        <p class="text-sm text-gray-500">Code Patient</p>
                        <p class="font-semibold text-gray-800">{{ $patient->code_patient }}</p>
                    </div>
                    <div>
                        <p class="text-sm text-gray-500">Date de naissance</p>
                        <p class="font-semibold text-gray-800">{{ $patient->date_naissance }}</p>
                    </div>
                    <div>
                        <p class="text-sm text-gray-500">Genre</p>
                        <p class="font-semibold text-gray-800">{{ $patient->genre }}</p>
                    </div>
                    <div>
                        <p class="text-sm text-gray-500">Téléphone</p>
                        <p class="font-semibold text-gray-800">{{ $patient->telephone ?? '' }}</p>
                    </div>
                    <div>
                        <p class="text-sm text-gray-500">Email</p>
                        <p class="font-semibold text-gray-800">{{ $patient->email ?? '' }}</p>
                    </div>
                </div>
            </div>

            {{-- Antécédents --}}
            <div class="bg-white rounded-2xl shadow p-6">
                <h3 class="font-bold text-gray-700 text-lg mb-3"> Antécédents Médicaux</h3>
                <p class="text-gray-600">{{ $patient->antecedents_medicaux ?? 'Aucun antécédent enregistré.' }}</p>
            </div>

        </div>
    </div>
</x-app-layout>
