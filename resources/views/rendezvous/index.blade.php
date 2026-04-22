<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                📅 Mon Planning — Rendez-vous
            </h2>
            <a href="{{ route('rendezvous.create') }}"
               class="bg-green-600 hover:bg-green-700 text-white text-sm font-semibold px-4 py-2 rounded-lg transition">
                ➕ Nouveau RDV
            </a>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white rounded-2xl shadow overflow-hidden">
                <table class="w-full text-sm text-left">
                    <thead class="bg-green-700 text-white text-sm uppercase">
                        <tr>
                            <th class="px-6 py-4">👤 Patient</th>
                            <th class="px-6 py-4">👨‍⚕️ Médecin</th>
                            <th class="px-6 py-4">📅 Date</th>
                            <th class="px-6 py-4">🔖 Statut</th>
                            <th class="px-6 py-4 text-center">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100">
                        @forelse($rendezvous as $rdv)
                        <tr class="hover:bg-green-50 transition">
                            <td class="px-6 py-4 font-medium text-gray-800">{{ $rdv->patient->nom ?? '—' }}</td>
                            <td class="px-6 py-4 text-gray-600">{{ $rdv->medecin->nom ?? '—' }}</td>
                            <td class="px-6 py-4 text-gray-600">{{ $rdv->date_rdv }}</td>
                            <td class="px-6 py-4">
                                @php
                                    $colors = [
                                        'pending'   => 'bg-yellow-100 text-yellow-700',
                                        'confirmed' => 'bg-green-100 text-green-700',
                                        'cancelled' => 'bg-red-100 text-red-700',
                                        'completed' => 'bg-blue-100 text-blue-700',
                                    ];
                                    $color = $colors[$rdv->statut] ?? 'bg-gray-100 text-gray-600';
                                @endphp
                                <span class="px-3 py-1 rounded-full text-xs font-semibold {{ $color }}">
                                    {{ ucfirst($rdv->statut) }}
                                </span>
                            </td>
                            <td class="px-6 py-4 text-center">
                                <form action="{{ route('rendezvous.destroy', $rdv->id) }}" method="POST"
                                      onsubmit="return confirm('Supprimer ce rendez-vous ?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                        class="bg-red-500 hover:bg-red-600 text-white text-xs font-semibold px-3 py-1 rounded-full transition">
                                        🗑️ Supprimer
                                    </button>
                                </form>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" class="px-6 py-10 text-center text-gray-400">
                                Aucun rendez-vous pour le moment.
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>
