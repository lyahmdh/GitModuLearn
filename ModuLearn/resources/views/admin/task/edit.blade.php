@extends('layouts.admin')

@section('title', 'Edit Task')

@section('content')
<h4 class="fw-bold mb-4">Edit Task</h4>

<div class="card shadow-sm">
    <div class="card-body">
        <form action="{{ route('admin.task.update', $task->id) }}" method="POST">
            @csrf @method('PUT')

            <div class="mb-3">
                <label class="form-label">Submodul</label>
                <select name="submodul_id" class="form-select">
                    @foreach($submodul as $s)
                    <option value="{{ $s->id }}" {{ $s->id == $task->submodul_id ? 'selected' : '' }}>
                        {{ $s->judul }}
                    </option>
                    @endforeach
                </select>
            </div>

            <div class="mb-3">
                <label class="form-label">Judul Task</label>
                <input type="text" name="judul" class="form-control" value="{{ $task->judul }}" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Deskripsi</label>
                <textarea name="deskripsi" class="form-control" rows="4" required>{{ $task->deskripsi }}</textarea>
            </div>

            <div class="mb-3">
                <label class="form-label">Deadline</label>
                <input type="date" name="deadline" class="form-control" value="{{ $task->deadline }}" required>
            </div>

            <button class="btn btn-warning">Update</button>
            <a href="{{ route('admin.task.index') }}" class="btn btn-secondary">Kembali</a>
        </form>
    </div>
</div>
@endsection
