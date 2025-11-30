@extends('layouts.dashboard')
@section('title', 'Edit Submodule')
@section('content')
<div class="container py-4">
    <h3>Edit Submodule: {{ $submodule->title }}</h3>

    <form action="{{ route('dashboard.mentor.submodules.update', [$module->id, $submodule->id]) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label>Judul Submodule</label>
            <input type="text" name="title" class="form-control" value="{{ old('title', $submodule->title) }}">
        </div>

        <div class="mb-3">
            <label>Tipe Konten</label>
            <select name="content_type" class="form-control">
                <option value="pdf" {{ $submodule->content_type=='pdf' ? 'selected' : '' }}>PDF</option>
                <option value="doc" {{ $submodule->content_type=='doc' ? 'selected' : '' }}>DOC</option>
                <option value="ppt" {{ $submodule->content_type=='ppt' ? 'selected' : '' }}>PPT</option>
                <option value="video" {{ $submodule->content_type=='video' ? 'selected' : '' }}>Video</option>
                <option value="text" {{ $submodule->content_type=='text' ? 'selected' : '' }}>Text</option>
            </select>
        </div>

        <div class="mb-3">
            <label>URL Konten</label>
            <input type="text" name="content_url" class="form-control" value="{{ old('content_url', $submodule->content_url) }}">
        </div>

        <div class="mb-3">
            <label>Urutan</label>
            <input type="number" name="order" class="form-control" value="{{ old('order', $submodule->order) }}">
        </div>

        <button type="submit" class="btn btn-success">Update Submodule</button>
        <a href="{{ route('dashboard.mentor.submodules.index', $module->id) }}" class="btn btn-secondary">Batal</a>
    </form>
</div>
@endsection
