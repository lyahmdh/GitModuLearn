@extends('layouts.dashboard')
@section('title', 'My Modules')
@section('content')
<div class="container py-4">

    <div class="d-flex justify-content-between align-items-center mb-3">
        <h3 class="fw-bold">My Modules</h3>
        <a href="{{ route('dashboard.mentor.modules.create') }}" class="btn btn-primary">
            <i class="fa fa-plus"></i> Create Module
        </a>
    </div>

    <div class="row">
        @foreach($modules as $mod)
            <div class="col-md-4 mb-3">
                <div class="card p-3 shadow-sm">
                    <h5>{{ $mod->title }}</h5>
                    <p>Kategori: {{ $mod->category->name }}</p>
                    <a href="{{ route('dashboard.mentor.modules.edit', $mod->id) }}" class="btn btn-primary btn-sm">Edit</a>
                    {{-- Button untuk lihat submodules --}}
                    <a href="{{ route('dashboard.mentor.submodules.index', $mod->id) }}" class="btn btn-sm btn-secondary">
                        View Submodules
                    </a>
                </div>
            </div>
        @endforeach
    </div>
</div>
@endsection
