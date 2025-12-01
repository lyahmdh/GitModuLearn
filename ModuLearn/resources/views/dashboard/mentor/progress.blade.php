@extends('layouts.dashboard')
@section('title', 'Dashboard') 
@section('content')

<style>
    /* ===== HEADER ===== */
    .progress-header {
        background: linear-gradient(135deg, #1d4ed8, #3b82f6);
        padding: 32px;
        border-radius: 18px;
        color: white;
        margin-bottom: 40px;
        box-shadow: 0 8px 20px rgba(0,0,0,0.15);
    }

    .progress-header h3 {
        font-size: 28px;
        font-weight: 700;
        margin-bottom: 6px;
    }

    .progress-header p {
        font-size: 15px;
        opacity: 0.9;
    }

    /* ===== CARD ===== */
    .progress-card {
        background: #fff;
        border-radius: 18px;
        padding: 28px;
        border: none;
        box-shadow: 0 6px 18px rgba(0,0,0,0.08);
        transition: 0.25s ease-in-out;
    }

    .progress-card:hover {
        transform: translateY(-4px);
        box-shadow: 0 12px 26px rgba(0,0,0,0.12);
    }

    .progress-title {
        font-size: 20px;
        font-weight: 700;
        color: #1e3a8a;
        margin-bottom: 8px;
    }

    .progress-desc {
        color: #6b7280;
        font-size: 14px;
        margin-bottom: 20px;
    }

    /* ===== PROGRESS BAR ===== */
    .custom-progress {
        background: #e5e7eb;
        border-radius: 12px;
        height: 18px;
        overflow: hidden;
    }

    .custom-progress-bar {
        background: linear-gradient(90deg, #2563eb, #3b82f6);
        height: 100%;
        font-size: 12px;
        font-weight: 600;
        color: white;
        display: flex;
        align-items: center;
        justify-content: center;
        transition: width 0.4s ease;
    }

    .progress-detail {
        font-size: 13px;
        color: #64748b;
        margin-top: 8px;
    }
</style>

<div class="container py-4">

    {{-- HEADER --}}
    <div class="progress-header">
        <h3>Progress Belajar Kamu</h3>
        <p>Lihat perkembangan modul yang sedang kamu pelajari.</p>
    </div>

    {{-- PROGRESS LIST --}}
    @forelse($progressList as $item)

        @if(!empty($item['module']))
            <div class="progress-card mb-4">

                <h5 class="progress-title">{{ $item['module']->title }}</h5>
                <p class="progress-desc">{{ $item['module']->description }}</p>

                {{-- CUSTOM PROGRESS BAR --}}
                <div class="custom-progress mb-2">
                    <div class="custom-progress-bar" style="width: {{ $item['progress'] }}%;">
                        {{ $item['progress'] }}%
                    </div>
                </div>

                <p class="progress-detail">
                    {{ $item['completed'] }} selesai dari {{ $item['total'] }} submodul
                </p>

            </div>

        @else
            <div class="progress-card mb-4">
                <p class="text-danger m-0">Module tidak ditemukan</p>
            </div>
        @endif

    @empty

        <div class="progress-card">
            <p class="text-muted m-0">Belum ada progress modul.</p>
        </div>

    @endforelse

</div>
@endsection
