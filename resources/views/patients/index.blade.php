<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            👥 Liste des Patients
        </h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            {{-- Search bar --}}
            <div class="mb-6">
                <form action="{{ route('patients.index') }}" method="GET" class="flex gap-3">
                    <input
                        type="text"
                        name="search"
                        placeholder="🔍 Rechercher par nom..."
                        value="{{ request('search') }}"
                        class="flex-1 rounded-lg border border-gray-300 px-4 py-2 shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500"
                    >
                    <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-2 rounded-lg font-semibold transition">
                        Rechercher
                    </button>
                </form>
            </div>

            {{-- Table --}}
            <div class="bg-white rounded-2xl shadow overflow-hidden">
                <table class="w-full text-sm text-left">
                    <thead class="bg-blue-700 text-white text-sm uppercase">
                        <tr>
                            <th class="px-6 py-4">Nom</th>
                            <th class="px-6 py-4">Date de Naissance</th>
                            <th class="px-6 py-4">Genre</th>
                            <th class="px-6 py-4 text-center">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100">
                        @foreach($patients as $patient)
                        <tr class="hover:bg-blue-50 transition">
                            <td class="px-6 py-4 font-medium text-gray-800">{{ $patient->nom }}</td>
                            <td class="px-6 py-4 text-gray-600">{{ $patient->date_naissance }}</td>
                            <td class="px-6 py-4 text-gray-600">{{ $patient->genre }}</td>
                            <td class="px-6 py-4 text-center space-x-2">
                                <a href="#" class="inline-block bg-yellow-400 hover:bg-yellow-500 text-white text-xs font-semibold px-3 py-1 rounded-full transition">
                                    ✏️ Modifier
                                </a>
                                <a href="{{ route('patients.show', $patient->id) }}" class="inline-block bg-blue-600 hover:bg-blue-700 text-white text-xs font-semibold px-3 py-1 rounded-full transition">
                                    📋 Historique
                                </a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>

                {{-- Pagination --}}
                <div class="px-6 py-4 border-t border-gray-100">
                    {{ $patients->links() }}
                </div>
            </div>

        </div>
    </div>
</x-app-layout>
