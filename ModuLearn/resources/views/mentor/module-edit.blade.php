@extends('layouts.app')

@section('title', 'Edit Modul')

@section('content')
<div class="container py-4">

    <h3 class="fw-bold mb-4">Edit Modul</h3>

    <form action="{{ route('mentor.module.update', $module->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label class="form-label">Judul Modul</label>
            <input type="text" name="title" class="form-control" value="{{ $module->title }}" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Kategori</label>
            <select class="form-select" name="category_id" required>
                @foreach ($categories as $c)
                <option value="{{ $c->id }}" 
                    @selected($c->id == $module->category_id)>
                    {{ $c->name }}
                </option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label class="form-label">Deskripsi</label>
            <textarea class="form-control" rows="5" name="description">{{ $module->description }}</textarea>
        </div>

        <button class="btn btn-warning">Update</button>
        <a href="{{ route('mentor.modules') }}" class="btn btn-secondary">Batal</a>
    </form>

</div>
@endsection
