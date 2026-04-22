<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">📊 Statistiques</h2>
    </x-slot>
    <div class="py-8">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-6">
            <div style="display:grid;grid-template-columns:repeat(4,1fr);gap:1.5rem">
                <div class="bg-white rounded-2xl shadow p-6 text-center">
                    <div style="font-size:3rem">👥</div>
                    <p class="text-gray-500 font-medium mt-2">Total Patients</p>
                    <p class="text-3xl font-bold text-blue-600">{{ \App\Models\Patient::count() }}</p>
                </div>
                <div class="bg-white rounded-2xl shadow p-6 text-center">
                    <div style="font-size:3rem">📅</div>
                    <p class="text-gray-500 font-medium mt-2">Total RDV</p>
                    <p class="text-3xl font-bold text-green-600">{{ \App\Models\Rendezvous::count() }}</p>
                </div>
                <div class="bg-white rounded-2xl shadow p-6 text-center">
                    <div style="font-size:3rem">⚕️</div>
                    <p class="text-gray-500 font-medium mt-2">Total Médecins</p>
                    <p class="text-3xl font-bold text-cyan-600">{{ \App\Models\Medecin::count() }}</p>
                </div>
                <div class="bg-white rounded-2xl shadow p-6 text-center">
                    <div style="font-size:3rem">📋</div>
                    <p class="text-gray-500 font-medium mt-2">Consultations</p>
                    <p class="text-3xl font-bold text-yellow-600">{{ \App\Models\Consultation::count() }}</p>
                </div>
            </div>
            <div class="bg-white rounded-2xl shadow p-6">
                <h3 class="font-bold text-gray-700 mb-4">📅 Rendez-vous par statut</h3>
                @foreach(\App\Models\Rendezvous::selectRaw('statut, count(*) as total')->groupBy('statut')->get() as $stat)
                <div class="flex items-center gap-4 mb-3">
                    <span class="w-32 font-medium text-gray-600 capitalize">{{ $stat->statut }}</span>
                    <div class="flex-1 bg-gray-100 rounded-full h-4">
                        <div class="bg-blue-500 h-4 rounded-full" style="width:{{ min(100, $stat->total * 20) }}%"></div>
                    </div>
                    <span class="font-bold text-gray-700">{{ $stat->total }}</span>
                </div>
                @endforeach
            </div>
            <div class="text-center">
                <a href="{{ route('admin.dashboard') }}" style="background:#2563eb" class="inline-block text-white font-semibold px-6 py-3 rounded-xl hover:opacity-90 transition">
                    ← Retour au Dashboard
                </a>
            </div>
        </div>
    </div>
</x-app-layout>
