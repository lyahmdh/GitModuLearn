@extends('layouts.app')

@section('title', 'Dashboard Mentor')

@section('content')
<div class="container py-4">

    <h3 class="fw-bold mb-4">Dashboard Mentor</h3>

    <div class="row mb-4">
        <div class="col-md-4">
            <div class="p-4 bg-white rounded shadow-sm">
                <h6 class="fw-semibold">Modul Dibuat</h6>
                <h2 class="fw-bold">{{ $stats['module_count'] }}</h2>
            </div>
        </div>

        <div class="col-md-4">
            <div class="p-4 bg-white rounded shadow-sm">
                <h6 class="fw-semibold">Submodul Dibuat</h6>
                <h2 class="fw-bold">{{ $stats['submodule_count'] }}</h2>
            </div>
        </div>

        <div class="col-md-4">
            <div class="p-4 bg-white rounded shadow-sm">
                <h6 class="fw-semibold">Total Likes</h6>
                <h2 class="fw-bold">{{ $stats['likes'] }}</h2>
            </div>
        </div>
    </div>

    <div class="d-flex justify-content-between align-items-center mb-3">
        <h4 class="fw-bold">Modul Anda</h4>
        <a href="{{ route('mentor.module.create') }}" class="btn btn-primary">+ Buat Modul</a>
    </div>

    <div class="row">
        @foreach ($modules as $module)
        <div class="col-md-4 mb-4">
            <div class="card shadow-sm">

                <img src="{{ asset('images/module-cover.png') }}" class="card-img-top">

                <div class="card-body">
                    <h5 class="fw-bold">{{ $module->title }}</h5>
                    <p class="small text-muted">
                        Likes: {{ $module->likes_count }}
                    </p>

                    <a href="{{ route('mentor.module.detail', $module->id) }}" class="btn btn-sm btn-outline-primary">
                        Kelola Modul
                    </a>
                </div>

            </div>
        </div>
        @endforeach
    </div>

</div>
@endsection
