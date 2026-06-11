<x-app-layout>
    <x-slot name="header">
        <div class="bg-slate-900 border-b-2 border-blue-600 p-4 rounded-xl shadow-xl">
            <h2 class="font-black text-xl text-white tracking-tight">
                {{ __('Zarządzanie Zarejestrowanymi Użytkownikami (ACL)') }}
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

            @if($errors->any())
                <div class="mb-6 bg-red-950/50 text-red-400 p-4 rounded-lg border border-red-900">
                    @foreach($errors->all() as $error)
                        <p class="font-bold">{{ $error }}</p>
                    @endforeach
                </div>
            @endif

            <div class="mb-4">
                <a href="{{ route('dashboard') }}" class="text-blue-500 hover:text-blue-400 font-semibold transition">&larr; Wróć do pulpitu głównego</a>
            </div>

            <div class="bg-slate-900 shadow-2xl sm:rounded-lg overflow-hidden border border-slate-800 border-t-4 border-blue-600">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="bg-slate-950 text-slate-400 text-sm uppercase tracking-wider">
                            <th class="p-4">Imię i E-mail</th>
                            <th class="p-4">Data rejestracji</th>
                            <th class="p-4">Rola / Prawa dostępu</th>
                            <th class="p-4 text-right">Zarządzanie kontem</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-800 text-sm text-slate-300">
                        @foreach($users as $user)
                            <tr class="hover:bg-slate-800/40 transition {{ $user->role == 'admin' ? 'bg-amber-950/10' : '' }}">
                                <td class="p-4">
                                    <strong class="block text-lg text-white font-black">{{ $user->name }}</strong>
                                    <span class="text-slate-400">{{ $user->email }}</span>
                                </td>
                                <td class="p-4 font-medium font-mono text-xs">
                                    {{ $user->created_at->format('d.m.Y') }}
                                </td>
                                <td class="p-4">
                                    <form action="{{ route('users.updateRole', $user) }}" method="POST" class="flex items-center">
                                        @csrf
                                        @method('PATCH')
                                        <select name="role" class="text-sm rounded border-slate-800 bg-slate-950 text-slate-100 py-1.5 focus:ring-blue-500 focus:border-blue-500 {{ $user->role == 'admin' ? 'bg-amber-950/40 font-bold text-amber-400 border-amber-900' : '' }}">
                                            <option value="user" {{ $user->role == 'user' ? 'selected' : '' }} class="bg-slate-900 text-white">Zwykły Klient</option>
                                            <option value="admin" {{ $user->role == 'admin' ? 'selected' : '' }} class="bg-slate-900 text-white">Administrator</option>
                                        </select>
                                        <button type="submit" class="ml-3 bg-slate-800 hover:bg-slate-700 text-slate-200 border border-slate-700 px-3 py-1.5 rounded text-xs font-bold transition shadow-md">Zmień Prawa</button>
                                    </form>
                                </td>
                                <td class="p-4 text-right">
                                    @if($user->id !== auth()->id())
                                        <form action="{{ route('users.destroy', $user) }}" method="POST" onsubmit="return confirm('Czy na pewno chcesz usunąć to konto klienta bezpowrotnie z systemu?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="bg-red-950 text-red-400 hover:bg-red-900 border border-red-900 font-bold px-3 py-1.5 rounded text-xs transition shadow-md">Usuń użytkownika</button>
                                        </form>
                                    @else
                                        <span class="text-xs text-emerald-400 font-bold italic bg-emerald-950/60 px-3 py-1.5 rounded border border-emerald-900">Witaj, to Twoje konto</span>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

        </div>
    </div>
</x-app-layout>
