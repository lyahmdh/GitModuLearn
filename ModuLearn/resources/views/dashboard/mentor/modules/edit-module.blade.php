@extends('layouts.dashboard')
@section('title', 'Dashboard') 
@section('content')
<div class="container py-4">

    <h3 class="fw-bold mb-4">Edit Modul</h3>

    <div class="card shadow-sm p-4">

        <form method="POST" action="{{ route('dashboard.mentor.modules.update', $module->id) }}" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label class="form-label">Judul Modul</label>
                <input type="text" name="title" class="form-control" value="{{ $module->title }}" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Deskripsi</label>
                <textarea name="description" class="form-control" rows="4" required>{{ $module->description }}</textarea>
            </div>

            <div class="mb-3">
                <label class="form-label">Kategori</label>
                <select name="category_id" class="form-select" required>
                    @foreach($categories as $cat)
                    <option value="{{ $cat->id }}" @selected($cat->id == $module->category_id)>
                        {{ $cat->name }}
                    </option>
                    @endforeach
                </select>
            </div>

            <div class="mb-3">
                <label class="form-label">Thumbnail Baru (opsional)</label>
                <input type="file" name="thumbnail" class="form-control">
            </div>

            <button class="btn btn-warning px-4">Simpan Perubahan</button>

        </form>

    </div>

</div>
@endsection
