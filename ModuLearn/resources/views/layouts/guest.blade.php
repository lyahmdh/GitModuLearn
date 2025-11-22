<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{{ config('app.name', 'Modulearn') }}</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-100">

    {{-- NAVBAR GUEST --}}
    <nav class="bg-white border-b shadow-sm">
        <div class="max-w-7xl mx-auto px-4 flex justify-between items-center h-16">

            {{-- Logo --}}
            <a href="/" class="flex items-center font-bold text-lg">
                <img src="/logo.png" alt="Modulearn" class="h-8 mr-2">
                Modulearn
            </a>

            {{-- Navlinks --}}
            <div class="flex gap-6">
                <a href="/" class="hover:text-blue-500">Beranda</a>
                <a href="/pelajaran" class="hover:text-blue-500">Pelajaran</a>
            </div>

            {{-- Auth Buttons --}}
            <div class="flex gap-3">
                <a href="/login" class="text-gray-700 hover:text-blue-500">Login</a>
                <a href="/register" class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700">
                    Sign Up
                </a>
            </div>
        </div>
    </nav>

    {{-- CONTENT --}}
    <main>
        @yield('content')
    </main>

</body>
</html>
