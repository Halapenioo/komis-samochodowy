@extends('layouts.public')

@section('content')
    <div class="mb-6">
        <a href="{{ route('cars.index') }}" class="text-blue-600 hover:text-blue-800 font-medium">&larr; Wróć do listy pojazdów</a>
    </div>

    @if(session('success'))
        <div class="mb-6 bg-green-100 border-l-4 border-green-500 text-green-700 p-4 rounded shadow-sm">
            <p class="font-bold">{{ session('success') }}</p>
        </div>
    @endif

    <div class="bg-white rounded-xl shadow-lg p-8 mb-8 border-t-8 {{ $car->is_accident_free ? 'border-emerald-500' : 'border-amber-500' }}">
        <div class="flex flex-col md:flex-row justify-between items-start mb-8 gap-4">
            <div>
                <h2 class="text-4xl font-extrabold text-slate-900 mb-2">{{ $car->brand }} {{ $car->model }} <span class="text-2xl text-slate-400 font-normal">{{ $car->generation }}</span></h2>
                <p class="text-lg text-slate-600">Numer VIN: <span class="font-mono bg-slate-100 px-3 py-1 rounded-md border text-slate-800">{{ $car->vin }}</span></p>
            </div>
            <div>
                <span class="inline-flex items-center px-5 py-2 {{ $car->is_accident_free ? 'bg-emerald-100 text-emerald-800 border-emerald-200' : 'bg-amber-100 text-amber-800 border-amber-200' }} border rounded-full font-bold text-lg shadow-sm">
                    {{ $car->is_accident_free ? '✓ Pojazd Bezwypadkowy' : '⚠ Historia Kolizyjna' }}
                </span>
            </div>
        </div>

        <!-- KARUZELA ZDJĘĆ Z ALPINE.JS -->
        @php
            $allImages = [];
            if($car->image_path) $allImages[] = $car->image_path;
            foreach($car->images as $img) $allImages[] = $img->image_path;
        @endphp

        @if(count($allImages) > 0)
            <div x-data="{ activeSlide: 0, slides: @js($allImages) }" class="mb-8 bg-black rounded-xl overflow-hidden shadow-md border border-slate-200">

                <!-- Główne okno slajdera -->
                <div class="relative h-[300px] md:h-[600px] w-full flex items-center justify-center">
                    <template x-for="(slide, index) in slides" :key="index">
                        <img x-show="activeSlide === index" :src="'{{ asset('storage') }}/' + slide" class="absolute inset-0 w-full h-full object-contain transition-opacity duration-500" x-transition.opacity>
                    </template>

                    <!-- Przyciski Nawigacyjne (Lewo/Prawo) ukryte jeśli jest tylko 1 zdjęcie -->
                    <div x-show="slides.length > 1" class="absolute inset-0 flex items-center justify-between p-4 pointer-events-none">
                        <button @click="activeSlide = activeSlide === 0 ? slides.length - 1 : activeSlide - 1" class="pointer-events-auto bg-black/60 text-white rounded-full w-12 h-12 flex items-center justify-center hover:bg-blue-600 transition shadow-lg backdrop-blur-sm focus:outline-none">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path></svg>
                        </button>
                        <button @click="activeSlide = activeSlide === slides.length - 1 ? 0 : activeSlide + 1" class="pointer-events-auto bg-black/60 text-white rounded-full w-12 h-12 flex items-center justify-center hover:bg-blue-600 transition shadow-lg backdrop-blur-sm focus:outline-none">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
                        </button>
                    </div>
                </div>

                <!-- Miniaturki pod spodem -->
                <div x-show="slides.length > 1" class="flex overflow-x-auto gap-2 p-3 bg-slate-900 border-t border-slate-700 custom-scrollbar">
                    <template x-for="(slide, index) in slides" :key="index">
                        <button @click="activeSlide = index" class="flex-shrink-0 w-24 h-16 rounded overflow-hidden border-2 transition focus:outline-none" :class="activeSlide === index ? 'border-blue-500 opacity-100' : 'border-transparent opacity-50 hover:opacity-100'">
                            <img :src="'{{ asset('storage') }}/' + slide" class="w-full h-full object-cover">
                        </button>
                    </template>
                </div>
            </div>
        @endif
        <!-- KONIEC KARUZELI -->

        <div class="grid grid-cols-1 md:grid-cols-2 gap-8 mb-8">
            <div class="bg-slate-50 p-6 rounded-xl border border-slate-200">
                <h3 class="text-xl font-bold border-b border-slate-300 pb-2 mb-4 text-slate-800">Dane Techniczne</h3>
                <ul class="space-y-3 text-slate-700">
                    <li class="flex justify-between"><span>Rok produkcji:</span> <strong>{{ $car->production_year }}</strong></li>
                    <li class="flex justify-between"><span>Silnik:</span> <strong>{{ $car->engine_capacity }} cm³ / {{ $car->engine_power }} KM</strong></li>
                    <li class="flex justify-between"><span>Kod silnika:</span> <strong class="font-mono text-sm bg-white px-1 border rounded">{{ $car->engine_code }}</strong></li>
                    <li class="flex justify-between"><span>Skrzynia / Napęd:</span> <strong>{{ $car->transmission }} / {{ $car->drive_type }}</strong></li>
                </ul>
            </div>

            <div class="bg-slate-50 p-6 rounded-xl border border-slate-200">
                <h3 class="text-xl font-bold border-b border-slate-300 pb-2 mb-4 text-slate-800">Status w Komisie</h3>
                <ul class="space-y-3 text-slate-700">
                    <li class="flex justify-between"><span>Aktualny przebieg:</span> <strong class="text-blue-600 text-lg">{{ number_format($car->current_mileage, 0, '', ' ') }} km</strong></li>
                    <li class="flex justify-between"><span>Kraj pochodzenia:</span> <strong>{{ $car->origin_country }}</strong></li>
                    <li class="flex justify-between"><span>Poprzednich właścicieli:</span> <strong>{{ $car->previous_owners_count }}</strong></li>
                    <li class="flex justify-between"><span>Dostępność:</span> <strong class="uppercase text-slate-900">{{ $car->status }}</strong></li>
                </ul>
            </div>
        </div>

        <div>
            <h3 class="text-xl font-bold mb-3 text-slate-800">Opis stanu faktycznego (Notatka Komisu)</h3>
            <div class="text-slate-700 bg-white p-5 rounded-lg border border-slate-200 shadow-inner leading-relaxed">
                {{ $car->usage_description }}
            </div>
        </div>
    </div>

    <!-- Moduł Lakieru -->
    <h3 class="text-2xl font-black mb-4 text-slate-800 flex items-center"><span class="bg-blue-600 text-white w-8 h-8 flex justify-center items-center rounded-full mr-3 text-sm">1</span> Raport z pomiaru powłoki lakierniczej</h3>
    @foreach($car->inspections as $inspection)
        <div class="bg-white rounded-xl shadow-md p-6 mb-10 border border-slate-200">
            <div class="flex flex-wrap justify-between items-center mb-6 text-sm text-slate-500 bg-slate-50 p-3 rounded-lg border">
                <span>Data odczytu: <strong class="text-slate-800">{{ \Carbon\Carbon::parse($inspection->last_inspection_date)->format('d.m.Y') }}</strong></span>
                <span>Zanotowany przebieg: <strong class="text-slate-800">{{ number_format($inspection->mileage_at_inspection, 0, '', ' ') }} km</strong></span>
            </div>

            <div class="grid grid-cols-2 md:grid-cols-4 gap-4 text-center mb-6">
                <div class="border rounded-lg p-4 {{ $inspection->paint_thickness_hood > 150 ? 'bg-amber-50 border-amber-200' : 'bg-emerald-50 border-emerald-200' }}">
                    <span class="block text-sm font-semibold text-slate-600 mb-1">Maska</span>
                    <span class="font-black text-2xl {{ $inspection->paint_thickness_hood > 150 ? 'text-amber-600' : 'text-emerald-600' }}">{{ $inspection->paint_thickness_hood }} µm</span>
                </div>
                <div class="border rounded-lg p-4 {{ $inspection->paint_thickness_roof > 150 ? 'bg-amber-50 border-amber-200' : 'bg-emerald-50 border-emerald-200' }}">
                    <span class="block text-sm font-semibold text-slate-600 mb-1">Dach</span>
                    <span class="font-black text-2xl {{ $inspection->paint_thickness_roof > 150 ? 'text-amber-600' : 'text-emerald-600' }}">{{ $inspection->paint_thickness_roof }} µm</span>
                </div>
                <div class="border rounded-lg p-4 {{ $inspection->paint_thickness_left_side > 150 ? 'bg-amber-50 border-amber-200' : 'bg-emerald-50 border-emerald-200' }}">
                    <span class="block text-sm font-semibold text-slate-600 mb-1">Lewy bok</span>
                    <span class="font-black text-2xl {{ $inspection->paint_thickness_left_side > 150 ? 'text-amber-600' : 'text-emerald-600' }}">{{ $inspection->paint_thickness_left_side }} µm</span>
                </div>
                <div class="border rounded-lg p-4 {{ $inspection->paint_thickness_right_side > 150 ? 'bg-amber-50 border-amber-200' : 'bg-emerald-50 border-emerald-200' }}">
                    <span class="block text-sm font-semibold text-slate-600 mb-1">Prawy bok</span>
                    <span class="font-black text-2xl {{ $inspection->paint_thickness_right_side > 150 ? 'text-amber-600' : 'text-emerald-600' }}">{{ $inspection->paint_thickness_right_side }} µm</span>
                </div>
            </div>

            <div class="border-t pt-4">
                <span class="text-slate-500 text-sm font-bold uppercase">Zidentyfikowane mankamenty wizualne:</span>
                <p class="text-slate-800 mt-1 font-medium">{{ $inspection->known_defects ?? 'Brak zauważalnych wad' }}</p>
            </div>
        </div>
    @endforeach

    <!-- Moduł Napraw -->
    <h3 class="text-2xl font-black mb-4 text-slate-800 flex items-center"><span class="bg-blue-600 text-white w-8 h-8 flex justify-center items-center rounded-full mr-3 text-sm">2</span> Udokumentowane Naprawy i Użyte Części</h3>
    <div class="bg-white rounded-xl shadow-md overflow-hidden border border-slate-200 mb-12">
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-slate-800 text-white text-sm uppercase tracking-wider">
                        <th class="p-4">Data</th>
                        <th class="p-4">Przebieg (Zabezpieczenie)</th>
                        <th class="p-4">Wymieniony podzespół</th>
                        <th class="p-4">Numer seryjny / OEM</th>
                        <th class="p-4">Rodzaj części</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-200 text-slate-700">
                    @forelse($car->repairs as $repair)
                        <tr class="hover:bg-slate-50 transition">
                            <td class="p-4 whitespace-nowrap">{{ \Carbon\Carbon::parse($repair->repair_date)->format('d.m.Y') }}</td>
                            <td class="p-4 font-semibold">{{ number_format($repair->mileage_at_repair, 0, '', ' ') }} km</td>
                            <td class="p-4 font-bold text-slate-900">{{ $repair->replaced_part_name }}</td>
                            <td class="p-4"><span class="font-mono text-xs bg-slate-100 border px-2 py-1 rounded text-slate-600">{{ $repair->oem_number ?? 'Brak' }}</span></td>
                            <td class="p-4">
                                <span class="px-3 py-1 text-xs font-bold rounded-full {{ str_contains(strtolower($repair->part_status), 'oryginalna') ? 'bg-blue-100 text-blue-800 border-blue-200' : 'bg-slate-100 text-slate-800 border border-slate-200' }}">{{ $repair->part_status }}</span>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="p-6 text-center text-slate-500 font-medium">Brak udokumentowanych napraw w systemie komisu.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <!-- Formularz CRM -->
    <div class="bg-slate-900 text-white rounded-xl shadow-xl p-8 mb-12 border-b-8 border-blue-500">
        <h3 class="text-2xl font-black mb-2">Zainteresowany tym pojazdem?</h3>
        <p class="text-slate-400 mb-6">Wyślij zapytanie do doradcy komisu lub zarezerwuj termin na darmową jazdę próbną.</p>

        <form action="{{ route('inquiries.store', $car) }}" method="POST" class="space-y-4 text-slate-900">
            @csrf
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                <div>
                    <label class="block text-sm font-medium text-slate-300 mb-1">Imię i nazwisko</label>
                    <input type="text" name="name" required class="w-full rounded-md border-none bg-slate-800 text-white focus:ring-2 focus:ring-blue-500" placeholder="np. Jan Kowalski">
                </div>
                <div>
                    <label class="block text-sm font-medium text-slate-300 mb-1">Adres E-mail</label>
                    <input type="email" name="email" required class="w-full rounded-md border-none bg-slate-800 text-white focus:ring-2 focus:ring-blue-500" placeholder="np. jan@wp.pl">
                </div>
                <div>
                    <label class="block text-sm font-medium text-slate-300 mb-1">Numer telefonu (opcjonalnie)</label>
                    <input type="text" name="phone" class="w-full rounded-md border-none bg-slate-800 text-white focus:ring-2 focus:ring-blue-500" placeholder="np. 500 600 700">
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                <div class="md:col-span-1">
                    <label class="block text-sm font-medium text-slate-300 mb-1">Typ zgłoszenia</label>
                    <select name="type" required class="w-full rounded-md border-none bg-slate-800 text-white focus:ring-2 focus:ring-blue-500">
                        <option value="zapytanie">Zwykłe zapytanie o ofertę</option>
                        <option value="jazda_probna">Chcę umówić jazdę próbną</option>
                    </select>
                </div>
                <div class="md:col-span-2">
                    <label class="block text-sm font-medium text-slate-300 mb-1">Treść wiadomości</label>
                    <textarea name="message" rows="3" required class="w-full rounded-md border-none bg-slate-800 text-white focus:ring-2 focus:ring-blue-500" placeholder="Dzień dobry, interesuje mnie ten egzemplarz..."></textarea>
                </div>
            </div>

            <div class="flex justify-end pt-2">
                <button type="submit" class="bg-blue-600 hover:bg-blue-500 text-white font-bold py-3 px-8 rounded-lg shadow-md transition duration-150">
                    Wyślij Zgłoszenie
                </button>
            </div>
        </form>
    </div>
@endsection
