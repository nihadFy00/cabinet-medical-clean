<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            ➕ Ajouter un Médecin
        </h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white rounded-2xl shadow p-8">

                @if($errors->any())
                    <div class="mb-4 bg-red-50 border border-red-200 text-red-700 rounded-lg p-4">
                        <ul class="list-disc list-inside text-sm">
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('medecins.store') }}" method="POST" class="space-y-5">
                    @csrf

                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-1">👨‍⚕️ Nom du Docteur</label>
                        <input type="text" name="nom" required
                            class="w-full rounded-lg border border-gray-300 px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500 shadow-sm"
                            placeholder="Dr. Dupont">
                    </div>

                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-1">📧 Email</label>
                        <input type="email" name="email" required
                            class="w-full rounded-lg border border-gray-300 px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500 shadow-sm"
                            placeholder="docteur@cabinet.com">
                    </div>

                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-1">🏥 Spécialité</label>
                        <input type="text" name="specialite" required
                            class="w-full rounded-lg border border-gray-300 px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500 shadow-sm"
                            placeholder="Cardiologie, Pédiatrie...">
                    </div>

                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-1">📞 Téléphone</label>
                        <input type="text" name="telephone"
                            class="w-full rounded-lg border border-gray-300 px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500 shadow-sm"
                            placeholder="06 00 00 00 00">
                    </div>

                    <div class="pt-2">
                        <button type="submit"
                            class="w-full bg-green-600 hover:bg-green-700 text-white font-bold py-3 rounded-lg transition text-base">
                            ✅ Enregistrer le Médecin
                        </button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</x-app-layout>
