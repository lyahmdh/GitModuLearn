<nav class="bg-white shadow-sm border-b">
    <div class="max-w-7xl mx-auto px-4 flex justify-between items-center h-16">

        {{-- Logo --}}
        <a href="/dashboard" class="flex items-center font-bold text-lg">
            <img src="/logo.png" alt="Modulearn" class="h-8 mr-2">
            Modulearn
        </a>

        {{-- Nav Links --}}
        <div class="flex gap-6">
            <a href="/dashboard" class="hover:text-blue-500">Beranda</a>
            <a href="/pelajaran" class="hover:text-blue-500">Pelajaran</a>
        </div>

        {{-- Profile + Logout --}}
        <div class="flex items-center gap-4">

            {{-- Profile Picture --}}
            <a href="/dashboard">
                <img src="{{ Auth::user()->profile_photo_url }}" 
                     class="h-10 w-10 rounded-full object-cover">
            </a>

            {{-- Logout --}}
            <form method="POST" action="/logout">
                @csrf
                <button class="px-4 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700">
                    Logout
                </button>
            </form>
        </div>

    </div>
</nav>

<main>
    {{ $slot }}
</main>
