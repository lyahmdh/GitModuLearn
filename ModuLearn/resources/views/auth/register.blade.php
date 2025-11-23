<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-100 flex items-center justify-center h-screen">

    <div class="bg-white p-8 rounded-lg shadow-md w-full max-w-md">
        <h2 class="text-2xl font-bold mb-6 text-center">Daftar Akun</h2>

        {{-- Error Messages --}}
        @if ($errors->any())
            <div class="bg-red-100 text-red-700 p-3 mb-4 rounded">
                <ul class="list-disc pl-5">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{ route('register') }}">
            @csrf

            <!-- Name -->
            <div class="mb-4">
                <label for="name" class="block font-medium text-gray-700 mb-1">Nama</label>
                <input id="name" type="text" name="name" value="{{ old('name') }}" required autofocus
                    class="w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 px-3 py-2">
            </div>

            <!-- Email -->
            <div class="mb-4">
                <label for="email" class="block font-medium text-gray-700 mb-1">Email</label>
                <input id="email" type="email" name="email" value="{{ old('email') }}" required
                    class="w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 px-3 py-2">
            </div>

            <!-- Password -->
            <div class="mb-4">
                <label for="password" class="block font-medium text-gray-700 mb-1">Password</label>
                <input id="password" type="password" name="password" required
                    class="w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 px-3 py-2">
            </div>

            <!-- Confirm Password -->
            <div class="mb-4">
                <label for="password_confirmation" class="block font-medium text-gray-700 mb-1">Konfirmasi Password</label>
                <input id="password_confirmation" type="password" name="password_confirmation" required
                    class="w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 px-3 py-2">
            </div>

            <!-- Asal Institusi -->
            <div class="mb-4">
                <label for="institusi" class="block font-medium text-gray-700 mb-1">Asal Institusi</label>
                <select id="institusi" name="institusi" required
                    class="w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 px-3 py-2">
                    <option value="">Pilih institusi</option>
                    <option value="Universitas A">Universitas A</option>
                    <option value="Universitas B">Universitas B</option>
                    <option value="Sekolah C">Sekolah C</option>
                </select>
            </div>

            <!-- Bidang yang diminati -->
            <div class="mb-4">
                <label for="bidang" class="block font-medium text-gray-700 mb-1">Bidang yang diminati</label>
                <select id="bidang" name="bidang" required
                    class="w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 px-3 py-2">
                    <option value="">Pilih bidang</option>
                    <option value="Teknologi">Teknologi</option>
                    <option value="Bisnis">Bisnis</option>
                    <option value="Desain">Desain</option>
                </select>
            </div>

            <!-- Submit -->
            <div class="flex items-center justify-between">
                <a href="{{ route('login') }}" class="text-sm text-gray-600 hover:text-gray-900">
                    Sudah punya akun?
                </a>
                <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700">
                    Daftar
                </button>
            </div>
        </form>
    </div>

</body>
</html>
