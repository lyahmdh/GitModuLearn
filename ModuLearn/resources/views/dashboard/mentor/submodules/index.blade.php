@extends('layouts.dashboard')
@section('title', 'Submodules')

@section('content')

<style>
    :root {
        --blue-start: #0d6efd;
        --blue-end: #0a58ca;
        --bg-light: #f1f5ff;
        --text-dark: #1c1c1c;
    }

    body {
        background: var(--bg-light);
    }

    /* HEADER — clean, modern, rounded */
    .page-header {
        background: linear-gradient(135deg, var(--blue-start), var(--blue-end));
        padding: 28px 34px;
        border-radius: 20px;
        box-shadow: 0 10px 30px rgba(13,110,253,0.25);
        color: #fff;
    }
    .page-header h3 {
        margin: 0;
        font-size: 1.8rem;
        font-weight: 700;
    }

    /* MAIN CARD LIST WRAPPER */
    .submodule-wrapper {
        background: #fff;
        border-radius: 20px;
        padding: 24px;
        box-shadow: 0 6px 20px rgba(0,0,0,0.08);
        border: 1px solid #e5e9f5;
    }

    /* CARD ITEM */
    .submodule-card {
        padding: 18px;
        border-radius: 16px;
        border: 1px solid #e3e7f3;
        background: white;
        transition: .25s;
        box-shadow: 0 4px 12px rgba(0,0,0,0.06);
    }
    .submodule-card:hover {
        transform: translateY(-4px);
        box-shadow: 0 10px 24px rgba(0,0,0,0.12);
    }

    h5 {
        font-weight: 600;
        color: var(--blue-start);
    }

    /* BUTTONS */
    .btn-gradient {
        background: linear-gradient(135deg, var(--blue-start), var(--blue-end));
        padding: 10px 18px;
        border-radius: 12px;
        color: #fff !important;
        border: none;
        font-weight: 600;
        transition: .15s;
    }
    .btn-gradient:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 18px rgba(13,110,253,0.4);
    }

    .btn-outline-primary {
        border-radius: 12px;
        border-color: var(--blue-start);
        color: var(--blue-start);
        font-weight: 600;
    }
    .btn-outline-primary:hover {
        background: var(--blue-start);
        color: #fff !important;
    }

    .btn-outline-danger {
        border-radius: 12px;
        font-weight: 600;
    }

</style>

<div class="container py-4">

    {{-- HEADER --}}
    <div class="page-header mb-4 d-flex justify-content-between align-items-center">
        <h3>
            <i class="fa fa-layer-group me-2"></i>
            Submodule untuk Modul: <span class="fw-light">{{ $module->title }}</span>
        </h3>

        <a href="{{ route('dashboard.mentor.submodules.create', $module->id) }}"
           class="btn btn-gradient px-4 py-2 rounded-pill shadow-sm">
            <i class="fa fa-plus me-1"></i> Tambah Submodule
        </a>
    </div>

    {{-- LIST SUBMODULE --}}
    <div class="row">
        @forelse($submodules as $sub)
            <div class="col-md-4 mb-4">
                <div class="card rounded-4 submodule-card h-100">
                    <div class="card-body">

                        <h5 class="fw-bold text-dark mb-3">
                            <i class="fa fa-book-open text-primary me-2"></i>
                            {{ $sub->title }}
                        </h5>

                        <div class="small text-muted">
                            <p class="mb-2"><strong class="text-primary">Tipe:</strong> {{ strtoupper($sub->content_type) }}</p>
                            <p class="mb-2"><strong class="text-primary">URL:</strong> {{ $sub->content_url }}</p>
                            <p class="mb-2"><strong class="text-primary">Urutan:</strong> {{ $sub->order }}</p>
                        </div>

                        <div class="d-flex justify-content-between mt-4">

                            <a href="{{ route('dashboard.mentor.submodules.edit', [$module->id, $sub->id]) }}"
                               class="btn btn-sm btn-outline-primary px-3 rounded-pill">
                                <i class="fa fa-edit me-1"></i> Edit
                            </a>

                            <form action="{{ route('dashboard.mentor.submodules.destroy', [$module->id, $sub->id]) }}" method="POST"
                                  onsubmit="return confirm('Apakah yakin ingin menghapus submodule ini?')">
                                @csrf
                                @method('DELETE')

                                <button type="submit" class="btn btn-sm btn-outline-danger px-3 rounded-pill">
                                    <i class="fa fa-trash me-1"></i> Hapus
                                </button>
                            </form>

                        </div>

                    </div>
                </div>
            </div>
        @empty
            <div class="col-12 text-center py-5">
                <p class="text-muted fs-5">Belum ada submodule pada modul ini.</p>
            </div>
        @endforelse
    </div>

</div>

@endsection
