<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Uczciwy Komis Samochodowy</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- Alpine.js - niezbędny do obsługi nowoczesnej karuzeli zdjęć -->
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
</head>
<body class="bg-gray-100 text-gray-800 font-sans antialiased">

    <nav class="bg-slate-900 text-white p-4 shadow-lg border-b-4 border-blue-600">
        <div class="container mx-auto flex justify-between items-center">
            <h1 class="text-2xl font-black tracking-tight">
                <a href="{{ route('cars.index') }}">Uczciwy<span class="text-blue-500">Komis</span></a>
            </h1>
            <div class="flex items-center gap-4">
                <span class="hidden md:block text-sm text-slate-300">Pełna transparentność historii pojazdów</span>

                @auth
                    <a href="{{ url('/dashboard') }}" class="ml-4 px-4 py-1 bg-blue-600 hover:bg-blue-500 rounded text-sm font-bold transition">Panel Admina</a>
                @else
                    <a href="{{ route('login') }}" class="ml-4 px-4 py-1 bg-slate-700 hover:bg-slate-600 rounded text-sm font-bold transition">Logowanie</a>
                    <a href="{{ route('register') }}" class="ml-2 px-4 py-1 bg-blue-600 hover:bg-blue-500 rounded text-sm font-bold transition">Rejestracja</a>
                @endauth
            </div>
        </div>
    </nav>
    <main class="container mx-auto mt-8 p-4">
        @yield('content')
    </main>

</body>
</html>
