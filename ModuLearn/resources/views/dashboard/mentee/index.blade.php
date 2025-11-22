@extends('layouts.dashboard')
@section('title', 'Dashboard') 
@section('content')
<div class="container py-4">

    <h3 class="fw-bold mb-4">Dashboard Mentee</h3>

    {{-- RINGKASAN --}}
    <div class="row">

        {{-- Total Modul Diikuti --}}
        <div class="col-md-4 mb-3">
            <div class="card shadow-sm p-3">
                <h5 class="fw-bold">Modul Diikuti</h5>
                <p class="fs-4">{{ $totalModules }}</p>
            </div>
        </div>

        {{-- Total Selesai --}}
        <div class="col-md-4 mb-3">
            <div class="card shadow-sm p-3">
                <h5 class="fw-bold">Submodul Selesai</h5>
                <p class="fs-4">{{ $totalCompleted }}</p>
            </div>
        </div>

        {{-- Likes --}}
        <div class="col-md-4 mb-3">
            <div class="card shadow-sm p-3">
                <h5 class="fw-bold">Modul Disukai</h5>
                <p class="fs-4">{{ $likedCount }}</p>
            </div>
        </div>

    </div>

</div>
@endsection
