@extends('layouts.app')

@section('content')
<div class="container py-5">

    {{-- HERO SECTION --}}
    <div class="text-center py-5">
        <h1 class="fw-bold">Belajar Lebih Mudah dengan ModuLearn</h1>
        <p class="text-muted fs-5">
            Platform pembelajaran berbasis modul dan submodul, lengkap dengan progress tracking dan fitur likes.
        </p>
    </div>

    {{-- FITUR-FITUR --}}
    <div class="row text-center mt-5" id="fitur">
        <h2 class="fw-bold mb-4">Fitur Utama</h2>

        <div class="col-md-3 mb-4">
            <div class="card shadow-sm p-3">
                <h5 class="fw-bold">Modul</h5>
                <p class="text-muted">Materi terstruktur dalam bentuk modul.</p>
            </div>
        </div>

        <div class="col-md-3 mb-4">
            <div class="card shadow-sm p-3">
                <h5 class="fw-bold">Submodul</h5>
                <p class="text-muted">Setiap modul berisi pembelajaran kecil yang mudah dipahami.</p>
            </div>
        </div>

        <div class="col-md-3 mb-4">
            <div class="card shadow-sm p-3">
                <h5 class="fw-bold">Likes</h5>
                <p class="text-muted">Berikan apresiasi pada modul yang kamu sukai.</p>
            </div>
        </div>

        <div class="col-md-3 mb-4">
            <div class="card shadow-sm p-3">
                <h5 class="fw-bold">Progress Check</h5>
                <p class="text-muted">Pantau progres belajar kamu di setiap modul.</p>
            </div>
        </div>
    </div>

</div>
@endsection
