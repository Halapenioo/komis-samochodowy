<x-app-layout>
    <x-slot name="header">
        <div class="bg-slate-900 border-b-2 border-blue-600 p-4 rounded-xl shadow-xl">
            <h2 class="font-black text-xl text-white tracking-tight">
                Ewidencja części i naprawy dla: <span class="text-blue-500">{{ $car->brand }} {{ $car->model }}</span> <span class="text-xs font-mono text-slate-500">({{ $car->vin }})</span>
            </h2>
        </div>
    </x-slot>

    <div class="py-12 bg-slate-950 min-h-screen text-slate-100">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-slate-900 overflow-hidden shadow-2xl sm:rounded-lg p-6 border border-slate-800 border-t-4 border-blue-600">
                <form action="{{ route('repairs.store', $car) }}" method="POST">
                    @csrf
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                        <div>
                            <label class="block text-sm font-medium text-slate-400">Nazwa części / Opis pracy</label>
                            <input type="text" name="replaced_part_name" required class="mt-1 block w-full rounded-md bg-slate-950 text-slate-100 border-slate-800 focus:ring-blue-500 focus:border-blue-500">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-slate-400">Status / Rodzaj części</label>
                            <select name="part_status" class="mt-1 block w-full rounded-md bg-slate-950 text-slate-100 border-slate-800 focus:ring-blue-500 focus:border-blue-500">
                                <option value="Nowa oryginalna">Nowa oryginalna (OEM)</option>
                                <option value="Markowy zamiennik">Markowy zamiennik</option>
                                <option value="Regenerowana">Regenerowana</option>
                                <option value="Używana">Używana</option>
                            </select>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-6">
                        <div>
                            <label class="block text-sm font-medium text-slate-400">Data naprawy</label>
                            <input type="date" name="repair_date" required class="mt-1 block w-full rounded-md bg-slate-950 text-slate-100 border-slate-800 focus:ring-blue-500 focus:border-blue-500">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-slate-400">Przebieg podczas naprawy</label>
                            <input type="number" name="mileage_at_repair" required class="mt-1 block w-full rounded-md bg-slate-950 text-slate-100 border-slate-800 focus:ring-blue-500 focus:border-blue-500">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-slate-400">Numer seryjny / OEM części</label>
                            <input type="text" name="oem_number" class="mt-1 block w-full rounded-md bg-slate-950 text-slate-100 border-slate-800 focus:ring-blue-500 focus:border-blue-500 font-mono uppercase">
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
                        <div>
                            <label class="block text-sm font-medium text-slate-400">Koszt części (wewnętrzny)</label>
                            <input type="number" step="0.01" name="part_cost" class="mt-1 block w-full rounded-md bg-slate-950 text-slate-100 border-slate-800 focus:ring-blue-500 focus:border-blue-500">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-slate-400">Koszt robocizny (wewnętrzny)</label>
                            <input type="number" step="0.01" name="labor_cost" class="mt-1 block w-full rounded-md bg-slate-950 text-slate-100 border-slate-800 focus:ring-blue-500 focus:border-blue-500">
                        </div>
                    </div>

                    <div class="flex justify-end gap-4 border-t border-slate-800 pt-4">
                        <a href="{{ route('dashboard') }}" class="bg-slate-800 hover:bg-slate-700 text-slate-300 font-bold py-2 px-6 rounded-lg text-sm transition">Anuluj</a>
                        <button type="submit" class="bg-blue-600 hover:bg-blue-500 text-white font-bold py-2 px-6 rounded-lg text-sm transition shadow-md">Udokumentuj Naprawę</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
