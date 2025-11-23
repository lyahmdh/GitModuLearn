@extends('layouts.app')

@section('content')
<div class="container py-4">

    <h2 class="fw-bold mb-4">Buat Modul Baru</h2>

    <div class="card shadow-sm p-4">

        <form method="POST" action="{{ route('mentor.modules.store') }}" enctype="multipart/form-data">
            @csrf

            {{-- JUDUL --}}
            <div class="mb-3">
                <label class="form-label">Judul Modul</label>
                <input type="text" name="title" class="form-control" required>
            </div>

            {{-- DESKRIPSI --}}
            <div class="mb-3">
                <label class="form-label">Deskripsi</label>
                <textarea name="description" class="form-control" rows="4" required></textarea>
            </div>

            {{-- KATEGORI --}}
            <div class="mb-3">
                <label class="form-label">Kategori</label>
                <select name="category_id" class="form-select" required>
                    <option value="">Pilih kategori</option>
                    @foreach($categories as $cat)
                        <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                    @endforeach
                </select>
            </div>

            {{-- THUMBNAIL --}}
            <div class="mb-3">
                <label class="form-label">Thumbnail</label>
                <input type="file" name="thumbnail" class="form-control" required>
            </div>

            {{-- SUBMIT --}}
            <button class="btn btn-primary px-4">Submit Modul</button>

        </form>

    </div>

</div>
@endsection
