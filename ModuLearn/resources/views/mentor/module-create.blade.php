@extends('layouts.app')

@section('title', 'Buat Modul')

@section('content')
<div class="container py-4">

    <h3 class="fw-bold mb-4">Buat Modul Baru</h3>

    <form action="{{ route('mentor.module.store') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label class="form-label">Judul Modul</label>
            <input type="text" name="title" class="form-control" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Kategori</label>
            <select class="form-select" name="category_id" required>
                @foreach ($categories as $c)
                <option value="{{ $c->id }}">{{ $c->name }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label class="form-label">Deskripsi</label>
            <textarea class="form-control" rows="5" name="description"></textarea>
        </div>

        <button class="btn btn-primary">Simpan</button>
        <a href="{{ route('mentor.modules') }}" class="btn btn-secondary">Batal</a>

    </form>

</div>
@endsection
