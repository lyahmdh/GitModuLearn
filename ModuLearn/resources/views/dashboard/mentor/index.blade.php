@extends('layouts.dashboard')
@section('title', 'Dashboard') 
@section('content')

<style>
    .dashboard-header {
        border-left: 5px solid #007bff;
        padding-left: 14px;
    }

    .stat-card {
        border-radius: 18px;
        color: #fff;
        position: relative;
        overflow: hidden;
        transition: all 0.3s ease;
    }

    .stat-card:hover {
        transform: translateY(-6px) scale(1.02);
        box-shadow: 0 12px 25px rgba(0, 0, 0, 0.25);
    }

    /* 3 tipe BIRU */
    .blue-1 {
        background: linear-gradient(135deg, #002f6c, #005bb5); /* Navy → Royal */
    }
    .blue-2 {
        background: linear-gradient(135deg, #005bb5, #00a2ff); /* Royal → Cyan */
    }
    .blue-3 {
        background: linear-gradient(135deg, #4d85c7, #6ca8e4); /* Soft Blue */
    }

    .icon-bg {
        font-size: 42px;
        opacity: 0.23;
        position: absolute;
        right: 15px;
        bottom: 10px;
    }
</style>

<div class="container py-4">

    <h3 class="fw-bold mb-4 dashboard-header">Dashboard Mentor</h3>

    <div class="row">

        <div class="col-md-4 mb-3">
            <div class="card shadow stat-card p-4 blue-1">
                <h6 class="fw-semibold">Total Modul Dibuat</h6>
                <h1 class="fw-bold">{{ $totalModules }}</h1>
                <i class="bi bi-folder-fill icon-bg"></i>
            </div>
        </div>

        <div class="col-md-4 mb-3">
            <div class="card shadow stat-card p-4 blue-2">
                <h6 class="fw-semibold">Total Likes</h6>
                <h1 class="fw-bold">{{ $totalLikes }}</h1>
                <i class="bi bi-heart-fill icon-bg"></i>
            </div>
        </div>

        <div class="col-md-4 mb-3">
            <div class="card shadow stat-card p-4 blue-3">
                <h6 class="fw-semibold">Total Submodul</h6>
                <h1 class="fw-bold">{{ $totalSubmodules }}</h1>
                <i class="bi bi-diagram-3-fill icon-bg"></i>
            </div>
        </div>

    </div>

</div>

@endsection
