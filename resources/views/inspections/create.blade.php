<x-app-layout>
    <x-slot name="header">
        <div class="bg-slate-900 border-b-2 border-blue-600 p-4 rounded-xl shadow-xl">
            <h2 class="font-black text-xl text-white tracking-tight">
                Dodaj przegląd dla: <span class="text-blue-500">{{ $car->brand }} {{ $car->model }}</span> <span class="text-xs font-mono text-slate-500">({{ $car->vin }})</span>
            </h2>
        </div>
    </x-slot>

    <div class="py-12 bg-slate-950 min-h-screen text-slate-100">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-slate-900 overflow-hidden shadow-2xl sm:rounded-lg p-6 border border-slate-800 border-t-4 border-blue-600">

                @if ($errors->any())
                    <div class="mb-6 bg-red-600 border border-red-700 text-white p-5 rounded-xl shadow-2xl">
                        <h3 class="font-black text-lg mb-2">⚠ Wystąpił problem z formularzem przeglądu:</h3>
                        <ul class="list-disc list-inside text-sm font-bold space-y-1">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('inspections.store', $car) }}" method="POST">
                    @csrf

                    <h3 class="text-lg font-bold text-white border-b border-slate-800 pb-2 mb-4">Daty i przebieg</h3>
                    <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
                        <div>
                            <label class="block text-sm font-medium text-slate-400">Data przeglądu *</label>
                            <input type="date" name="last_inspection_date" value="{{ old('last_inspection_date') }}" required class="mt-1 block w-full rounded-md bg-slate-950 text-slate-100 border-slate-800 focus:ring-blue-500 focus:border-blue-500">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-slate-400">Przebieg (km) *</label>
                            <input type="number" name="mileage_at_inspection" value="{{ old('mileage_at_inspection') }}" required class="mt-1 block w-full rounded-md bg-slate-950 text-slate-100 border-slate-800 focus:ring-blue-500 focus:border-blue-500">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-slate-400">Następny przegląd</label>
                            <input type="date" name="next_inspection_date" value="{{ old('next_inspection_date') }}" class="mt-1 block w-full rounded-md bg-slate-950 text-slate-100 border-slate-800 focus:ring-blue-500 focus:border-blue-500">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-slate-400">Ważność OC</label>
                            <input type="date" name="insurance_expiry_date" value="{{ old('insurance_expiry_date') }}" class="mt-1 block w-full rounded-md bg-slate-950 text-slate-100 border-slate-800 focus:ring-blue-500 focus:border-blue-500">
                        </div>
                    </div>

                    <h3 class="text-lg font-bold text-white border-b border-slate-800 pb-2 mb-4">Pomiary powłoki lakierniczej (w mikronach)</h3>

                    <div class="bg-slate-950/40 p-6 rounded-xl border border-slate-800/80 mb-8 space-y-6">
                        <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
                            <div>
                                <label class="block text-xs font-bold uppercase text-slate-400 mb-1">Maska</label>
                                <input type="number" name="paint_thickness_hood" value="{{ old('paint_thickness_hood') }}" required class="w-full rounded-md bg-slate-950 text-slate-100 border-slate-800 focus:ring-blue-500 focus:border-blue-500 font-mono">
                            </div>
                            <div>
                                <label class="block text-xs font-bold uppercase text-slate-400 mb-1">Dach</label>
                                <input type="number" name="paint_thickness_roof" value="{{ old('paint_thickness_roof') }}" required class="w-full rounded-md bg-slate-950 text-slate-100 border-slate-800 focus:ring-blue-500 focus:border-blue-500 font-mono">
                            </div>
                            <div>
                                <label class="block text-xs font-bold uppercase text-slate-400 mb-1">Zderzak Przedni</label>
                                <input type="number" name="paint_thickness_front_bumper" value="{{ old('paint_thickness_front_bumper') }}" required class="w-full rounded-md bg-slate-950 text-slate-100 border-slate-800 focus:ring-blue-500 focus:border-blue-500 font-mono">
                            </div>
                            <div>
                                <label class="block text-xs font-bold uppercase text-slate-400 mb-1">Zderzak Tylny</label>
                                <input type="number" name="paint_thickness_rear_bumper" value="{{ old('paint_thickness_rear_bumper') }}" required class="w-full rounded-md bg-slate-950 text-slate-100 border-slate-800 focus:ring-blue-500 focus:border-blue-500 font-mono">
                            </div>
                        </div>

                        <div class="pt-4 border-t border-slate-800/60">
                            <p class="text-xs font-black text-blue-500 uppercase tracking-wider mb-3">← Lewa strona pojazdu</p>
                            <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
                                <div>
                                    <label class="block text-xs text-slate-400 mb-1">Błotnik przedni lewy</label>
                                    <input type="number" name="paint_thickness_front_left_fender" value="{{ old('paint_thickness_front_left_fender') }}" required class="w-full rounded-md bg-slate-950 text-slate-100 border-slate-800 focus:ring-blue-500 focus:border-blue-500 font-mono">
                                </div>
                                <div>
                                    <label class="block text-xs text-slate-400 mb-1">Drzwi przednie lewe</label>
                                    <input type="number" name="paint_thickness_front_left_door" value="{{ old('paint_thickness_front_left_door') }}" required class="w-full rounded-md bg-slate-950 text-slate-100 border-slate-800 focus:ring-blue-500 focus:border-blue-500 font-mono">
                                </div>
                                <div>
                                    <label class="block text-xs text-slate-400 mb-1">Drzwi tylne lewe</label>
                                    <input type="number" name="paint_thickness_rear_left_door" value="{{ old('paint_thickness_rear_left_door') }}" required class="w-full rounded-md bg-slate-950 text-slate-100 border-slate-800 focus:ring-blue-500 focus:border-blue-500 font-mono">
                                </div>
                                <div>
                                    <label class="block text-xs text-slate-400 mb-1">Błotnik tylny lewy</label>
                                    <input type="number" name="paint_thickness_rear_left_fender" value="{{ old('paint_thickness_rear_left_fender') }}" required class="w-full rounded-md bg-slate-950 text-slate-100 border-slate-800 focus:ring-blue-500 focus:border-blue-500 font-mono">
                                </div>
                            </div>
                        </div>

                        <div class="pt-4 border-t border-slate-800/60">
                            <p class="text-xs font-black text-emerald-500 uppercase tracking-wider mb-3">→ Prawa strona pojazdu</p>
                            <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
                                <div>
                                    <label class="block text-xs text-slate-400 mb-1">Błotnik przedni prawy</label>
                                    <input type="number" name="paint_thickness_front_right_fender" value="{{ old('paint_thickness_front_right_fender') }}" required class="w-full rounded-md bg-slate-950 text-slate-100 border-slate-800 focus:ring-blue-500 focus:border-blue-500 font-mono">
                                </div>
                                <div>
                                    <label class="block text-xs text-slate-400 mb-1">Drzwi przednie prawe</label>
                                    <input type="number" name="paint_thickness_front_right_door" value="{{ old('paint_thickness_front_right_door') }}" required class="w-full rounded-md bg-slate-950 text-slate-100 border-slate-800 focus:ring-blue-500 focus:border-blue-500 font-mono">
                                </div>
                                <div>
                                    <label class="block text-xs text-slate-400 mb-1">Drzwi tylne prawe</label>
                                    <input type="number" name="paint_thickness_rear_right_door" value="{{ old('paint_thickness_rear_right_door') }}" required class="w-full rounded-md bg-slate-950 text-slate-100 border-slate-800 focus:ring-blue-500 focus:border-blue-500 font-mono">
                                </div>
                                <div>
                                    <label class="block text-xs text-slate-400 mb-1">Błotnik tylny prawy</label>
                                    <input type="number" name="paint_thickness_rear_right_fender" value="{{ old('paint_thickness_rear_right_fender') }}" required class="w-full rounded-md bg-slate-950 text-slate-100 border-slate-800 focus:ring-blue-500 focus:border-blue-500 font-mono">
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="mb-6">
                        <label class="block text-sm font-medium text-slate-400">Rozpoznane mankamenty (np. rysy, ubytki)</label>
                        <textarea name="known_defects" rows="3" class="mt-1 block w-full rounded-md bg-slate-950 text-slate-100 border-slate-800 focus:ring-blue-500 focus:border-blue-500 placeholder-slate-700">{{ old('known_defects') }}</textarea>
                    </div>

                    <div class="flex justify-end gap-4 border-t border-slate-800 pt-4">
                        <a href="{{ route('dashboard') }}" class="bg-slate-800 hover:bg-slate-700 text-slate-300 font-bold py-2 px-6 rounded-lg text-sm transition">Anuluj</a>
                        <button type="submit" class="bg-emerald-600 hover:bg-emerald-500 text-white font-bold py-2 px-6 rounded-lg text-sm transition shadow-md">Zapisz Przegląd</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
