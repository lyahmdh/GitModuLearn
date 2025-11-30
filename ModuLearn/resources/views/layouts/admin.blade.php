
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin - {{ config('app.name', 'Modulearn') }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-100">

<nav class="bg-gray-800 text-white shadow-sm">
    <div class="max-w-7xl mx-auto px-4 flex justify-between items-center h-16">
        <a href="{{ route('dashboard.admin') }}" class="flex items-center font-bold text-lg">
            <img src="{{ asset('assets/logo.png') }}" alt="Modulearn" class="h-8 mr-2">
            Admin
        </a>

        <div class="flex gap-6">
            <a href="{{ route('dashboard.admin.modules') }}" class="hover:text-blue-300">Modul</a>
            <a href="{{ route('dashboard.admin.users') }}" class="hover:text-blue-300">Users</a>
            <a href="{{ route('dashboard.admin.categories') }}" class="hover:text-blue-300">Kategori</a>
            <a href="{{ route('dashboard.admin.mentorApproval') }}" class="hover:text-blue-300">Approval Mentor</a>
        </div>

        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button class="px-4 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700">
                Logout
            </button>
        </form>
    </div>
</nav>

<main>
    @yield('content')
</main>

@stack('scripts')
</body>
</html>
