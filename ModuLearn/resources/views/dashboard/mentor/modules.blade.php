@extends('layouts.dashboard')
@section('title', 'Dashboard') 
@section('content')
<div class="container py-4">
    <div class="d-flex justify-content-between mb-4">
        <h3 class="fw-bold">Modul Saya</h3>
        <a href="{{ route('dashboard.mentor.modules.create') }}" class="btn btn-primary">
            + Buat Modul Baru
        </a>
    </div>

    <div class="row">
        @foreach($modules as $mod)
        <div class="col-md-4 mb-4">
            <div class="card shadow-sm h-100">

                <img src="{{ $mod->thumbnail }}" class="card-img-top" style="height:180px; object-fit:cover;">

                <div class="card-body">
                    <h5 class="fw-bold">{{ $mod->title }}</h5>

                    <p class="text-muted">
                        {{ Str::limit($mod->description, 100) }}
                    </p>

                    <div class="d-flex justify-content-between mt-3">
                        <a href="{{ route('dashboard.mentor.modules.edit', $mod->id) }}" class="btn btn-warning btn-sm">
                            Edit
                        </a>
                        <a href="{{ route('modules.show', $mod->id) }}" class="btn btn-info btn-sm">
                            Lihat Modul
                        </a>
                    </div>

                </div>

            </div>
        </div>
        @endforeach
    </div>
</div>
@endsection
