<x-app-layout>
    <x-slot name="header">
        <div class="bg-slate-900 border-b-2 border-blue-600 p-4 rounded-xl shadow-xl">
            <h2 class="font-black text-xl text-white tracking-tight">
                {{ __('Skrzynka Zgłoszeń CRM') }}
            </h2>
        </div>
    </x-slot>

    <div class="py-12 bg-slate-950 min-h-screen text-slate-100">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            @if(session('success'))
                <div class="mb-6 bg-emerald-950 border border-emerald-500 text-emerald-200 p-4 rounded-lg font-bold shadow-lg">
                    <p class="font-bold">Sukces!</p>
                    <p class="font-normal text-sm">{{ session('success') }}</p>
                </div>
            @endif

            <div class="mb-4">
                <a href="{{ route('dashboard') }}" class="text-blue-500 hover:text-blue-400 font-semibold transition">&larr; Wróć do pulpitu głównego</a>
            </div>

            <div class="bg-slate-900 shadow-2xl sm:rounded-lg overflow-hidden border border-slate-800 border-t-4 border-blue-600">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="bg-slate-950 text-slate-400 text-sm uppercase tracking-wider">
                            <th class="p-4">Klient</th>
                            <th class="p-4">Dotyczy auta</th>
                            <th class="p-4">Typ / Wiadomość</th>
                            <th class="p-4">Status</th>
                            <th class="p-4 text-right">Zmień status</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-800 text-sm text-slate-300">
                        @forelse($inquiries as $inquiry)
                            <tr class="hover:bg-slate-800/40 transition {{ $inquiry->status == 'nowe' ? 'bg-blue-950/20' : '' }}">
                                <td class="p-4">
                                    <strong class="text-white block font-black text-base">{{ $inquiry->name }}</strong>
                                    <span class="text-slate-400 block text-xs mt-0.5">{{ $inquiry->email }}</span>
                                    <span class="text-slate-400 block text-xs">{{ $inquiry->phone ?? 'Brak telefonu' }}</span>
                                    <span class="text-slate-500 block text-[10px] font-mono mt-1">{{ $inquiry->created_at->format('d.m.Y H:i') }}</span>
                                </td>
                                <td class="p-4">
                                    @if($inquiry->car)
                                        <span class="font-bold text-white block">{{ $inquiry->car->brand }} {{ $inquiry->car->model }}</span>
                                        <span class="block text-xs font-mono text-blue-400 mt-0.5">{{ $inquiry->car->vin }}</span>
                                    @else
                                        <span class="text-red-400 italic">Pojazd usunięty</span>
                                    @endif
                                </td>
                                <td class="p-4 max-w-md">
                                    <span class="inline-block px-2 py-0.5 text-xs font-bold rounded mb-2 {{ $inquiry->type == 'jazda_probna' ? 'bg-indigo-950 text-indigo-400 border border-indigo-900' : 'bg-slate-950 text-slate-400 border border-slate-800' }}">
                                        {{ $inquiry->type == 'jazda_probna' ? '🏎 Jazda próbna' : '✉ Zapytanie' }}
                                    </span>
                                    <p class="text-slate-300 italic bg-slate-950 p-3 rounded border border-slate-850 shadow-inner text-xs leading-relaxed">"{{ $inquiry->message }}"</p>
                                </td>
                                <td class="p-4">
                                    @if($inquiry->status == 'nowe')
                                        <span class="px-2 py-0.5 text-xs font-bold rounded bg-blue-950 text-blue-400 border border-blue-900 uppercase">Nowe</span>
                                    @elseif($inquiry->status == 'w_toku')
                                        <span class="px-2 py-0.5 text-xs font-bold rounded bg-amber-950 text-amber-400 border border-amber-900 uppercase">W kontakcie</span>
                                    @else
                                        <span class="px-2 py-0.5 text-xs font-bold rounded bg-slate-950 text-slate-400 border border-slate-800 uppercase">Zamknięte</span>
                                    @endif
                                </td>
                                <td class="p-4 text-right">
                                    <form action="{{ route('inquiries.updateStatus', $inquiry) }}" method="POST" class="inline-block">
                                        @csrf
                                        @method('PATCH')
                                        <select name="status" onchange="this.form.submit()" class="text-xs bg-slate-950 text-slate-100 rounded border-slate-800 py-1 focus:ring-blue-500 focus:border-blue-500">
                                            <option value="nowe" {{ $inquiry->status == 'nowe' ? 'selected' : '' }} class="bg-slate-900 text-white">Nowe</option>
                                            <option value="w_toku" {{ $inquiry->status == 'w_toku' ? 'selected' : '' }} class="bg-slate-900 text-white">W kontakcie</option>
                                            <option value="zamkniete" {{ $inquiry->status == 'zamkniete' ? 'selected' : '' }} class="bg-slate-900 text-white">Zamknięte</option>
                                        </select>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="p-8 text-center text-slate-500 font-medium">Brak wiadomości w skrzynce zgłoszeniowej.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

        </div>
    </div>
</x-app-layout>
