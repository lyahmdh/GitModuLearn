@extends('layouts.admin')

@section('title', 'Manajemen User')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h4 class="fw-bold">Manajemen User</h4>
    <a href="{{ route('admin.user.create') }}" class="btn btn-primary">Tambah User</a>
</div>

<div class="card shadow-sm">
    <div class="card-body p-0">

        <table class="table table-hover">
            <thead class="table-light">
                <tr>
                    <th>No</th>
                    <th>Nama</th>
                    <th>Email</th>
                    <th>Role</th>
                    <th>Aksi</th>
                </tr>
            </thead>

            <tbody>
                @foreach($user as $u)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $u->nama }}</td>
                    <td>{{ $u->email }}</td>
                    <td>
                        <span class="badge bg-dark">{{ ucfirst($u->role) }}</span>
                    </td>
                    <td>
                        <a href="{{ route('admin.user.show', $u->id) }}" class="btn btn-sm btn-outline-info">Detail</a>
                        <a href="{{ route('admin.user.edit', $u->id) }}" class="btn btn-sm btn-outline-warning">Edit</a>
                    </td>
                </tr>
                @endforeach
            </tbody>

        </table>

    </div>
</div>
@endsection
