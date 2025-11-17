@extends('layouts.admin')

@section('title', 'Tambah Task')

@section('content')
<h4 class="fw-bold mb-4">Tambah Task</h4>

<div class="card shadow-sm">
    <div class="card-body">
        <form action="{{ route('admin.task.store') }}" method="POST">
            @csrf

            <div class="mb-3">
                <label class="form-label">Submodul</label>
                <select name="submodul_id" class="form-select" required>
                    @foreach($submodul as $s)
                    <option value="{{ $s->id }}">{{ $s->judul }}</option>
                    @endforeach
                </select>
            </div>

            <div class="mb-3">
                <label class="form-label">Judul Task</label>
                <input type="text" name="judul" class="form-control" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Deskripsi</label>
                <textarea name="deskripsi" class="form-control" rows="4" required></textarea>
            </div>

            <div class="mb-3">
                <label class="form-label">Deadline</label>
                <input type="date" name="deadline" class="form-control" required>
            </div>

            <button class="btn btn-primary">Simpan</button>
            <a href="{{ route('admin.task.index') }}" class="btn btn-secondary">Kembali</a>
        </form>
    </div>
</div>
@endsection
