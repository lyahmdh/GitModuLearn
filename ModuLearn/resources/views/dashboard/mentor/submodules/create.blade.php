@extends('layouts.dashboard')
@section('title', 'Buat Submodule')
@section('content')
<div class="container py-4">
    <h3 class="fw-bold mb-4">Buat Submodule untuk Modul: {{ $module->title }}</h3>

    <div class="card shadow-sm p-4">
        <form method="POST" action="{{ route('dashboard.mentor.submodules.store', $module->id) }}">
            @csrf

            <div class="mb-3">
                <label class="form-label">Judul Submodule</label>
                <input type="text" name="title" class="form-control" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Tipe Konten</label>
                <select name="content_type" class="form-select" required>
                    <option value="pdf">PDF</option>
                    <option value="doc">DOC</option>
                    <option value="ppt">PPT</option>
                    <option value="video">Video</option>
                    <option value="text">Text</option>
                </select>
            </div>

            <div class="mb-3">
                <label class="form-label">URL Konten</label>
                <input type="text" name="content_url" class="form-control" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Urutan</label>
                <input type="number" name="order" class="form-control" value="1" required>
            </div>

            <button class="btn btn-primary">Buat Submodule</button>
        </form>
    </div>
</div>
@endsection
