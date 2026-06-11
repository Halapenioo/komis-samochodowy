<x-app-layout>
    <x-slot name="header">
        <div class="bg-slate-900 border-b-4 border-blue-600 p-4 rounded-xl shadow-xl flex justify-between items-center">
            <h2 class="font-black text-2xl text-white tracking-tight">
                @can('is_staff')
                    ⚙ PANEL ZARZĄDZANIA: <span class="text-blue-500">UczciwyKomis PRO</span>
                @else
                    🪪 STREFA KLIENTA: <span class="text-blue-500">Historia i Usługi</span>
                @endcan
            </h2>
            <div class="text-right">
                <span class="text-xs font-mono text-slate-400 bg-slate-950 px-3 py-1 rounded border border-slate-800">Użytkownik: {{ auth()->user()->name }}</span>
                <p class="text-[10px] uppercase text-blue-500 font-bold mt-1">Rola: {{ auth()->user()->role }}</p>
            </div>
        </div>
    </x-slot>

    <div class="py-12 bg-slate-950 min-h-screen text-slate-100">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            @if(session('success'))
                <div class="mb-6 bg-emerald-950 border border-emerald-500 text-emerald-200 p-4 rounded-lg font-bold shadow-lg">
                    ✓ {{ session('success') }}
                </div>
            @endif

            @can('is_staff')
                <div class="mb-8">
                    <a href="{{ route('cars.index') }}" class="block w-full bg-white hover:bg-slate-200 text-slate-900 text-center font-black py-4 rounded-xl shadow-lg transition transform hover:-translate-y-0.5 border border-slate-300 text-lg uppercase tracking-wider">
                        🚗 Przejdź do katalogu pojazdów (Oferty)
                    </a>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-10">
                    @can('admin_cars')
                        <div class="bg-slate-900 p-6 rounded-xl border border-slate-800 shadow-xl flex flex-col justify-between">
                            <div>
                                <span class="text-[10px] bg-blue-950 text-blue-400 font-bold px-2 py-0.5 rounded border border-blue-900 font-mono uppercase">Student 1</span>
                                <h4 class="text-xl font-black text-white mt-2 mb-1">Flota i Ogłoszenia</h4>
                                <p class="text-xs text-slate-400 leading-relaxed">Pełne zarządzanie autami na placu, dodawanie napraw mechanicznych oraz grubości powłoki lakierniczej.</p>
                            </div>
                            <a href="{{ route('cars.create') }}" class="mt-4 block w-full bg-blue-600 hover:bg-blue-500 text-white text-center font-bold py-2 rounded-lg transition shadow-md">+ Dodaj nowy pojazd</a>
                        </div>

                        <div class="bg-slate-900 p-6 rounded-xl border border-slate-800 shadow-xl flex flex-col justify-between">
                            <div>
                                <span class="text-[10px] bg-purple-950 text-purple-400 font-bold px-2 py-0.5 rounded border border-purple-900 font-mono uppercase">Student 1 / CRM</span>
                                <h4 class="text-xl font-black text-white mt-2 mb-1">Wiadomości i CRM</h4>
                                <p class="text-xs text-slate-400 leading-relaxed">Agregacja wszystkich zapytań o oferty i rezerwacji terminów na jazdy próbne.</p>
                            </div>
                            <a href="{{ route('inquiries.index') }}" class="mt-4 block w-full bg-emerald-600 hover:bg-emerald-500 text-white text-center font-bold py-2 rounded-lg transition shadow-md">📬 Skrzynka CRM</a>
                        </div>
                    @endcan

                    @can('admin_reviews')
                        <div class="bg-slate-900 p-6 rounded-xl border border-slate-800 shadow-xl flex flex-col justify-between">
                            <div>
                                <span class="text-[10px] bg-amber-950 text-amber-400 font-bold px-2 py-0.5 rounded border border-amber-900 font-mono uppercase">Student 2 / ACL</span>
                                <h4 class="text-xl font-black text-white mt-2 mb-1">Konta i Uprawnienia</h4>
                                <p class="text-xs text-slate-400 leading-relaxed">Pełne zarządzanie profilami, statusami i uprawnieniami kont zarejestrowanych w komisie.</p>
                            </div>
                            <a href="{{ route('users.index') }}" class="mt-4 block w-full bg-amber-600 hover:bg-amber-500 text-white text-center font-bold py-2 rounded-lg transition shadow-md">👥 Lista Użytkowników</a>
                        </div>
                    @endcan

                    @can('admin_repairs')
                        <div class="bg-slate-900 p-6 rounded-xl border border-slate-800 shadow-xl flex flex-col justify-between">
                            <div>
                                <span class="text-[10px] bg-red-950 text-red-400 font-bold px-2 py-0.5 rounded border border-red-900 font-mono uppercase">Student 3</span>
                                <h4 class="text-xl font-black text-white mt-2 mb-1">Warsztat Mechaniczny</h4>
                                <p class="text-xs text-slate-400 leading-relaxed">Zarządzanie harmonogramem oraz statusem prac serwisowych pojazdów klientów.</p>
                            </div>
                            <a href="#" class="mt-4 block w-full bg-slate-800 text-slate-400 cursor-not-allowed text-center font-bold py-2 rounded-lg transition shadow-md">Zarządzaj poniżej ↓</a>
                        </div>
                    @endcan
                </div>

                @can('admin_cars')
                    <div class="bg-slate-900 rounded-xl border border-slate-800 shadow-2xl p-6 mb-10">
                        <h3 class="text-lg font-black text-white border-b border-slate-800 pb-3 mb-4 flex justify-between items-center">
                            <span>🚗 MODUŁ 1 (Student 1): Stan Floty Aut na Placu</span>
                            <span class="text-xs font-mono text-slate-500">Tabela: cars</span>
                        </h3>

                        <form method="GET" action="{{ route('dashboard') }}" class="grid grid-cols-1 sm:grid-cols-3 gap-4 mb-6 bg-slate-950 p-4 rounded-xl border border-slate-800">
                            <div>
                                <label class="block text-[11px] font-bold uppercase text-slate-400 mb-1">Filtruj po marce</label>
                                <input type="text" name="car_brand" value="{{ request('car_brand') }}" placeholder="np. Audi, Toyota..." class="w-full text-xs rounded bg-slate-900 text-white border-slate-700 focus:ring-blue-500">
                            </div>
                            <div>
                                <label class="block text-[11px] font-bold uppercase text-slate-400 mb-1">Filtruj po statusie</label>
                                <select name="car_status" class="w-full text-xs rounded bg-slate-900 text-white border-slate-700 focus:ring-blue-500">
                                    <option value="">-- Wszystkie statusy --</option>
                                    <option value="gotowy do sprzedaży" {{ request('car_status') == 'gotowy do sprzedaży' ? 'selected' : '' }}>Gotowy do sprzedaży</option>
                                    <option value="w przygotowaniu" {{ request('car_status') == 'w przygotowaniu' ? 'selected' : '' }}>W przygotowaniu</option>
                                    <option value="zarezerwowany" {{ request('car_status') == 'zarezerwowany' ? 'selected' : '' }}>Zarezerwowany</option>
                                    <option value="sprzedany" {{ request('car_status') == 'sprzedany' ? 'selected' : '' }}>Sprzedany</option>
                                </select>
                            </div>
                            <div class="flex items-end space-x-2">
                                <button type="submit" class="flex-1 bg-blue-600 hover:bg-blue-500 text-white text-xs font-bold py-2 px-4 rounded transition shadow-md">Filtruj</button>
                                <a href="{{ route('dashboard') }}" class="bg-slate-800 hover:bg-slate-700 text-slate-300 text-xs font-bold py-2 px-4 rounded transition text-center">Reset</a>
                            </div>
                        </form>

                        <div class="overflow-x-auto">
                            <table class="w-full text-left border-collapse text-sm">
                                <thead>
                                    <tr class="bg-slate-950 text-slate-400 uppercase text-xs">
                                        <th class="p-3">Samochód</th>
                                        <th class="p-3">Numer VIN</th>
                                        <th class="p-3">Status</th>
                                        <th class="p-3 text-right">Zarządzanie / Raporty / Usuwanie</th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-slate-800 text-slate-300">
                                    @forelse($cars as $car)
                                        <tr class="hover:bg-slate-800/40 transition">
                                            <td class="p-3 font-bold text-white">{{ $car->brand }} {{ $car->model }} ({{ $car->production_year }})</td>
                                            <td class="p-3 font-mono text-xs text-blue-400">{{ $car->vin }}</td>
                                            <td class="p-3">
                                                <span class="px-2 py-0.5 text-xs font-bold rounded
                                                    @if($car->status == 'sprzedany') bg-red-950 text-red-400 border border-red-900
                                                    @elseif($car->status == 'zarezerwowany') bg-amber-950 text-amber-400 border border-amber-900
                                                    @elseif($car->status == 'w przygotowaniu') bg-blue-950 text-blue-400 border border-blue-900
                                                    @else bg-emerald-950 text-emerald-400 border border-emerald-900 @endif">
                                                    {{ $car->status }}
                                                </span>
                                            </td>
                                            <td class="p-3 text-right flex justify-end items-center space-x-1">
                                                <a href="{{ route('inspections.create', $car) }}" class="inline-block bg-slate-800 hover:bg-slate-700 text-xs text-slate-200 py-1 px-2 rounded">+ Lakier</a>
                                                <a href="{{ route('repairs.create', $car) }}" class="inline-block bg-slate-800 hover:bg-slate-700 text-xs text-slate-200 py-1 px-2 rounded">+ Naprawa</a>
                                                <a href="{{ route('cars.edit', $car) }}" class="inline-block bg-blue-950 border border-blue-900 hover:bg-blue-900 text-xs text-blue-400 py-1 px-2 rounded">Edytuj</a>

                                                <form action="{{ route('cars.destroy', $car) }}" method="POST" onsubmit="return confirm('Czy na pewno chcesz trwale usunąć ten samochód z portalu?');" class="inline-block">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="bg-red-600 text-white text-xs font-bold py-1 px-2 rounded hover:bg-red-500 transition shadow-sm">
                                                        Usuń
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr><td colspan="4" class="p-4 text-center text-slate-500">Brak samochodów spełniających kryteria.</td></tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                @endcan

                @can('admin_reviews')
                    <div class="bg-slate-900 rounded-xl border border-slate-800 shadow-2xl p-6 mb-10">
                        <h3 class="text-lg font-black text-white border-b border-slate-800 pb-3 mb-4 flex justify-between items-center">
                            <span>⭐ MODUŁ 2 (Student 2): Moderacja i Przegląd Opinii o Komisie</span>
                            <span class="text-xs font-mono text-slate-500">Tabela: reviews</span>
                        </h3>

                        <form method="GET" action="{{ route('dashboard') }}" class="grid grid-cols-1 sm:grid-cols-2 gap-4 mb-6 bg-slate-950 p-4 rounded-xl border border-slate-800">
                            <div>
                                <label class="block text-[11px] font-bold uppercase text-slate-400 mb-1">Sortuj według oceny</label>
                                <select name="review_sort" onchange="this.form.submit()" class="w-full text-xs rounded bg-slate-900 text-white border-slate-700 focus:ring-blue-500">
                                    <option value="desc" {{ request('review_sort') == 'desc' ? 'selected' : '' }}>Ocena: Od najwyższej (Malejąco)</option>
                                    <option value="asc" {{ request('review_sort') == 'asc' ? 'selected' : '' }}>Ocena: Od najniższej (Rosnąco)</option>
                                </select>
                            </div>
                            <div class="flex items-end">
                                <a href="{{ route('dashboard') }}" class="w-full bg-slate-800 hover:bg-slate-700 text-slate-300 text-xs font-bold py-2 px-4 rounded transition text-center">Resetuj filtry</a>
                            </div>
                        </form>

                        <div class="overflow-x-auto">
                            <table class="w-full text-left border-collapse text-sm">
                                <thead>
                                    <tr class="bg-slate-950 text-slate-400 uppercase text-xs">
                                        <th class="p-3">Użytkownik</th>
                                        <th class="p-3">Ocena</th>
                                        <th class="p-3">Treść opinii</th>
                                        <th class="p-3 text-right">Moderacja</th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-slate-800 text-slate-300">
                                    @forelse($reviews as $rev)
                                        <tr class="hover:bg-slate-800/40 transition">
                                            <td class="p-3 font-bold text-white">{{ $rev->user->name }} <br><span class="text-xs text-slate-500 font-normal">{{ $rev->user->email }}</span></td>
                                            <td class="p-3 text-amber-400 font-bold font-mono">{{ str_repeat('★', $rev->rating) }} ({{ $rev->rating }}/5)</td>
                                            <td class="p-3 text-slate-300 italic">"{{ $rev->comment }}"</td>
                                            <td class="p-3 text-right">
                                                <form action="{{ route('reviews.destroy', $rev) }}" method="POST">
                                                    @csrf @method('DELETE')
                                                    <button type="submit" class="bg-red-950 text-red-400 border border-red-900 text-xs py-1 px-3 rounded hover:bg-red-900 transition">Usuń opinię</button>
                                                </form>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr><td colspan="4" class="p-4 text-center text-slate-500">Brak opinii w bazie danych.</td></tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                @endcan

                @can('admin_repairs')
                    <div class="bg-slate-900 rounded-xl border border-slate-800 shadow-2xl p-6">
                        <h3 class="text-lg font-black text-white border-b border-slate-800 pb-3 mb-4 flex justify-between items-center">
                            <span>🔧 MODUŁ 3 (Student 3): Terminarz Warsztatu Mechanicznego</span>
                            <span class="text-xs font-mono text-slate-500">Tabela: service_appointments</span>
                        </h3>

                        <form method="GET" action="{{ route('dashboard') }}" class="grid grid-cols-1 sm:grid-cols-3 gap-4 mb-6 bg-slate-950 p-4 rounded-xl border border-slate-800">
                            <div>
                                <label class="block text-[11px] font-bold uppercase text-slate-400 mb-1">Filtruj po samochodzie</label>
                                <input type="text" name="app_car" value="{{ request('app_car') }}" placeholder="np. Audi, Opel..." class="w-full text-xs rounded bg-slate-900 text-white border-slate-700 focus:ring-blue-500">
                            </div>
                            <div>
                                <label class="block text-[11px] font-bold uppercase text-slate-400 mb-1">Dokładna data wizyty</label>
                                <input type="date" name="app_date" value="{{ request('app_date') }}" class="w-full text-xs rounded bg-slate-900 text-white border-slate-700 focus:ring-blue-500">
                            </div>
                            <div class="flex items-end space-x-2">
                                <button type="submit" class="flex-1 bg-blue-600 hover:bg-blue-500 text-white text-xs font-bold py-2 px-4 rounded transition shadow-md">Szukaj</button>
                                <a href="{{ route('dashboard') }}" class="bg-slate-800 hover:bg-slate-700 text-slate-300 text-xs font-bold py-2 px-4 rounded transition text-center">Reset</a>
                            </div>
                        </form>

                        <div class="overflow-x-auto">
                            <table class="w-full text-left border-collapse text-sm">
                                <thead>
                                    <tr class="bg-slate-950 text-slate-400 uppercase text-xs">
                                        <th class="p-3">Klient</th>
                                        <th class="p-3">Samochód klienta</th>
                                        <th class="p-3">Data wizyty</th>
                                        <th class="p-3">Opis awarii</th>
                                        <th class="p-3 text-right">Zmień Status naprawy</th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-slate-800 text-slate-300">
                                    @forelse($appointments as $app)
                                        <tr class="hover:bg-slate-800/40 transition">
                                            <td class="p-3 font-bold text-white">{{ $app->user->name }}</td>
                                            <td class="p-3 text-slate-200 font-medium">{{ $app->car_name }}</td>
                                            <td class="p-3 font-mono text-xs text-blue-400">{{ $app->appointment_date }}</td>
                                            <td class="p-3 text-xs text-slate-400 max-w-xs truncate">{{ $app->description }}</td>
                                            <td class="p-3 text-right">
                                                <form action="{{ route('appointments.update', $app) }}" method="POST">
                                                    @csrf @method('PUT')
                                                    <select name="status" onchange="this.form.submit()" class="bg-slate-950 text-xs rounded border-slate-800 text-slate-300 focus:ring-blue-500">
                                                        <option value="nowe" {{ $app->status == 'nowe' ? 'selected' : '' }}>Oczekuje</option>
                                                        <option value="w_naprawie" {{ $app->status == 'w_naprawie' ? 'selected' : '' }}>W naprawie</option>
                                                        <option value="gotowe" {{ $app->status == 'gotowe' ? 'selected' : '' }}>Gotowe</option>
                                                    </select>
                                                </form>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr><td colspan="5" class="p-4 text-center text-slate-500">Brak zaplanowanych napraw spełniających kryteria.</td></tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                @endcan

            @else
                <div class="mb-8">
                    <a href="{{ route('cars.index') }}" class="block w-full bg-white hover:bg-slate-200 text-slate-900 text-center font-black py-4 rounded-xl shadow-lg transition transform hover:-translate-y-0.5 border border-slate-300 text-lg uppercase tracking-wider">
                        🚗 Przejdź do katalogu pojazdów
                    </a>
                </div>

                <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                    <div class="space-y-8">
                        <div class="bg-slate-900 p-6 rounded-xl border border-slate-800 shadow-xl">
                            <span class="text-[10px] font-mono text-amber-400 font-bold bg-amber-950/40 px-2 py-0.5 rounded border border-amber-900 uppercase">Student 2 - CRUD Create</span>
                            <h3 class="text-xl font-black text-white mt-2 mb-4">⭐ Wystaw opinię o naszym komisie</h3>
                            <form action="{{ route('reviews.store') }}" method="POST" class="space-y-4">
                                @csrf
                                <div>
                                    <label class="block text-xs font-bold text-slate-400 mb-1">Twoja ocena (1-5 gwiazdek)</label>
                                    <select name="rating" required class="w-full text-sm rounded bg-white text-slate-900 border-slate-300 focus:ring-blue-500 focus:border-blue-500">
                                        <option value="5" class="bg-white text-slate-900">★★★★★ 5 / 5 (Doskonale)</option>
                                        <option value="4" class="bg-white text-slate-900">★★★★☆ 4 / 5 (Bardzo dobrze)</option>
                                        <option value="3" class="bg-white text-slate-900">★★★☆☆ 3 / 5 (Przeciętnie)</option>
                                        <option value="2" class="bg-white text-slate-900">★★☆☆☆ 2 / 5 (Słabo)</option>
                                        <option value="1" class="bg-white text-slate-900">★☆☆☆☆ 1 / 5 (Nie polecam)</option>
                                    </select>
                                </div>
                                <div>
                                    <label class="block text-xs font-bold text-slate-400 mb-1">Komentarz tekstowy</label>
                                    <textarea name="comment" rows="2" required placeholder="Napisz kilka słów o transakcji..." class="w-full text-sm rounded bg-white text-slate-900 border-slate-300 focus:ring-blue-500 focus:border-blue-500 placeholder-slate-400"></textarea>
                                </div>
                                <button type="submit" class="w-full bg-amber-600 hover:bg-amber-500 text-white font-bold py-2 rounded-lg transition shadow-md">Opublikuj Opinię</button>
                            </form>
                        </div>

                        <div class="bg-slate-900 p-6 rounded-xl border border-slate-800 shadow-xl">
                            <span class="text-[10px] font-mono text-blue-400 font-bold bg-blue-950/40 px-2 py-0.5 rounded border border-blue-900 uppercase">Student 3 - CRUD Create</span>
                            <h3 class="text-xl font-black text-white mt-2 mb-4">🔧 Zarezerwuj wizytę w naszym warsztacie</h3>
                            <form action="{{ route('appointments.store') }}" method="POST" class="space-y-4">
                                @csrf
                                <div class="grid grid-cols-2 gap-4">
                                    <div>
                                        <label class="block text-xs font-bold text-slate-400 mb-1">Twój samochód (Marka/Model)</label>
                                        <input type="text" name="car_name" required placeholder="np. Opel Astra" class="w-full text-sm rounded bg-white text-slate-900 border-slate-300 focus:ring-blue-500 focus:border-blue-500 placeholder-slate-400">
                                    </div>
                                    <div>
                                        <label class="block text-xs font-bold text-slate-400 mb-1">Preferowana data wizyty</label>
                                        <input type="date" name="appointment_date" required class="w-full text-sm rounded bg-white text-slate-900 border-slate-300 focus:ring-blue-500 focus:border-blue-500">
                                    </div>
                                </div>
                                <div>
                                    <label class="block text-xs font-bold text-slate-400 mb-1">Opis usterki / Co naprawić?</label>
                                    <textarea name="description" rows="2" required placeholder="Wymiana klocków hamulcowych, silnik nierówno pracuje..." class="w-full text-sm rounded bg-white text-slate-900 border-slate-300 focus:ring-blue-500 focus:border-blue-500 placeholder-slate-400"></textarea>
                                </div>
                                <button type="submit" class="w-full bg-blue-600 hover:bg-blue-500 text-white font-bold py-2 rounded-lg transition shadow-md">Zarezerwuj Wizytę</button>
                            </form>
                        </div>
                    </div>

                    <div class="space-y-8">
                        <div class="bg-slate-900 p-6 rounded-xl border border-slate-800 shadow-xl">
                            <h4 style="color: #ffffff !important;" class="font-black border-b border-slate-800 pb-2 mb-3 text-lg">Twoje wystawione opinie (Student 2)</h4>
                            @forelse($myReviews as $myRev)
                                <div class="bg-slate-950 p-4 rounded-lg border border-slate-800 mb-3 text-sm flex justify-between items-center">
                                    <div>
                                        <span style="color: #facc15 !important;" class="font-black font-mono text-base block tracking-wider">
                                            {{ str_repeat('★', $myRev->rating) }}
                                        </span>
                                        <p style="color: #ffffff !important;" class="text-xs italic mt-1">
                                            "{{ $myRev->comment }}"
                                        </p>
                                    </div>
                                    <div class="flex space-x-2">
                                        <a href="{{ route('reviews.edit', $myRev) }}" class="text-xs bg-blue-600 text-white py-1 px-3 rounded border border-blue-700 hover:bg-blue-500 font-bold transition shadow-sm flex items-center">
                                            Edytuj
                                        </a>
                                        <form action="{{ route('reviews.destroy', $myRev) }}" method="POST" onsubmit="return confirm('Usunąć tę opinię?');">
                                            @csrf @method('DELETE')
                                            <button type="submit" class="text-xs bg-red-600 text-white py-1 px-3 rounded border border-red-700 hover:bg-red-500 font-bold transition shadow-sm">Usuń</button>
                                        </form>
                                    </div>
                                </div>
                            @empty
                                <p style="color: #64748b !important;" class="text-xs text-center py-4">Nie dodałeś jeszcze żadnej opinii.</p>
                            @endforelse
                        </div>

                        <div class="bg-slate-900 p-6 rounded-xl border border-slate-800 shadow-xl">
                            <h4 style="color: #ffffff !important;" class="font-black border-b border-slate-800 pb-2 mb-3 text-lg">Twoje zgłoszenia serwisowe (Student 3)</h4>
                            @forelse($myAppointments as $myApp)
                                <div class="bg-slate-950 p-4 rounded-lg border border-slate-800 mb-3 text-sm flex justify-between items-center">
                                    <div>
                                        <span style="color: #ffffff !important;" class="font-bold text-base block">
                                            {{ $myApp->car_name }}
                                        </span>
                                        <p style="color: #93c5fd !important;" class="text-xs font-mono mt-0.5">
                                            Termin: {{ $myApp->appointment_date }}
                                        </p>
                                        <p style="color: #ffffff !important;" class="text-xs font-bold mt-1">
                                            Status: <span style="color: #facc15 !important;" class="uppercase font-mono">{{ $myApp->status }}</span>
                                        </p>
                                    </div>
                                    <form action="{{ route('appointments.destroy', $myApp) }}" method="POST" onsubmit="return confirm('Odwołać tę wizytę w warsztacie?');">
                                        @csrf @method('DELETE')
                                        <button type="submit" class="text-xs bg-red-600 text-white py-1 px-3 rounded border border-red-700 hover:bg-red-500 font-bold transition shadow-sm">Odwołaj</button>
                                    </form>
                                </div>
                            @empty
                                <p style="color: #64748b !important;" class="text-xs text-center py-4">Nie masz zaplanowanych napraw w serwisie.</p>
                            @endforelse
                        </div>
                    </div>
                </div>
            @endcan

        </div>
    </div>
</x-app-layout>
