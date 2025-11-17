@extends('layouts.app')

@section('content')

<!-- HERO SECTION -->
<section class="py-5 bg-white text-center">
    <div class="container py-5">

        <h1 class="fw-bold display-4 text-primary">ModuLearn</h1>
        <p class="lead mt-3 mb-4">
            Platform pembelajaran berbasis modul untuk siswa SMA<br>
            dengan pembelajaran fleksibel dan terarah.
        </p>

        <a href="{{ url('/pelajaran') }}" class="btn btn-primary btn-lg px-4">Mulai Belajar</a>
    </div>
</section>

<!-- KATEGORI SECTION -->
<section class="py-5 bg-light">
    <div class="container">
        <h3 class="fw-bold mb-4">Pelajaran</h3>

        <div class="row">
            @foreach ($categories as $category)
                @include('components.category-card', ['category' => $category])
            @endforeach
        </div>
    </div>
</section>

<!-- TENTANG KAMI -->
<section id="tentangKami" class="py-5 bg-white">
    <div class="container">
        <h3 class="fw-bold mb-4">Tentang Kami</h3>

        <p class="text-secondary">
            ModuLearn adalah platform pembelajaran yang menyediakan modul-modul
            berkualitas untuk membantu siswa SMA memahami berbagai mata pelajaran
            dengan lebih mudah, terarah, dan fleksibel.
        </p>
    </div>
</section>

@endsection
