@extends('layouts.dashboard')
@section('title', 'Liked Modules')

@section('content')

<style>
    /* ===== THEME GRADIENT BLUE ===== */
    .liked-page .section-wrapper {
        border-radius: 20px;
        background: linear-gradient(135deg, #003bb5 0%, #005fe8 50%, #007bff 100%);
        box-shadow: 0 8px 24px rgba(0,0,0,0.08);
        padding: 30px;
    }

    .liked-page .title-header {
        font-size: 1.8rem;
        font-weight: 800;
        color: #ffffff;
        margin-bottom: 22px;
        display: flex;
        align-items: center;
        gap: 10px;
    }

    /* ===== CARD MODULE ===== */
    .liked-page .module-card {
        border-radius: 24px;
        padding: 20px;
        border: 2px solid rgba(255, 255, 255, 0.1);
        transition: .25s ease;
        background: linear-gradient(145deg, #0044c1 0%, #0053dc 50%, #0070ff 100%);
        color: #ffffff;
        box-shadow: 0 5px 14px rgba(0, 0, 0, 0.15);
    }

    .liked-page .module-card:hover {
        transform: translateY(-8px);
        box-shadow: 0 18px 36px rgba(0, 60, 160, 0.26);
        border-color: rgba(255, 255, 255, 0.22);
    }

    .liked-page .module-title {
        font-size: 1.2rem;
        font-weight: 700;
        color: #ffffff;
        margin-bottom: 6px;
        display: flex;
        align-items: center;
        gap: 6px;
    }

    .liked-page .meta {
        color: #ffffff;
        opacity: 0.92;
        font-size: 0.95rem;
        display: flex;
        align-items: center;
        gap: 6px;
    }

    .liked-page .likes-count {
        margin-top: 10px;
        font-weight: 700;
        color: #ffd2d2;
        display: flex;
        align-items: center;
        gap: 6px;
        font-size: 1rem;
    }

    /* EMPTY STATE */
    .liked-page .empty-box {
        opacity: .85;
    }
</style>


<div class="container py-4 liked-page">

    <div class="section-wrapper">

        <h3 class="title-header">
            <i class="fa fa-heart"></i>
            Modul yang Kamu Like
        </h3>

        {{-- EMPTY STATE --}}
        @if($likedModules->isEmpty())

            <div class="text-center text-light py-5">
                <img src="https://cdn-icons-png.flaticon.com/512/4076/4076549.png"
                     width="130" class="empty-box mb-3">

                <h4 class="fw-bold text-white">Belum Ada Like</h4>
                <p class="text-white-50">Kamu belum menyukai modul apapun.</p>
            </div>

        @else

        {{-- GRID --}}
        <div class="row g-4">
            @foreach($likedModules as $mod)
                <div class="col-md-4">

                    <div class="module-card h-100">

                        <h5 class="module-title">
                            <i class="fa fa-book"></i>
                            {{ $mod->title }}
                        </h5>

                        <p class="meta mb-1">
                            <i class="fa fa-folder-open"></i>
                            {{ $mod->category->name }}
                        </p>

                        <p class="likes-count">
                            <i class="fa fa-heart"></i>
                            {{ $mod->likes_count }} Likes
                        </p>

                    </div>

                </div>
            @endforeach
        </div>

        @endif

    </div>

</div>

@endsection
