@extends('layouts.dashboard')
@section('title', 'Submodules')
@section('content')
<div class="container py-4">
    <h3 class="fw-bold mb-4">Submodules dari Modul: {{ $module->title }}</h3>

    <a href="{{ route('dashboard.mentor.submodules.create', $module->id) }}" class="btn btn-primary mb-3">
        <i class="fa fa-plus"></i> Tambah Submodule
    </a>

    <div class="row">
        @foreach($submodules as $sub)
            <div class="col-md-4 mb-3">
                <div class="card p-3 shadow-sm">
                    <h5>{{ $sub->title }}</h5>
                    <p>Tipe Konten: {{ $sub->content_type }}</p>
                    <p>URL: {{ $sub->content_url }}</p>
                    <p>Urutan: {{ $sub->order }}</p>
                </div>
            </div>
        @endforeach
    </div>
</div>
@endsection
