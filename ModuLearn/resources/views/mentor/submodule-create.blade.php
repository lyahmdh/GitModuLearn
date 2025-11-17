@extends('layouts.app')

@section('title', 'Tambah Submodul')

@section('content')
<div class="container py-4">

    <h3 class="fw-bold mb-4">Tambah Submodul</h3>

    <form action="{{ route('mentor.submodule.store', $module->id) }}" method="POST">
        @csrf

        <div class="mb-3">
            <label class="form-label">Judul Submodul</label>
            <input type="text" name="title" class="form-control" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Jenis Konten</label>
            <select name="type" class="form-select" required>
                <option value="pdf">PDF</option>
                <option value="video">Video</option>
            </select>
        </div>

        <div class="mb-3">
            <label class="form-label">URL Konten</label>
            <input type="text" name="content_url" class="form-control" placeholder="https://..." required>
        </div>

        <button class="btn btn-primary">Simpan</button>
        <a href="{{ route('mentor.module.detail', $module->id) }}" class="btn btn-secondary">Batal</a>

    </form>

</div>
@endsection
