<x-app-layout>
    <x-slot name="header">
        <div class="bg-slate-900 border-b-2 border-blue-600 p-4 rounded-xl shadow-xl flex justify-between items-center">
            <h2 class="font-black text-xl text-white tracking-tight">
                Edycja pojazdu: <span class="text-blue-500">{{ $car->brand }} {{ $car->model }}</span> <span class="text-xs font-mono text-slate-500">({{ $car->vin }})</span>
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

                <form action="{{ route('cars.update', $car) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <h3 class="text-lg font-bold text-white border-b border-slate-800 pb-2 mb-4">Podstawowe dane identyfikacyjne</h3>
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-6">
                        <div>
                            <label class="block text-sm font-medium text-slate-400">Numer VIN (17 znaków)</label>
                            <input type="text" name="vin" value="{{ old('vin', $car->vin) }}" required class="mt-1 block w-full rounded-md bg-slate-950 text-slate-100 border-slate-800 shadow-sm focus:ring-blue-500 focus:border-blue-500 uppercase">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-slate-400">Marka</label>
                            <input type="text" name="brand" value="{{ old('brand', $car->brand) }}" required class="mt-1 block w-full rounded-md bg-slate-950 text-slate-100 border-slate-800 shadow-sm focus:ring-blue-500 focus:border-blue-500">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-slate-400">Model</label>
                            <input type="text" name="model" value="{{ old('model', $car->model) }}" required class="mt-1 block w-full rounded-md bg-slate-950 text-slate-100 border-slate-800 shadow-sm focus:ring-blue-500 focus:border-blue-500">
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
                        <div>
                            <label class="block text-sm font-medium text-slate-400">Typ nadwozia</label>
                            <select name="generation" required class="mt-1 block w-full rounded-md bg-slate-950 text-slate-100 border-slate-800 shadow-sm focus:ring-blue-500 focus:border-blue-500">
                                <option value="Sedan" {{ $car->generation == 'Sedan' ? 'selected' : '' }} class="bg-slate-900 text-white">Sedan</option>
                                <option value="Kombi" {{ $car->generation == 'Kombi' ? 'selected' : '' }} class="bg-slate-900 text-white">Kombi</option>
                                <option value="Hatchback" {{ $car->generation == 'Hatchback' ? 'selected' : '' }} class="bg-slate-900 text-white">Hatchback</option>
                                <option value="SUV" {{ $car->generation == 'SUV' ? 'selected' : '' }} class="bg-slate-900 text-white">SUV / Offroad</option>
                                <option value="Coupe" {{ $car->generation == 'Coupe' ? 'selected' : '' }} class="bg-slate-900 text-white">Coupe</option>
                                <option value="Cabriolet" {{ $car->generation == 'Cabriolet' ? 'selected' : '' }} class="bg-slate-900 text-white">Cabriolet</option>
                                <option value="Minivan" {{ $car->generation == 'Minivan' ? 'selected' : '' }} class="bg-slate-900 text-white">Minivan</option>
                            </select>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-slate-400">Rok produkcji</label>
                            <input type="number" name="production_year" value="{{ old('production_year', $car->production_year) }}" required min="1900" class="mt-1 block w-full rounded-md bg-slate-950 text-slate-100 border-slate-800 shadow-sm focus:ring-blue-500 focus:border-blue-500">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-slate-400">Pierwsza rejestracja</label>
                            <input type="date" name="first_registration_date" value="{{ old('first_registration_date', $car->first_registration_date ? \Carbon\Carbon::parse($car->first_registration_date)->format('Y-m-d') : '') }}" class="mt-1 block w-full rounded-md bg-slate-950 text-slate-100 border-slate-800 shadow-sm focus:ring-blue-500 focus:border-blue-500">
                        </div>
                    </div>

                    <h3 class="text-lg font-bold text-white border-b border-slate-800 pb-2 mb-4">Dane Techniczne</h3>
                    <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
                        <div>
                            <label class="block text-sm font-medium text-slate-400">Pojemność silnika (cm³)</label>
                            <input type="number" name="engine_capacity" value="{{ old('engine_capacity', $car->engine_capacity) }}" required class="mt-1 block w-full rounded-md bg-slate-950 text-slate-100 border-slate-800 shadow-sm focus:ring-blue-500 focus:border-blue-500">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-slate-400">Moc (KM)</label>
                            <input type="number" name="engine_power" value="{{ old('engine_power', $car->engine_power) }}" required class="mt-1 block w-full rounded-md bg-slate-950 text-slate-100 border-slate-800 shadow-sm focus:ring-blue-500 focus:border-blue-500">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-slate-400">Kod silnika</label>
                            <input type="text" name="engine_code" value="{{ old('engine_code', $car->engine_code) }}" class="mt-1 block w-full rounded-md bg-slate-950 text-slate-100 border-slate-800 shadow-sm focus:ring-blue-500 focus:border-blue-500">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-slate-400">Rodzaj paliwa</label>
                            <select name="fuel_type" class="mt-1 block w-full rounded-md bg-slate-950 text-slate-100 border-slate-800 shadow-sm focus:ring-blue-500 focus:border-blue-500">
                                <option value="Benzyna" {{ $car->fuel_type == 'Benzyna' ? 'selected' : '' }}>Benzyna</option>
                                <option value="Diesel" {{ $car->fuel_type == 'Diesel' ? 'selected' : '' }}>Diesel</option>
                                <option value="Hybryda" {{ $car->fuel_type == 'Hybryda' ? 'selected' : '' }}>Hybryda</option>
                                <option value="Elektryczny" {{ $car->fuel_type == 'Elektryczny' ? 'selected' : '' }}>Elektryczny</option>
                                <option value="LPG" {{ $car->fuel_type == 'LPG' ? 'selected' : '' }}>LPG</option>
                            </select>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-slate-400">Skrzynia biegów</label>
                            <select name="transmission" class="mt-1 block w-full rounded-md bg-slate-950 text-slate-100 border-slate-800 shadow-sm focus:ring-blue-500 focus:border-blue-500">
                                <option value="Manualna" {{ $car->transmission == 'Manualna' ? 'selected' : '' }}>Manualna</option>
                                <option value="Automatyczna" {{ $car->transmission == 'Automatyczna' ? 'selected' : '' }}>Automatyczna</option>
                            </select>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-slate-400">Rodzaj napędu</label>
                            <select name="drive_type" class="mt-1 block w-full rounded-md bg-slate-950 text-slate-100 border-slate-800 shadow-sm focus:ring-blue-500 focus:border-blue-500">
                                <option value="FWD" {{ $car->drive_type == 'FWD' ? 'selected' : '' }}>Na przednie koła (FWD)</option>
                                <option value="RWD" {{ $car->drive_type == 'RWD' ? 'selected' : '' }}>Na tylne koła (RWD)</option>
                                <option value="AWD" {{ $car->drive_type == 'AWD' ? 'selected' : '' }}>Na cztery koła (AWD/4x4)</option>
                            </select>
                        </div>
                    </div>

                    <h3 class="text-lg font-bold text-white border-b border-slate-800 pb-2 mb-4">Stan, Przebieg i Finanse</h3>
                    <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-6">
                        <div>
                            <label class="block text-sm font-medium text-slate-400">Aktualny przebieg (km)</label>
                            <input type="number" name="current_mileage" value="{{ old('current_mileage', $car->current_mileage) }}" required class="mt-1 block w-full rounded-md bg-slate-950 text-slate-100 border-slate-800 shadow-sm focus:ring-blue-500 focus:border-blue-500">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-slate-400">Status pojazdu</label>
                            <select name="status" class="mt-1 block w-full rounded-md bg-slate-950 text-slate-100 border-slate-800 shadow-sm focus:ring-blue-500 focus:border-blue-500">
                                <option value="w przygotowaniu" {{ $car->status == 'w przygotowaniu' ? 'selected' : '' }}>W przygotowaniu</option>
                                <option value="gotowy do sprzedaży" {{ $car->status == 'gotowy do sprzedaży' ? 'selected' : '' }}>Gotowy do sprzedaży</option>
                                <option value="zarezerwowany" {{ $car->status == 'zarezerwowany' ? 'selected' : '' }}>Zarezerwowany</option>
                                <option value="sprzedany" {{ $car->status == 'sprzedany' ? 'selected' : '' }}>Sprzedany</option>
                            </select>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-slate-400">Liczba poprzednich właścicieli</label>
                            <input type="number" name="previous_owners_count" value="{{ old('previous_owners_count', $car->previous_owners_count) }}" required class="mt-1 block w-full rounded-md bg-slate-950 text-slate-100 border-slate-800 shadow-sm focus:ring-blue-500 focus:border-blue-500">
                        </div>
                        <div>
                            <label class="block text-sm font-bold text-slate-400">Cena pojazdu (PLN) *</label>
                            <input type="number" name="price" value="{{ old('price', $car->price) }}" required class="mt-1 block w-full rounded-md bg-slate-950 text-slate-100 border-slate-800 shadow-sm focus:ring-blue-500 focus:border-blue-500 font-bold">
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                        <div class="flex items-center">
                            <input type="checkbox" name="is_accident_free" {{ $car->is_accident_free ? 'checked' : '' }} class="rounded bg-slate-950 border-slate-800 text-blue-600 focus:ring-blue-500">
                            <span class="ml-2 text-sm text-slate-400 font-bold">Pojazd w 100% bezwypadkowy</span>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-slate-400">Kraj pochodzenia</label>
                            <select name="origin_country" required class="mt-1 block w-full rounded-md bg-slate-950 text-slate-100 border-slate-800 shadow-sm focus:ring-blue-500 focus:border-blue-500">
                                <option value="Polska" {{ $car->origin_country == 'Polska' ? 'selected' : '' }} class="bg-slate-900 text-white">Polska</option>
                                <option value="Niemcy" {{ $car->origin_country == 'Niemcy' ? 'selected' : '' }} class="bg-slate-900 text-white">Niemcy</option>
                                <option value="Francja" {{ $car->origin_country == 'Francja' ? 'selected' : '' }} class="bg-slate-900 text-white">Francja</option>
                                <option value="Belgia" {{ $car->origin_country == 'Belgia' ? 'selected' : '' }} class="bg-slate-900 text-white">Belgia</option>
                                <option value="Holandia" {{ $car->origin_country == 'Holandia' ? 'selected' : '' }} class="bg-slate-900 text-white">Holandia</option>
                                <option value="USA" {{ $car->origin_country == 'USA' ? 'selected' : '' }} class="bg-slate-900 text-white">USA</option>
                                <option value="Inny" {{ $car->origin_country == 'Inny' ? 'selected' : '' }} class="bg-slate-900 text-white">Inny kraj</option>
                            </select>
                        </div>
                    </div>

                    <div class="mb-8">
                        <label class="block text-sm font-medium text-slate-400">Szczegółowa notatka komisu</label>
                        <textarea name="usage_description" rows="5" required class="mt-1 block w-full rounded-md bg-slate-950 text-slate-100 border-slate-800 focus:ring-blue-500 focus:border-blue-500">{{ old('usage_description', $car->usage_description) }}</textarea>
                    </div>

                    <div class="mb-8 bg-slate-950 p-4 rounded-lg border border-slate-800">
                        <label class="block text-sm font-bold text-white mb-4">Zdjęcie główne (Miniaturka)</label>
                        @if($car->image_path)
                            <div class="mb-4">
                                <img src="{{ asset('storage/' . $car->image_path) }}" alt="Aktualne zdjęcie" class="h-32 object-cover rounded border border-slate-800 shadow-lg">
                            </div>
                        @endif
                        <input type="file" name="image" accept="image/*" class="block w-full text-sm text-slate-400 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-blue-950 file:text-blue-400 hover:file:bg-blue-900 transition">
                    </div>

                    <div class="mb-8 bg-slate-950 p-4 rounded-lg border border-blue-950/60">
                        <label class="block text-sm font-bold text-slate-400 mb-4">Galeria Dodatkowa (Zarządzanie)</label>
                        @if($car->images->count() > 0)
                            <p class="text-sm text-slate-300 mb-2 font-medium">Obecne zdjęcia w galerii:</p>
                            <div class="grid grid-cols-2 md:grid-cols-4 lg:grid-cols-6 gap-4 mb-6">
                                @foreach($car->images as $image)
                                    <div class="relative bg-slate-900 border border-slate-800 rounded p-2 shadow-xl flex flex-col items-center">
                                        <img src="{{ asset('storage/' . $image->image_path) }}" class="h-20 w-full object-cover rounded mb-2">
                                        <label class="text-xs text-red-400 font-bold cursor-pointer flex items-center">
                                            <input type="checkbox" name="delete_images[]" value="{{ $image->id }}" class="mr-1 rounded bg-slate-950 border-red-900 text-red-600 focus:ring-red-500">
                                            Usuń
                                        </label>
                                    </div>
                                @endforeach
                            </div>
                        @endif
                        <p class="text-sm text-slate-400 mb-2 font-medium mt-4">Wgraj dodatkowe zdjęcia do galerii:</p>
                        <input type="file" name="gallery[]" multiple accept="image/*" class="block w-full text-sm text-slate-400 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-bold file:bg-blue-600 file:text-white hover:file:bg-blue-500 transition">
                    </div>

                    <div class="flex justify-end gap-4 border-t border-slate-800 pt-4">
                        <a href="{{ route('dashboard') }}" class="bg-slate-800 hover:bg-slate-700 text-slate-300 font-bold py-3 px-6 rounded-lg text-sm transition">Anuluj</a>
                        <button type="submit" class="bg-blue-600 hover:bg-blue-500 text-white font-bold py-3 px-6 rounded-lg text-sm transition shadow-md">
                            Zaktualizuj Dane
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
