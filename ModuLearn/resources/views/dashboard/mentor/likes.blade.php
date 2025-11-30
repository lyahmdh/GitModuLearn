@extends('layouts.dashboard')
@section('title', 'Liked Modules')

@section('content')

<style>
    /* HEADER GRADIENT MODERN */
    .blue-header {
        background: linear-gradient(90deg, #1e66ff, #1160ff, #0a57ff);
        padding: 28px;
        border-radius: 18px;
        color: #fff;
        box-shadow: 0 8px 22px rgba(0,0,0,0.12);
        animation: fadeDown 0.55s ease;
    }

    /* FADE ANIMATIONS */
    @keyframes fadeDown {
        from { opacity: 0; transform: translateY(-12px); }
        to   { opacity: 1; transform: translateY(0); }
    }
    @keyframes fadeUp {
        from { opacity: 0; transform: translateY(20px); }
        to   { opacity: 1; transform: translateY(0); }
    }

    /* CARD STYLING */
    .module-card {
        border-radius: 22px;
        padding: 26px;
        background: #ffffff;
        border: none !important;
        box-shadow: 0 8px 22px rgba(0,0,0,0.08);
        transition: .28s cubic-bezier(.25,.1,.25,1.4);
        animation: fadeUp .55s ease both;
        position: relative;
        overflow: hidden;
    }
    .module-card::before {
        content: "";
        position: absolute;
        top: -80px;
        left: -80px;
        width: 180px;
        height: 180px;
        background: rgba(30,102,255,0.08);
        border-radius: 50%;
        filter: blur(40px);
        transition: .35s ease;
    }
    .module-card:hover::before {
        transform: translate(40px,40px) scale(1.2);
        background: rgba(30,102,255,0.14);
    }
    .module-card:hover {
        transform: translateY(-10px) scale(1.02);
        box-shadow: 0 16px 32px rgba(0,0,0,0.16);
    }

    .module-title {
        font-size: 1.25rem;
        font-weight: 800;
        color: #1e66ff;
        margin-bottom: 6px;
    }

    .module-info {
        background: #f4f7ff;
        padding: 10px 14px;
        border-radius: 12px;
        margin-bottom: 10px;
        font-size: .9rem;
        color: #4a5e80;
        font-weight: 600;
    }

    .like-display {
        padding: 8px 14px;
        background: #ffe6e9;
        border-radius: 12px;
        display: inline-block;
        font-size: .9rem;
        font-weight: 700;
        color: #e03131;
        margin-top: 6px;
    }
    .module-card:hover {
        transform: translateY(-8px);
        box-shadow: 0 12px 28px rgba(0,0,0,0.14);
        background: #fdfdfd;
    }
    .module-card:hover {
        transform: translateY(-6px);
        box-shadow: 0 10px 24px rgba(0,0,0,0.14);
    }

    h3.section-title {
        font-weight: 800;
        font-size: 1.55rem;
        letter-spacing: .3px;
    }

    .category-label {
        font-size: .9rem;
        color: #5c6c85;
        font-weight: 500;
    }

    .like-count {
        font-weight: 600;
        color: #e03131;
        font-size: .95rem;
    }
</style>

<div class="container py-4">

    <!-- BLUE HEADER TITLE -->
    <div class="blue-header mb-4">
        <h3 class="section-title mb-1">Modul yang Kamu Sukai</h3>
        <p class="mb-0" style="opacity: .9">Daftar modul yang kamu tandai sebagai favorit.</p>
    </div>


    @if($likedModules->isEmpty())
        <div class="card border-0 shadow-sm p-4 rounded-3">
            <p class="text-muted text-center m-0">Kamu belum menyukai modul apapun.</p>
        </div>
    @else

        <div class="row g-4">
            @foreach($likedModules as $mod)
                <div class="col-md-4">

                    <div class="card module-card h-100">
                        <h5 class="fw-bold module-title">{{ $mod->title }}</h5>

                        <p class="category-label mb-1">
                            <i class="bi bi-folder"></i> {{ $mod->category->name }}
                        </p>

                        <p class="like-count mb-0 d-flex align-items-center gap-2">
    <i class="bi bi-heart-fill text-danger fs-5"></i> ❤️ {{ $mod->likes_count }} Likes
</p>
                    </div>

                </div>
            @endforeach
        </div>

    @endif

</div>
@endsection
