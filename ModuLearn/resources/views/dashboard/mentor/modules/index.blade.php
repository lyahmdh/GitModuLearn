@extends('layouts.dashboard')
@section('title', 'Dashboard') 
@section('content')

<style>
    /* ===== HEADER ===== */
    .liked-header {
        background: linear-gradient(135deg, #1d4ed8, #3b82f6);
        padding: 32px;
        border-radius: 18px;
        color: white;
        margin-bottom: 40px;
        box-shadow: 0 8px 20px rgba(0,0,0,0.15);
    }

    .liked-header h3 {
        font-size: 28px;
        font-weight: 700;
        margin-bottom: 6px;
    }

    .liked-header p {
        font-size: 15px;
        opacity: 0.9;
    }

    /* ===== CARD STYLING ===== */
    .module-card {
        border: none;
        border-radius: 18px;
        overflow: hidden;
        background: #ffffff;
        box-shadow: 0 6px 18px rgba(0,0,0,0.08);
        transition: 0.25s ease-in-out;
        height: 100%;
        display: flex;
        flex-direction: column;
    }

    .module-card:hover {
        transform: translateY(-6px);
        box-shadow: 0 12px 28px rgba(0,0,0,0.12);
    }

    .module-card img {
        height: 180px;
        object-fit: cover;
    }

    .module-card-title {
        font-size: 18px;
        font-weight: 700;
        color: #1e3a8a;
        margin-bottom: 6px;
    }

    .module-card-desc {
        font-size: 14px;
        color: #6b7280;
        margin-bottom: 14px;
    }

    /* ===== BUTTON ===== */
    .module-btn {
        background: #2563eb;
        color: white;
        border-radius: 10px;
        padding: 10px 14px;
        font-weight: 600;
        width: 100%;
        border: none;
        transition: 0.25s ease;
    }

    .module-btn:hover {
        background: #1e40af;
        transform: scale(1.03);
    }
</style>

<div class="container py-4">

    {{-- Header --}}
    <div class="liked-header">
        <h3>Modul yang Kamu Like</h3>
        <p>Semua modul yang sudah kamu beri like akan tampil di sini.</p>
    </div>

    {{-- Cards --}}
    <div class="row g-4">
        @foreach($likedModules as $mod)
        <div class="col-md-4">
            <div class="module-card">

                <img src="{{ $mod->thumbnail }}">

                <div class="p-3">
                    <h5 class="module-card-title">{{ $mod->title }}</h5>
                    <p class="module-card-desc">{{ Str::limit($mod->description, 100) }}</p>

                    <a href="{{ route('modules.show', $mod->id) }}" class="module-btn">
                        Buka Modul
                    </a>
                </div>

            </div>
        </div>
        @endforeach
    </div>

</div>
@endsection
