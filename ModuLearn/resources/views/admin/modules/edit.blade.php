@extends('layouts.admin')

@section('title', 'Edit Modul')

@section('content')
<h4 class="fw-bold mb-4">Edit Modul</h4>

<div class="card shadow-sm">
    <div class="card-body">
        <form action="{{ route('admin.modul.update', $modul->id) }}" method="POST">
            @csrf @method('PUT')

            <div class="mb-3">
                <label class="form-label">Nama Modul</label>
                <input type="text" name="nama" class="form-control" value="{{ $modul->nama }}" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Deskripsi</label>
                <textarea name="deskripsi" class="form-control" rows="5" required>{{ $modul->deskripsi }}</textarea>
            </div>

            <button class="btn btn-warning">Update</button>
            <a href="{{ route('admin.modul.index') }}" class="btn btn-secondary">Kembali</a>
        </form>
    </div>
</div>
@endsection
