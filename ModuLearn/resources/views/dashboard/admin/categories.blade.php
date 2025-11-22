@extends('layouts.dashboard')
@section('title', 'Dashboard') 
@section('content')
<div class="container py-4">

    <h3 class="fw-bold mb-4">Kategori Modul</h3>

    <div class="card shadow-sm p-3 mb-4">
        <form method="POST" action="{{ route('api.categories.store') }}">
            @csrf
            <div class="d-flex">
                <input type="text" name="name" class="form-control" placeholder="Tambah kategori baru..." required>
                <button class="btn btn-primary ms-2">Tambah</button>
            </div>
        </form>
    </div>

    <table class="table table-bordered table-striped shadow-sm">
        <thead class="table-dark">
            <tr>
                <th>Nama</th>
                <th>Aksi</th>
            </tr>
        </thead>

        <tbody>
            @foreach($categories as $cat)
            <tr>
                <td>{{ $cat->name }}</td>
                <td>
                    <form method="POST" action="{{ route('api.categories.delete', $cat->id) }}">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-danger btn-sm">Hapus</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>

    </table>

</div>
@endsection
