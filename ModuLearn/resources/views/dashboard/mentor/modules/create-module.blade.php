@extends('layouts.dashboard')
@section('title', 'Dashboard') 
@section('content')

<style>
    /* ===== HEADER STYLE ===== */
    .modules-header {
        background: linear-gradient(135deg, #1d4ed8, #3b82f6);
        padding: 32px;
        border-radius: 18px;
        color: white;
        margin-bottom: 40px;
        box-shadow: 0 8px 20px rgba(0,0,0,0.15);
        position: relative;
    }

    .modules-header h3 {
        font-size: 28px;
        font-weight: 700;
        margin-bottom: 6px;
    }

    .modules-header p {
        font-size: 15px;
        opacity: 0.9;
        margin-bottom: 0;
    }

    /* ===== CARD FORM ===== */
    .module-form-card {
        background: #fff;
        border-radius: 18px;
        padding: 32px;
        border: none;
        box-shadow: 0 6px 20px rgba(0,0,0,0.08);
        transition: 0.25s ease-in-out;
    }

    .module-form-card:hover {
        transform: translateY(-4px);
        box-shadow: 0 10px 25px rgba(0,0,0,0.12);
    }

    label.form-label {
        font-weight: 600;
        color: #1e3a8a;
        font-size: 15px;
    }

    input.form-control,
    textarea.form-control,
    select.form-select {
        border-radius: 12px;
        padding: 10px 14px;
        border: 1px solid #d1d5db;
        transition: 0.2s ease;
    }

    input.form-control:focus,
    textarea.form-control:focus,
    select.form-select:focus {
        border-color: #2563eb;
        box-shadow: 0 0 0 3px rgba(37, 99, 235, 0.15);
    }

    /* ===== BUTTON ===== */
    .btn-submit {
        background: #1d4ed8;
        color: white;
        padding: 10px 22px;
        border-radius: 10px;
        font-weight: 600;
        border: none;
        transition: 0.25s ease;
    }

    .btn-submit:hover {
        background: #1e40af;
        transform: scale(1.04);
    }

</style>

<div class="container py-4">

    {{-- Header --}}
    <div class="modules-header">
        <h3>Create New Module</h3>
        <p>Fill out the form below to add a new learning module to your content.</p>
    </div>

    {{-- Card Form --}}
    <div class="module-form-card">

        <form method="POST" action="{{ route('dashboard.mentor.modules.store') }}" enctype="multipart/form-data">
            @csrf

            <div class="mb-3">
                <label class="form-label">Judul Modul</label>
                <input type="text" name="title" class="form-control" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Deskripsi</label>
                <textarea name="description" class="form-control" rows="4" required></textarea>
            </div>

            <div class="mb-3">
                <label class="form-label">Kategori</label>
                <select name="category_id" class="form-select" required>
                    @foreach($categories as $cat)
                        <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="mb-3">
                <label class="form-label">Thumbnail Modul</label>
                <input type="file" name="thumbnail" class="form-control" required>
            </div>

            <button class="btn-submit">Buat Modul</button>
        </form>

    </div>

</div>

@endsection
