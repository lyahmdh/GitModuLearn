@extends('layouts.dashboard')
@section('title', 'Edit Submodule')

@section('content')

<style>
    .modern-input {
        border-radius: 12px;
        padding: 12px 14px;
        border: 1.5px solid #d6d6d6;
        transition: 0.25s ease-in-out;
    }
    .modern-input:focus {
        border-color: #0d6efd;
        box-shadow: 0 0 0 3px rgba(13,110,253,0.18);
    }

    .section-card {
        border-radius: 18px;
        padding: 25px;
        transition: 0.2s ease;
        border: none;
    }
    .section-card:hover {
        transform: translateY(-3px);
        box-shadow: 0px 10px 22px rgba(0,0,0,0.12);
    }

    .page-title {
        border-left: 6px solid #0d6efd;
        padding-left: 12px;
        font-weight: 800;
    }
</style>

<div class="container py-4">

    <!-- HEADER -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="page-title m-0">Edit Submodule</h2>

        <a href="{{ route('dashboard.mentor.submodules.index', $module->id) }}" 
           class="btn btn-primary px-4 py-2 fw-semibold rounded-3">
            Kembali
        </a>
    </div>

    <!-- CARD -->
    <div class="card shadow section-card">

        <form action="{{ route('dashboard.mentor.submodules.update', [$module->id, $submodule->id]) }}" method="POST">
            @csrf
            @method('PUT')

            <!-- Judul -->
            <div class="mb-3">
                <label class="fw-semibold mb-1">Judul Submodule</label>
                <input type="text" name="title" class="form-control modern-input"
                       value="{{ old('title', $submodule->title) }}" required>
            </div>

            <!-- Tipe -->
            <div class="mb-3">
                <label class="fw-semibold mb-1">Tipe Konten</label>
                <select name="content_type" class="form-control modern-input" required>
                    <option value="pdf"   {{ $submodule->content_type=='pdf' ? 'selected' : '' }}>PDF</option>
                    <option value="doc"   {{ $submodule->content_type=='doc' ? 'selected' : '' }}>DOC</option>
                    <option value="ppt"   {{ $submodule->content_type=='ppt' ? 'selected' : '' }}>PPT</option>
                    <option value="video" {{ $submodule->content_type=='video' ? 'selected' : '' }}>Video</option>
                    <option value="text"  {{ $submodule->content_type=='text' ? 'selected' : '' }}>Text</option>
                </select>
            </div>

            <!-- URL -->
            <div class="mb-3">
                <label class="fw-semibold mb-1">URL Konten</label>
                <input type="text" name="content_url" class="form-control modern-input"
                       value="{{ old('content_url', $submodule->content_url) }}" required>
            </div>

            <!-- Urutan -->
            <div class="mb-3">
                <label class="fw-semibold mb-1">Urutan</label>
                <input type="number" name="order" class="form-control modern-input"
                       value="{{ old('order', $submodule->order) }}" required>
            </div>

            <!-- BUTTON -->
            <div class="d-flex justify-content-end gap-2 mt-4">

                <button type="submit" class="btn btn-primary px-4 py-2 fw-semibold rounded-3">
                    Update Submodule
                </button>

                <a href="{{ route('dashboard.mentor.submodules.index', $module->id) }}"
                   class="btn btn-outline-secondary px-4 py-2 fw-semibold rounded-3">
                    Batal
                </a>
            </div>

        </form>

    </div>

</div>

@endsection
