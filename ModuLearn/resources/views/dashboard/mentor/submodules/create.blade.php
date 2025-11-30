@extends('layouts.dashboard')
@section('title', 'Buat Submodule')
@section('content')

<style>
    .page-title {
        border-left: 6px solid #0d6efd;
        padding-left: 12px;
        font-weight: 800;
        font-size: 2rem;
    }

    .section-card {
        border-radius: 18px;
        transition: 0.25s ease;
        border: none;
    }

    .section-card:hover {
        transform: translateY(-3px);
        box-shadow: 0px 12px 25px rgba(29, 120, 248, 0.12);
    }

    .modern-input {
        border-radius: 12px;
        padding: 12px 14px;
        border: 1.5px solid #d6d6d6ff;
        transition: 0.25s ease-in-out;
    }

    .modern-input:focus {
        border-color: #0d6efd;
        box-shadow: 0 0 0 3px rgba(13,110,253,0.18);
    }

    .modern-label {
        font-weight: 600;
        margin-bottom: 6px;
    }
</style>

<div class="container py-4">

    <h1 class="page-title mb-1">Modul: {{ $module->title }}</h1>
    <p class="text-muted mb-4 ms-1">Buat Submodule</p>

    <div class="card shadow section-card p-4">

        <form method="POST" action="{{ route('dashboard.mentor.submodules.store', $module->id) }}">
            @csrf

            <div class="mb-3">
                <label class="modern-label">Judul Submodule</label>
                <input type="text" name="title" class="form-control modern-input" required>
            </div>

            <div class="mb-3">
                <label class="modern-label">Tipe Konten</label>
                <select name="content_type" class="form-select modern-input" required>
                    <option value="pdf">PDF</option>
                    <option value="doc">DOC</option>
                    <option value="ppt">PPT</option>
                    <option value="video">Video</option>
                    <option value="text">Text</option>
                </select>
            </div>

            <div class="mb-3">
                <label class="modern-label">URL Konten</label>
                <input type="text" name="content_url" class="form-control modern-input" required>
            </div>

            <div class="mb-3">
                <label class="modern-label">Urutan</label>
                <input type="number" name="order" class="form-control modern-input" value="1" required>
            </div>

            <!-- BUTTON YANG SUDAH DIBENARKAN -->
            <div class="text-end mt-4">
            <button class="btn fw-semibold px-4 py-2 shadow-sm"
                style="
                    background: #0d6efd;
                    color: #fff;
                    border-radius: 10px;
                    border: none;
                    font-size: 15px;
                    padding: 10px 22px;
                    transition: 0.25s;
                "
                onmouseover="this.style.background='#0b5ed7'"
                onmouseout="this.style.background='#0d6efd'">
                Buat Submodule
            </button>
            </div>


        </form>
    </div>
</div>

@endsection
