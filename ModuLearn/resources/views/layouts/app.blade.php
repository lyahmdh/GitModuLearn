<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{{ config('app.name', 'Modulearn') }}</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-100">
    <nav class="bg-white shadow-sm border-b">
        <div class="max-w-7xl mx-auto px-4 flex justify-between items-center h-16">

            {{-- Logo --}}
            <a href="/landing-login" class="flex items-center font-bold text-lg">
                <img src="assets/logo.png" alt="Modulearn" class="h-8 mr-2">
            </a>

            {{-- Nav Links --}}
            <div class="flex gap-6">
                <a href="/landing-login" class="hover:text-blue-500">Beranda</a>
                <a href="/pelajaran" class="hover:text-blue-500">Pelajaran</a>
            </div>

            {{-- Profile + Logout --}}
            <div class="flex items-center gap-4">

                {{-- Logout --}}
                <form method="POST" action="/logout">
                    @csrf
                    <button class="px-4 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700">
                        Logout
                    </button>
                </form>

                {{-- Profile Picture --}}
                <a href="/dashboard">
                <img src="{{ auth()->user()->profile_photo_path 
                        ? asset(auth()->user()->profile_photo_path) 
                        : asset('assets/default-profile.png') }}"
                        class="h-10 w-10 rounded-full object-cover">

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