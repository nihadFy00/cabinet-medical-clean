<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">👑 Tableau de bord Administrateur</h2>
    </x-slot>
    <div class="py-8">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-6">

            <div class="rounded-2xl p-6 text-white" style="background:linear-gradient(135deg,#1F3864,#2E74B5)">
                <div class="flex items-center gap-4">
                    <span style="font-size:3.5rem">👑</span>
                    <div>
                        <h2 class="text-2xl font-bold">Bienvenue, {{ auth()->user()->name }} !</h2>
                        <p class="opacity-75">Tableau de bord Administrateur</p>
                    </div>
                </div>
            </div>

            <div style="display:grid;grid-template-columns:repeat(4,1fr);gap:1.5rem">
                <div class="bg-white rounded-2xl shadow p-6 text-center">
                    <div style="font-size:3rem">👥</div>
                    <p class="text-gray-500 font-medium mt-2">Patients</p>
                    <p class="text-2xl font-bold text-blue-600">{{ \App\Models\Patient::count() }}</p>
                </div>
                <div class="bg-white rounded-2xl shadow p-6 text-center">
                    <div style="font-size:3rem">📅</div>
                    <p class="text-gray-500 font-medium mt-2">Rendez-vous</p>
                    <p class="text-2xl font-bold text-green-600">{{ \App\Models\Rendezvous::count() }}</p>
                </div>
                <div class="bg-white rounded-2xl shadow p-6 text-center">
                    <div style="font-size:3rem">⚕️</div>
                    <p class="text-gray-500 font-medium mt-2">Médecins</p>
                    <p class="text-2xl font-bold text-cyan-600">{{ \App\Models\Medecin::count() }}</p>
                </div>
                <div class="bg-white rounded-2xl shadow p-6 text-center">
                    <div style="font-size:3rem">📋</div>
                    <p class="text-gray-500 font-medium mt-2">Consultations</p>
                    <p class="text-2xl font-bold text-yellow-600">{{ \App\Models\Consultation::count() }}</p>
                </div>
            </div>

            <div class="bg-white rounded-2xl shadow p-6">
                <h3 class="font-bold text-gray-700 mb-4">⚡ Actions Rapides</h3>
                <div style="display:grid;grid-template-columns:repeat(4,1fr);gap:1rem">
                    <a href="{{ route('patients.index') }}" style="background:#2563eb" class="flex items-center justify-center gap-2 text-white font-semibold py-3 rounded-xl hover:opacity-90 transition">
                        👥 Gérer Patients
                    </a>
                    <a href="{{ route('medecins.create') }}" style="background:#16a34a" class="flex items-center justify-center gap-2 text-white font-semibold py-3 rounded-xl hover:opacity-90 transition">
                        ➕ Ajouter Médecin
                    </a>
                    <a href="{{ route('admin.statistiques') }}" style="background:#0891b2" class="flex items-center justify-center gap-2 text-white font-semibold py-3 rounded-xl hover:opacity-90 transition">
                        📊 Statistiques
                    </a>
                    <a href="{{ route('admin.configuration') }}" style="background:#6b7280" class="flex items-center justify-center gap-2 text-white font-semibold py-3 rounded-xl hover:opacity-90 transition">
                        ⚙️ Configuration
                    </a>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>
