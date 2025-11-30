@extends('layouts.app')

@section('content')
<div class="container py-4">

    <h2 class="fw-bold mb-4">Pelajaran</h2>

    {{-- SEARCH + KATEGORI --}}
    <form method="GET" class="row mb-4">
        <div class="col-md-8">
            <input type="text" name="search" class="form-control" placeholder="Cari modul..."
                value="{{ request('search') }}">
        </div>

        <div class="col-md-4">
            <select name="category" class="form-select" onchange="this.form.submit()">
                <option value="">Semua Kategori</option>
                @foreach($categories as $cat)
                    <option value="{{ $cat->id }}"
                        {{ request('category') == $cat->id ? 'selected' : '' }}>
                        {{ $cat->name }}
                    </option>
                @endforeach
            </select>
        </div>
    </form>


    </form>

    {{-- LIST MODUL --}}
    <div class="row">
        @foreach($modules as $mod)
            <div class="col-md-4 mb-4">
                <div class="card shadow-sm h-100">

                    <img src="{{ $mod->thumbnail }}" class="card-img-top" style="height: 180px; object-fit:cover;">

                    <div class="card-body">
                        <h5 class="fw-bold">{{ $mod->title }}</h5>

                        {{-- Tampilkan kategori --}}
                        <p class="text-muted mb-1">Kategori: {{ $mod->category?->name ?? '-' }}</p>

                        {{-- Tampilkan jumlah likes --}}
                        <p class="text-muted mb-2">Likes: {{ $mod->likes_count ?? 0 }}</p>

                        <p class="text-muted">{{ Str::limit($mod->description, 100) }}</p>

                        <a href="{{ route('pelajaran.module.show', $mod->id) }}" 
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
