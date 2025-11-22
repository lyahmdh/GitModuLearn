@extends('layouts.dashboard')
@section('title', 'Dashboard') 
@section('content')
<div class="container py-4">
    <h3 class="fw-bold mb-4">Dashboard Mentor</h3>

    <div class="row">

        <div class="col-md-4 mb-3">
            <div class="card shadow-sm p-3">
                <h5 class="fw-bold">Total Modul Dibuat</h5>
                <p class="fs-3">{{ $totalModules }}</p>
            </div>
        </div>

        <div class="col-md-4 mb-3">
            <div class="card shadow-sm p-3">
                <h5 class="fw-bold">Total Likes</h5>
                <p class="fs-3">{{ $totalLikes }}</p>
            </div>
        </div>

        <div class="col-md-4 mb-3">
            <div class="card shadow-sm p-3">
                <h5 class="fw-bold">Total Submodul</h5>
                <p class="fs-3">{{ $totalSubmodules }}</p>
            </div>
        </div>

    </div>
</div>
@endsection
