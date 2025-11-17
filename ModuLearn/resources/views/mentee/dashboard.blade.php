@extends('layouts.app')

@section('title', 'Dashboard Mentee')

@section('content')
<div class="container py-4">

    <h3 class="fw-bold mb-4">Halo, {{ auth()->user()->name }} 👋</h3>

    {{-- PROGRESS SECTION --}}
    <div class="row mb-5">
        <div class="col-md-4">
            <div class="p-4 border rounded bg-white shadow-sm">
                <h6 class="fw-semibold">Modul Diikuti</h6>
                <h2 class="fw-bold">{{ $stats['modules_taken'] }}</h2>
            </div>
        </div>

        <div class="col-md-4">
            <div class="p-4 border rounded bg-white shadow-sm">
                <h6 class="fw-semibold">Progress (%)</h6>
                <h2 class="fw-bold">{{ $stats['progress'] }}%</h2>
            </div>
        </div>

        <div class="col-md-4">
            <div class="p-4 border rounded bg-white shadow-sm">
                <h6 class="fw-semibold">Submodul Selesai</h6>
                <h2 class="fw-bold">{{ $stats['completed'] }}</h2>
            </div>
        </div>
    </div>

    {{-- RECOMMENDED MODULE --}}
    <h4 class="fw-bold mb-3">Rekomendasi Untukmu</h4>
    <div class="row">

        @foreach ($recommended as $module)
        <div class="col-md-4 mb-4">
            <div class="card h-100 shadow-sm">
                <img src="{{ asset('images/module-cover.png') }}" class="card-img-top">

                <div class="card-body">
                    <h5 class="card-title">{{ $module->title }}</h5>
                    <p class="text-muted small">Mentor: {{ $module->mentor->name }}</p>

                    <a href="{{ route('mentee.module-detail', $module->id) }}" class="btn btn-primary">
                        Lihat Modul
                    </a>
                </div>
            </div>
        </div>
        @endforeach

    </div>

</div>
@endsection
