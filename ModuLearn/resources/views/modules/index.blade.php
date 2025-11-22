@extends('layouts.app')

@section('content')
<div class="container py-4">

    <h2 class="fw-bold mb-4">Pelajaran</h2>

    {{-- SEARCH + KATEGORI --}}
    <form method="GET" class="row mb-4">
        <div class="col-md-8">
            <input type="text" name="search" class="form-control" placeholder="Cari modul...">
        </div>

        <div class="col-md-4">
            <select name="category" class="form-select">
                <option value="">Semua Kategori</option>
                @foreach($categories as $cat)
                    <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                @endforeach
            </select>
        </div>
    </form>

    {{-- LIST MODUL --}}
    <div class="row">
        @foreach($modules as $mod)
            <div class="col-md-4 mb-4">
                <div class="card shadow-sm h-100">

                    <img src="{{ $mod->thumbnail }}" class="card-img-top" style="height: 180px; object-fit:cover;">

                    <div class="card-body">
                        <h5 class="fw-bold">{{ $mod->title }}</h5>
                        <p class="text-muted">{{ Str::limit($mod->description, 100) }}</p>

                        <a href="{{ route('modules.show', $mod->id) }}" 
                           class="btn btn-primary w-100">
                            Lihat Modul
                        </a>
                    </div>

                </div>
            </div>
        @endforeach
    </div>

</div>
@endsection
