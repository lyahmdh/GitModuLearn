@extends('layouts.admin')

@section('title', 'Daftar Modul')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h4 class="fw-bold">Daftar Modul</h4>
    <a href="{{ route('admin.modul.create') }}" class="btn btn-primary">
        Tambah Modul
    </a>
</div>

<div class="card shadow-sm">
    <div class="card-body p-0">
        <table class="table table-hover mb-0">
            <thead class="table-light">
                <tr>
                    <th>No</th>
                    <th>Nama Modul</th>
                    <th>Deskripsi</th>
                    <th>Total Submodul</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($modul as $m)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $m->nama }}</td>
                    <td>{{ Str::limit($m->deskripsi, 50) }}</td>
                    <td>{{ $m->submodul_count }}</td>
                    <td>
                        <a href="{{ route('admin.modul.show', $m->id) }}" class="btn btn-sm btn-outline-info">Detail</a>
                        <a href="{{ route('admin.modul.edit', $m->id) }}" class="btn btn-sm btn-outline-warning">Edit</a>
                        <form action="{{ route('admin.modul.destroy', $m->id) }}" method="POST" class="d-inline">
                            @csrf @method('DELETE')
                            <button class="btn btn-sm btn-outline-danger" onclick="return confirm('Hapus modul ini?')">Hapus</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
