<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Landing Page</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@3.3.3/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100">

    <header class="flex justify-between items-center p-6 bg-white shadow">
        <h1 class="text-2xl font-bold">WebsiteKu</h1>

        <div>
            <!-- Untuk guest -->
            @guest
                <a href="{{ route('login') }}" class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">Login</a>
                <a href="{{ route('register') }}" class="px-4 py-2 bg-green-600 text-white rounded hover:bg-green-700">Sign Up</a>
            @endguest

            <!-- Untuk user yang sudah login -->
            @auth
                <a href="{{ route('profile.edit') }}">
                    <img src="{{ Auth::user()->profile_photo_url ?? '/default-profile.png' }}" 
                         alt="Profile" class="w-10 h-10 rounded-full border-2 border-gray-300">
                </a>
            @endauth
        </div>
    </header>

    <main class="flex flex-col items-center justify-center h-screen text-center">
        <h2 class="text-4xl font-bold mb-4">Selamat Datang di WebsiteKu</h2>
        <p class="mb-6 text-gray-700">Platform belajar interaktif untuk semua pengguna.</p>

        <!-- Tombol CTA guest -->
        @guest
            <div>
                <a href="{{ route('register') }}" class="px-6 py-3 bg-green-600 text-white rounded hover:bg-green-700 mr-2">Daftar Sekarang</a>
                <a href="{{ route('login') }}" class="px-6 py-3 bg-blue-600 text-white rounded hover:bg-blue-700">Masuk</a>
            </div>
        @endguest

        <!-- CTA user sudah login -->
        @auth
            <div>
                <a href="{{ route('dashboard') }}" class="px-6 py-3 bg-purple-600 text-white rounded hover:bg-purple-700">Lihat Dashboard</a>
            </div>
        @endauth
    </main>

</body>
</html>
