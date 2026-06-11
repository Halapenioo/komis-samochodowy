@extends('layouts.public')

@section('content')
    <h2 class="text-3xl font-bold mb-6 text-slate-800 border-b-2 border-slate-300 pb-2">Nasza Flota - Sprawdzone Pojazdy</h2>

    <div class="bg-white p-6 rounded-xl shadow-md mb-8 border border-slate-200 text-slate-700">
        <form action="{{ route('cars.index') }}" method="GET" class="space-y-4">

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label class="block text-xs font-bold text-slate-500 uppercase mb-1">Kategoria</label>
                    <select disabled class="w-full rounded-md border-slate-300 bg-slate-50 text-slate-500 shadow-sm text-sm">
                        <option>Samochody osobowe</option>
                    </select>
                </div>
                <div>
                    <label class="block text-xs font-bold text-slate-600 uppercase mb-1">Marka pojazdu</label>
                    <select name="brand" class="w-full rounded-md border-slate-300 bg-white text-slate-900 shadow-sm focus:border-blue-500 focus:ring-blue-500 text-sm">
                        <option value="">Wszystkie marki</option>
                        @foreach($brands as $brand)
                            <option value="{{ $brand }}" {{ request('brand') == $brand ? 'selected' : '' }}>{{ $brand }}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-4">
                <div>
                    <label class="block text-xs font-bold text-slate-600 uppercase mb-1">Cena (PLN)</label>
                    <div class="flex space-x-2">
                        <input type="number" name="price_min" value="{{ request('price_min') }}" placeholder="Od" class="w-full rounded-md border-slate-300 bg-white text-slate-900 shadow-sm focus:border-blue-500 focus:ring-blue-500 text-sm">
                        <input type="number" name="price_max" value="{{ request('price_max') }}" placeholder="Do" class="w-full rounded-md border-slate-300 bg-white text-slate-900 shadow-sm focus:border-blue-500 focus:ring-blue-500 text-sm">
                    </div>
                </div>
                <div>
                    <label class="block text-xs font-bold text-slate-600 uppercase mb-1">Rok produkcji</label>
                    <div class="flex space-x-2">
                        <input type="number" name="year_min" value="{{ request('year_min') ?? request('year_from') }}" placeholder="Od" class="w-full rounded-md border-slate-300 bg-white text-slate-900 shadow-sm focus:border-blue-500 focus:ring-blue-500 text-sm">
                        <input type="number" name="year_max" value="{{ request('year_max') ?? request('year_to') }}" placeholder="Do" class="w-full rounded-md border-slate-300 bg-white text-slate-900 shadow-sm focus:border-blue-500 focus:ring-blue-500 text-sm">
                    </div>
                </div>
                <div>
                    <label class="block text-xs font-bold text-slate-600 uppercase mb-1">Paj. silnika (cm³)</label>
                    <div class="flex space-x-2">
                        <input type="number" name="engine_min" value="{{ request('engine_min') }}" placeholder="Od" class="w-full rounded-md border-slate-300 bg-white text-slate-900 shadow-sm focus:border-blue-500 focus:ring-blue-500 text-sm">
                        <input type="number" name="engine_max" value="{{ request('engine_max') }}" placeholder="Do" class="w-full rounded-md border-slate-300 bg-white text-slate-900 shadow-sm focus:border-blue-500 focus:ring-blue-500 text-sm">
                    </div>
                </div>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-4">
                <div>
                    <label class="block text-xs font-bold text-slate-600 uppercase mb-1">Przebieg (km)</label>
                    <div class="flex space-x-2">
                        <input type="number" name="mileage_min" value="{{ request('mileage_min') }}" placeholder="Od" class="w-full rounded-md border-slate-300 bg-white text-slate-900 shadow-sm focus:border-blue-500 focus:ring-blue-500 text-sm">
                        <input type="number" name="mileage_max" value="{{ request('mileage_max') }}" placeholder="Do" class="w-full rounded-md border-slate-300 bg-white text-slate-900 shadow-sm focus:border-blue-500 focus:ring-blue-500 text-sm">
                    </div>
                </div>
                <div>
                    <label class="block text-xs font-bold text-slate-600 uppercase mb-1">Moc silnika (KM)</label>
                    <div class="flex space-x-2">
                        <input type="number" name="power_min" value="{{ request('power_min') }}" placeholder="Od" class="w-full rounded-md border-slate-300 bg-white text-slate-900 shadow-sm focus:border-blue-500 focus:ring-blue-500 text-sm">
                        <input type="number" name="power_max" value="{{ request('power_max') }}" placeholder="Do" class="w-full rounded-md border-slate-300 bg-white text-slate-900 shadow-sm focus:border-blue-500 focus:ring-blue-500 text-sm">
                    </div>
                </div>
                <div>
                    <label class="block text-xs font-bold text-slate-600 uppercase mb-1">Paliwo</label>
                    <select name="fuel_type" class="w-full rounded-md border-slate-300 bg-white text-slate-900 shadow-sm focus:border-blue-500 focus:ring-blue-500 text-sm">
                        <option value="Wszystkie">Wszystkie rodzaje</option>
                        <option value="Benzyna" {{ request('fuel_type') == 'Benzyna' ? 'selected' : '' }}>Benzyna</option>
                        <option value="Diesel" {{ request('fuel_type') == 'Diesel' ? 'selected' : '' }}>Diesel</option>
                        <option value="Hybryda" {{ request('fuel_type') == 'Hybryda' ? 'selected' : '' }}>Hybryda</option>
                        <option value="Elektryczny" {{ request('fuel_type') == 'Elektryczny' ? 'selected' : '' }}>Elektryczny</option>
                        <option value="LPG" {{ request('fuel_type') == 'LPG' ? 'selected' : '' }}>LPG</option>
                    </select>
                </div>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-4">
                <div>
                    <label class="block text-xs font-bold text-slate-600 uppercase mb-1">Napęd</label>
                    <select name="drive_type" class="w-full rounded-md border-slate-300 bg-white text-slate-900 shadow-sm focus:border-blue-500 focus:ring-blue-500 text-sm">
                        <option value="Wszystkie">Wszystkie</option>
                        <option value="FWD" {{ request('drive_type') == 'FWD' ? 'selected' : '' }}>Przedni (FWD)</option>
                        <option value="RWD" {{ request('drive_type') == 'RWD' ? 'selected' : '' }}>Tylny (RWD)</option>
                        <option value="AWD" {{ request('drive_type') == 'AWD' ? 'selected' : '' }}>Cztery koła (4x4)</option>
                    </select>
                </div>
                <div>
                    <label class="block text-xs font-bold text-slate-600 uppercase mb-1">Skrzynia biegów</label>
                    <select name="transmission" class="w-full rounded-md border-slate-300 bg-white text-slate-900 shadow-sm focus:border-blue-500 focus:ring-blue-500 text-sm">
                        <option value="Wszystkie">Wszystkie</option>
                        <option value="Manualna" {{ request('transmission') == 'Manualna' ? 'selected' : '' }}>Manualna</option>
                        <option value="Automatyczna" {{ request('transmission') == 'Automatyczna' ? 'selected' : '' }}>Automatyczna</option>
                    </select>
                </div>
                <div>
                    <label class="block text-xs font-bold text-slate-600 uppercase mb-1">Typ nadwozia</label>
                    <select name="generation" class="w-full rounded-md border-slate-300 bg-white text-slate-900 shadow-sm focus:border-blue-500 focus:ring-blue-500 text-sm">
                        <option value="">Wszystkie nadwozia</option>
                        <option value="Sedan" {{ request('generation') == 'Sedan' ? 'selected' : '' }}>Sedan</option>
                        <option value="Kombi" {{ request('generation') == 'Kombi' ? 'selected' : '' }}>Kombi</option>
                        <option value="Hatchback" {{ request('generation') == 'Hatchback' ? 'selected' : '' }}>Hatchback</option>
                        <option value="SUV" {{ request('generation') == 'SUV' ? 'selected' : '' }}>SUV / Offroad</option>
                        <option value="Coupe" {{ request('generation') == 'Coupe' ? 'selected' : '' }}>Coupe</option>
                        <option value="Cabriolet" {{ request('generation') == 'Cabriolet' ? 'selected' : '' }}>Cabriolet</option>
                        <option value="Minivan" {{ request('generation') == 'Minivan' ? 'selected' : '' }}>Minivan</option>
                    </select>
                </div>
                <div>
                    <label class="block text-xs font-bold text-slate-600 uppercase mb-1">Kraj pochodzenia</label>
                    <select name="origin_country" class="w-full rounded-md border-slate-300 bg-white text-slate-900 shadow-sm focus:border-blue-500 focus:ring-blue-500 text-sm">
                        <option value="">Wszystkie kraje</option>
                        <option value="Polska" {{ request('origin_country') == 'Polska' ? 'selected' : '' }}>Polska</option>
                        <option value="Niemcy" {{ request('origin_country') == 'Niemcy' ? 'selected' : '' }}>Niemcy</option>
                        <option value="Francja" {{ request('origin_country') == 'Francja' ? 'selected' : '' }}>Francja</option>
                        <option value="Belgia" {{ request('origin_country') == 'Belgia' ? 'selected' : '' }}>Belgia</option>
                        <option value="Holandia" {{ request('origin_country') == 'Holandia' ? 'selected' : '' }}>Holandia</option>
                        <option value="USA" {{ request('origin_country') == 'USA' ? 'selected' : '' }}>USA</option>
                        <option value="Inny" {{ request('origin_country') == 'Inny' ? 'selected' : '' }}>Inny kraj</option>
                    </select>
                </div>
            </div>

            <div class="flex flex-col md:flex-row md:justify-between md:items-center gap-4 pt-2 border-t border-slate-100">
                <div class="flex items-center">
                    <input type="checkbox" name="is_accident_free" value="1" {{ request('is_accident_free') ? 'checked' : '' }} class="rounded border-slate-300 text-blue-600 focus:ring-blue-500 h-5 w-5 bg-white">
                    <label class="ml-2 text-sm font-bold text-slate-700 cursor-pointer select-none">Stan techniczny: Tylko pojazdy bezwypadkowe</label>
                </div>
                <div class="flex space-x-2 w-full md:w-auto">
                    <a href="{{ route('cars.index') }}" class="w-1/2 md:w-28 bg-slate-200 hover:bg-slate-300 text-slate-800 font-bold py-2 rounded-lg text-sm text-center transition shadow-sm">
                        Resetuj
                    </a>
                    <button type="submit" class="w-1/2 md:w-40 bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 rounded-lg text-sm transition shadow-md">
                        Uruchom filtry
                    </button>
                </div>
            </div>
        </form>
    </div>

    @if($cars->count() > 0)
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach($cars as $car)
                <div class="bg-white rounded-xl shadow-md overflow-hidden border-t-4 {{ $car->is_accident_free ? 'border-emerald-500' : 'border-amber-500' }} hover:shadow-xl transition duration-300 flex flex-col">

                    @if($car->image_path)
                        <img src="{{ asset('storage/' . $car->image_path) }}" alt="{{ $car->brand }} {{ $car->model }}" class="w-full h-48 object-cover border-b">
                    @else
                        <div class="w-full h-48 bg-slate-100 flex items-center justify-center text-slate-400 border-b">
                            <span class="text-sm font-medium">Brak zdjęcia</span>
                        </div>
                    @endif

                    <div class="p-6 flex-grow text-slate-900">
                        <div class="flex justify-between items-start mb-2">
                            <h3 class="text-xl font-bold">{{ $car->brand }} {{ $car->model }}</h3>
                            <span class="text-xl font-black text-emerald-600 whitespace-nowrap">
                                {{ number_format($car->price, 0, '', ' ') }} PLN
                            </span>
                        </div>
                        <p class="text-slate-500 text-sm mb-4">VIN: <span class="font-mono">{{ $car->vin }}</span></p>

                        <ul class="text-sm text-slate-700 space-y-2 mb-6 bg-slate-50 p-3 rounded-lg border border-slate-200">
                            <li class="flex justify-between"><span>Rocznik:</span> <strong>{{ $car->production_year }}</strong></li>
                            <li class="flex justify-between"><span>Nadwozie:</span> <strong>{{ $car->generation }}</strong></li>
                            <li class="flex justify-between"><span>Kraj pochodzenia:</span> <strong>{{ $car->origin_country }}</strong></li>
                            <li class="flex justify-between"><span>Przebieg:</span> <strong>{{ number_format($car->current_mileage, 0, '', ' ') }} km</strong></li>
                            <li class="flex justify-between"><span>Silnik:</span> <strong>{{ $car->engine_capacity }} cm³ ({{ $car->engine_power }} KM)</strong></li>
                            <li class="flex justify-between"><span>Paliwo:</span> <strong>{{ $car->fuel_type }}</strong></li>
                        </ul>
                    </div>
                    <div class="p-6 pt-0 mt-auto">
                        <div class="flex justify-between items-center mt-4">
                            <span class="px-3 py-1 bg-slate-200 text-xs font-bold rounded-full uppercase tracking-wider text-slate-700">{{ $car->status }}</span>
                            <a href="{{ route('cars.show', $car) }}" class="bg-blue-600 text-white font-semibold px-4 py-2 rounded-lg hover:bg-blue-700 transition shadow-sm">Pełna Historia &rarr;</a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @else
        <div class="bg-white rounded-xl shadow-md p-12 text-center border border-slate-200">
            <div class="text-5xl mb-4">🔍</div>
            <h3 class="text-2xl font-bold text-slate-700 mb-2">Brak wyników</h3>
            <p class="text-slate-500">Nie znaleźliśmy samochodów spełniających Twoje kryteria wyszukiwania. Spróbuj wyczyścić filtry.</p>
        </div>
    @endif
@endsection
