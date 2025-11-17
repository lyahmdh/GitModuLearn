@extends('layouts.app')

@section('title', 'Modulearn — Learn Anything with Mentors')

@section('content')
<!-- HERO SECTION -->
<section class="bg-white py-20">
    <div class="container mx-auto px-6 md:px-12 text-center">
        <h1 class="text-4xl md:text-5xl font-extrabold text-gray-800 leading-tight">
            Belajar Mudah dan Terstruktur Bersama Mentor Terbaik
        </h1>
        <p class="text-gray-600 mt-4 text-lg md:text-xl">
            Platform pembelajaran dengan modul lengkap, mentor berpengalaman, dan sistem akses yang fleksibel.
        </p>

        <div class="mt-8">
            <a href="{{ route('register') }}"
               class="px-8 py-3 bg-blue-600 text-white rounded-lg shadow hover:bg-blue-700">
               Mulai Sekarang
            </a>
            <a href="{{ route('login') }}"
               class="ml-3 px-8 py-3 border border-gray-300 text-gray-700 rounded-lg hover:bg-gray-100">
               Masuk
            </a>
        </div>
    </div>
</section>

<!-- CATEGORY SECTION -->
<section class="py-16 bg-gray-50">
    <div class="container mx-auto px-6 md:px-12">
        <h2 class="text-3xl font-semibold text-gray-800 text-center">Kategori Pembelajaran</h2>
        <p class="text-center text-gray-600 mt-2">
            Pilih kategori untuk mulai belajar sesuai kebutuhanmu
        </p>

        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6 mt-10">
            @forelse($courses as $course)
                @include('components.course-card', ['course' => $course])
            @empty
                <p class="text-center col-span-4 text-gray-600">
                    Belum ada kategori / course tersedia.
                </p>
            @endforelse
        </div>
    </div>
</section>

<!-- FEATURE SECTION -->
<section class="py-16 bg-white">
    <div class="container mx-auto px-6 md:px-12">
        <h2 class="text-3xl font-semibold text-center text-gray-800">Mengapa Memilih Modulearn?</h2>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-10 mt-12">

            <div class="p-8 bg-gray-50 rounded-xl shadow hover:shadow-lg transition">
                <h3 class="text-xl font-bold text-gray-800">Modul Lengkap</h3>
                <p class="text-gray-600 mt-2">
                    Belajar lebih mudah dengan modul yang disusun mentor profesional.
                </p>
            </div>

            <div class="p-8 bg-gray-50 rounded-xl shadow hover:shadow-lg transition">
                <h3 class="text-xl font-bold text-gray-800">Akses Fleksibel</h3>
                <p class="text-gray-600 mt-2">
                    Belajar kapan saja dan di mana saja melalui platform yang responsif.
                </p>
            </div>

            <div class="p-8 bg-gray-50 rounded-xl shadow hover:shadow-lg transition">
                <h3 class="text-xl font-bold text-gray-800">Mentor Berpengalaman</h3>
                <p class="text-gray-600 mt-2">
                    Dapatkan bimbingan langsung dari mentor ahli di bidangnya.
                </p>
            </div>

        </div>
    </div>
</section>

<!-- CTA SECTION -->
<section class="py-20 bg-blue-600 text-white text-center">
    <h2 class="text-3xl font-bold">Siap memulai perjalanan belajarmu?</h2>
    <p class="mt-2 text-lg">Bergabung sekarang dan temukan banyak modul pembelajaran terbaik</p>

    <a href="{{ route('register') }}"
       class="mt-6 inline-block px-10 py-3 bg-white text-blue-600 font-semibold rounded-lg shadow hover:bg-gray-100">
        Daftar Sekarang
    </a>
</section>

@endsection
