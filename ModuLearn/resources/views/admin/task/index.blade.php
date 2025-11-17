@extends('layouts.admin')

@section('title', 'Daftar Task')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h4 class="fw-bold">Daftar Task</h4>
    <a href="{{ route('admin.task.create') }}" class="btn btn-primary">Tambah Task</a>
</div>

<div class="card shadow-sm">
    <div class="card-body p-0">
        <table class="table table-hover">
            <thead class="table-light">
                <tr>
                    <th>No</th>
                    <th>Judul Task</th>
                    <th>Submodul</th>
                    <th>Deadline</th>
                    <th>Aksi</th>
                </tr>
            </thead>

            <tbody>
                @foreach($task as $t)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $t->judul }}</td>
                    <td>{{ $t->submodul->judul }}</td>
                    <td>{{ $t->deadline }}</td>
                    <td>
                        <a href="{{ route('admin.task.show', $t->id) }}" class="btn btn-sm btn-outline-info">Detail</a>
                        <a href="{{ route('admin.task.edit', $t->id) }}" class="btn btn-sm btn-outline-warning">Edit</a>
                        <form action="{{ route('admin.task.destroy', $t->id) }}" method="POST" class="d-inline">
                            @csrf @method('DELETE')
                            <button class="btn btn-sm btn-outline-danger" onclick="return confirm('Hapus task ini?')">Hapus</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>

        </table>
    </div>
</div>
@endsection
