<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">⚙️ Configuration</h2>
    </x-slot>
    <div class="py-8">
        <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8 space-y-6">
            <div class="bg-white rounded-2xl shadow p-8 space-y-4">
                <h3 class="font-bold text-gray-700 text-lg">🏥 Informations du Cabinet</h3>
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1">Nom du Cabinet</label>
                    <input type="text" value="Cabinet Médical" class="w-full rounded-lg border border-gray-300 px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                </div>
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1">Adresse</label>
                    <input type="text" placeholder="123 Rue de la Santé..." class="w-full rounded-lg border border-gray-300 px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                </div>
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1">Téléphone</label>
                    <input type="text" placeholder="05 00 00 00 00" class="w-full rounded-lg border border-gray-300 px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                </div>
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1">Email</label>
                    <input type="email" placeholder="contact@cabinet.com" class="w-full rounded-lg border border-gray-300 px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                </div>
                <div class="pt-2">
                    <button style="background:#2563eb" class="text-white font-bold px-6 py-3 rounded-xl hover:opacity-90 transition">
                        💾 Sauvegarder
                    </button>
                </div>
            </div>
            <div class="text-center">
                <a href="{{ route('admin.dashboard') }}" style="background:#6b7280" class="inline-block text-white font-semibold px-6 py-3 rounded-xl hover:opacity-90 transition">
                    ← Retour au Dashboard
                </a>
            </div>
        </div>
    </div>
</x-app-layout>
