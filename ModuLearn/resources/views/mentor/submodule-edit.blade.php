@extends('layouts.app')

@section('title', 'Edit Submodul')

@section('content')
<div class="container py-4">

    <h3 class="fw-bold mb-4">Edit Submodul</h3>

    <form action="{{ route('mentor.submodule.update', $submodule->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label class="form-label">Judul Submodul</label>
            <input type="text" name="title" class="form-control" value="{{ $submodule->title }}" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Jenis Konten</label>
            <select name="type" class="form-select">
                <option value="pdf" @selected($submodule->type == 'pdf')>PDF</option>
                <option value="video" @selected($submodule->type == 'video')>Video</option>
            </select>
        </div>

        <div class="mb-3">
            <label class="form-label">URL Konten</label>
            <input type="text" name="content_url" class="form-control" value="{{ $submodule->content_url }}" required>
        </div>

        <button class="btn btn-warning">Update</button>
        <a href="{{ route('mentor.module.detail', $submodule->module_id) }}" class="btn btn-secondary">Batal</a>

    </form>

</div>
@endsection
