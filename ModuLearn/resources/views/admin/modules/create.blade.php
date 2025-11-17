@extends('layouts.admin')

@section('title', 'Tambah Modul')

@section('content')
<h4 class="fw-bold mb-4">Tambah Modul</h4>

<div class="card shadow-sm">
    <div class="card-body">
        <form action="{{ route('admin.modul.store') }}" method="POST">
            @csrf

            <div class="mb-3">
                <label class="form-label">Nama Modul</label>
                <input type="text" name="nama" class="form-control" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Deskripsi</label>
                <textarea name="deskripsi" class="form-control" rows="5" required></textarea>
            </div>

            <button class="btn btn-primary">Simpan</button>
            <a href="{{ route('admin.modul.index') }}" class="btn btn-secondary">Kembali</a>
        </form>
    </div>
</div>
@endsection
