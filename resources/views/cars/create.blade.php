<x-app-layout>
    <x-slot name="header">
        <div class="bg-slate-900 border-b-2 border-blue-600 p-4 rounded-xl shadow-xl">
            <h2 class="font-black text-xl text-white tracking-tight">
                {{ __('Dodaj nowy samochód do floty') }}
            </h2>
        </div>
    </x-slot>

    <div class="py-12 bg-slate-950 min-h-screen text-slate-100">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-slate-900 overflow-hidden shadow-2xl sm:rounded-lg p-6 border border-slate-800 border-t-4 border-blue-600">

                @if ($errors->any())
                    <div class="mb-6 bg-red-600 border border-red-700 text-white p-5 rounded-xl shadow-2xl">
                        <h3 class="font-black text-lg mb-2">⚠ Wystąpił problem z formularzem:</h3>
                        <ul class="list-disc list-inside text-sm font-bold space-y-1">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('cars.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <h3 class="text-lg font-bold text-white border-b border-slate-800 pb-2 mb-4">Podstawowe dane identyfikacyjne</h3>
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-6">
                        <div>
                            <label class="block text-sm font-medium text-slate-400">Numer VIN (17 znaków)</label>
                            <input type="text" name="vin" value="{{ old('vin') }}" required class="mt-1 block w-full rounded-md bg-slate-950 text-slate-100 border-slate-800 shadow-sm focus:border-blue-500 focus:ring-blue-500 font-mono uppercase">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-slate-400">Marka</label>
                            <input type="text" name="brand" value="{{ old('brand') }}" required class="mt-1 block w-full rounded-md bg-slate-950 text-slate-100 border-slate-800 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-slate-400">Model</label>
                            <input type="text" name="model" value="{{ old('model') }}" required class="mt-1 block w-full rounded-md bg-slate-950 text-slate-100 border-slate-800 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
                        <div>
                            <label class="block text-sm font-medium text-slate-400">Typ nadwozia</label>
                            <select name="generation" required class="mt-1 block w-full rounded-md bg-slate-950 text-slate-100 border-slate-800 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                                <option value="Sedan" class="bg-slate-900 text-white" {{ old('generation') == 'Sedan' ? 'selected' : '' }}>Sedan</option>
                                <option value="Kombi" class="bg-slate-900 text-white" {{ old('generation') == 'Kombi' ? 'selected' : '' }}>Kombi</option>
                                <option value="Hatchback" class="bg-slate-900 text-white" {{ old('generation') == 'Hatchback' ? 'selected' : '' }}>Hatchback</option>
                                <option value="SUV" class="bg-slate-900 text-white" {{ old('generation') == 'SUV' ? 'selected' : '' }}>SUV / Offroad</option>
                                <option value="Coupe" class="bg-slate-900 text-white" {{ old('generation') == 'Coupe' ? 'selected' : '' }}>Coupe</option>
                                <option value="Cabriolet" class="bg-slate-900 text-white" {{ old('generation') == 'Cabriolet' ? 'selected' : '' }}>Cabriolet</option>
                                <option value="Minivan" class="bg-slate-900 text-white" {{ old('generation') == 'Minivan' ? 'selected' : '' }}>Minivan</option>
                            </select>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-slate-400">Rok produkcji</label>
                            <input type="number" name="production_year" value="{{ old('production_year') }}" required min="1900" max="2026" class="mt-1 block w-full rounded-md bg-slate-950 text-slate-100 border-slate-800 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-slate-400">Pierwsza rejestracja</label>
                            <input type="date" name="first_registration_date" value="{{ old('first_registration_date') }}" class="mt-1 block w-full rounded-md bg-slate-950 text-slate-100 border-slate-800 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                        </div>
                    </div>

                    <h3 class="text-lg font-bold text-white border-b border-slate-800 pb-2 mb-4">Dane Techniczne</h3>
                    <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
                        <div>
                            <label class="block text-sm font-medium text-slate-400">Pojemność silnika (cm³)</label>
                            <input type="number" name="engine_capacity" value="{{ old('engine_capacity') }}" required class="mt-1 block w-full rounded-md bg-slate-950 text-slate-100 border-slate-800 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-slate-400">Moc (KM)</label>
                            <input type="number" name="engine_power" value="{{ old('engine_power') }}" required class="mt-1 block w-full rounded-md bg-slate-950 text-slate-100 border-slate-800 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-slate-400">Kod silnika</label>
                            <input type="text" name="engine_code" value="{{ old('engine_code') }}" class="mt-1 block w-full rounded-md bg-slate-950 text-slate-100 border-slate-800 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-slate-400">Rodzaj paliwa</label>
                            <select name="fuel_type" class="mt-1 block w-full rounded-md bg-slate-950 text-slate-100 border-slate-800 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                                <option value="Benzyna" class="bg-slate-900 text-white" {{ old('fuel_type') == 'Benzyna' ? 'selected' : '' }}>Benzyna</option>
                                <option value="Diesel" class="bg-slate-900 text-white" {{ old('fuel_type') == 'Diesel' ? 'selected' : '' }}>Diesel</option>
                                <option value="Hybryda" class="bg-slate-900 text-white" {{ old('fuel_type') == 'Hybryda' ? 'selected' : '' }}>Hybryda</option>
                                <option value="Elektryczny" class="bg-slate-900 text-white" {{ old('fuel_type') == 'Elektryczny' ? 'selected' : '' }}>Elektryczny</option>
                                <option value="LPG" class="bg-slate-900 text-white" {{ old('fuel_type') == 'LPG' ? 'selected' : '' }}>LPG</option>
                            </select>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-slate-400">Skrzynia biegów</label>
                            <select name="transmission" class="mt-1 block w-full rounded-md bg-slate-950 text-slate-100 border-slate-800 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                                <option value="Manualna" class="bg-slate-900 text-white" {{ old('transmission') == 'Manualna' ? 'selected' : '' }}>Manualna</option>
                                <option value="Automatyczna" class="bg-slate-900 text-white" {{ old('transmission') == 'Automatyczna' ? 'selected' : '' }}>Automatyczna</option>
                            </select>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-slate-400">Rodzaj napędu</label>
                            <select name="drive_type" class="mt-1 block w-full rounded-md bg-slate-950 text-slate-100 border-slate-800 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                                <option value="FWD" class="bg-slate-900 text-white" {{ old('drive_type') == 'FWD' ? 'selected' : '' }}>Na przednie koła (FWD)</option>
                                <option value="RWD" class="bg-slate-900 text-white" {{ old('drive_type') == 'RWD' ? 'selected' : '' }}>Na tylne koła (RWD)</option>
                                <option value="AWD" class="bg-slate-900 text-white" {{ old('drive_type') == 'AWD' ? 'selected' : '' }}>Na cztery koła (AWD/4x4)</option>
                            </select>
                        </div>
                    </div>

                    <h3 class="text-lg font-bold text-white border-b border-slate-800 pb-2 mb-4">Stan, Przebieg i Finanse</h3>
                    <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-6">
                        <div>
                            <label class="block text-sm font-medium text-slate-400">Aktualny przebieg (km)</label>
                            <input type="number" name="current_mileage" value="{{ old('current_mileage') }}" required class="mt-1 block w-full rounded-md bg-slate-950 text-slate-100 border-slate-800 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-slate-400">Liczba poprzednich właścicieli</label>
                            <input type="number" name="previous_owners_count" value="{{ old('previous_owners_count', 1) }}" required class="mt-1 block w-full rounded-md bg-slate-950 text-slate-100 border-slate-800 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-slate-400">Status pojazdu</label>
                            <select name="status" class="mt-1 block w-full rounded-md bg-slate-950 text-slate-100 border-slate-800 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                                <option value="w przygotowaniu" class="bg-slate-900 text-white" {{ old('status') == 'w przygotowaniu' ? 'selected' : '' }}>W przygotowaniu</option>
                                <option value="gotowy do sprzedaży" class="bg-slate-900 text-white" {{ old('status') == 'gotowy do sprzedaży' ? 'selected' : '' }}>Gotowy do sprzedaży</option>
                                <option value="zarezerwowany" class="bg-slate-900 text-white" {{ old('status') == 'zarezerwowany' ? 'selected' : '' }}>Zarezerwowany</option>
                                <option value="sprzedany" class="bg-slate-900 text-white" {{ old('status') == 'sprzedany' ? 'selected' : '' }}>Sprzedany</option>
                            </select>
                        </div>
                        <div>
                            <label class="block text-sm font-bold text-slate-400">Cena pojazdu (PLN) *</label>
                            <input type="number" name="price" value="{{ old('price') }}" required placeholder="np. 45000" class="mt-1 block w-full rounded-md bg-slate-950 text-slate-100 border-slate-800 shadow-sm focus:border-blue-500 focus:ring-blue-500 font-bold">
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                        <div class="flex items-center">
                            <label class="flex items-center">
                                <input type="checkbox" name="is_accident_free" class="rounded bg-slate-950 border-slate-800 text-blue-600 focus:ring-blue-500 shadow-sm" {{ old('is_accident_free') ? 'checked' : '' }}>
                                <span class="ml-2 text-sm text-white font-bold">Pojazd w 100% bezwypadkowy</span>
                            </label>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-slate-400">Kraj pochodzenia</label>
                            <select name="origin_country" required class="mt-1 block w-full rounded-md bg-slate-950 text-slate-100 border-slate-800 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                                <option value="Polska" class="bg-slate-900 text-white" {{ old('origin_country') == 'Polska' ? 'selected' : '' }}>Polska</option>
                                <option value="Niemcy" class="bg-slate-900 text-white" {{ old('origin_country') == 'Niemcy' ? 'selected' : '' }}>Niemcy</option>
                                <option value="Francja" class="bg-slate-900 text-white" {{ old('origin_country') == 'Francja' ? 'selected' : '' }}>Francja</option>
                                <option value="Belgia" class="bg-slate-900 text-white" {{ old('origin_country') == 'Belgia' ? 'selected' : '' }}>Belgia</option>
                                <option value="Holandia" class="bg-slate-900 text-white" {{ old('origin_country') == 'Holandia' ? 'selected' : '' }}>Holandia</option>
                                <option value="USA" class="bg-slate-900 text-white" {{ old('origin_country') == 'USA' ? 'selected' : '' }}>USA</option>
                                <option value="Inny" class="bg-slate-900 text-white" {{ old('origin_country') == 'Inny' ? 'selected' : '' }}>Inny kraj</option>
                            </select>
                        </div>
                    </div>

                    <div class="mb-6">
                        <label class="block text-sm font-medium text-slate-400">Ewentualny opis uszkodzeń (jeśli zaznaczono auto jako powypadkowe)</label>
                        <textarea name="accident_description" rows="2" class="mt-1 block w-full rounded-md bg-slate-950 text-slate-100 border-slate-800 shadow-sm focus:border-blue-500 focus:ring-blue-500">{{ old('accident_description') }}</textarea>
                    </div>

                    <div class="mb-8">
                        <label class="block text-sm font-medium text-slate-400">Szczegółowa notatka komisu (Opis stanu faktycznego) *</label>
                        <textarea name="usage_description" rows="5" required class="mt-1 block w-full rounded-md bg-slate-950 text-slate-100 border-slate-800 shadow-sm focus:border-blue-500 focus:ring-blue-500 placeholder-slate-600" placeholder="np. Auto użytkowane głównie na autostradach. Garażowane...">{{ old('usage_description') }}</textarea>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
                        <div class="bg-slate-950 p-4 rounded-lg border border-slate-800">
                            <label class="block text-sm font-bold text-white mb-2">Zdjęcie główne (Miniaturka)</label>
                            <input type="file" name="image" accept="image/*" class="block w-full text-sm text-slate-400 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-slate-900 file:text-blue-400 hover:file:bg-slate-800 transition">
                        </div>
                        <div class="bg-slate-950 p-4 rounded-lg border border-blue-950/60">
                            <label class="block text-sm font-bold text-blue-400 mb-2">Galeria Dodatkowa (Zaznacz wiele)</label>
                            <input type="file" name="gallery[]" multiple accept="image/*" class="block w-full text-sm text-slate-400 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-bold file:bg-blue-600 file:text-white hover:file:bg-blue-500 transition">
                        </div>
                    </div>

                    <div class="flex justify-end border-t border-slate-800 pt-4">
                        <a href="{{ route('dashboard') }}" class="bg-slate-800 hover:bg-slate-700 text-slate-300 font-bold py-3 px-6 rounded-lg text-sm transition mr-4">Anuluj</a>
                        <button type="submit" class="bg-blue-600 hover:bg-blue-500 text-white font-bold py-3 px-6 rounded-lg text-sm transition duration-150 shadow-md">
                            Zapisz Samochód w Bazie
                        </button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</x-app-layout>
