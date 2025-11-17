@extends('layouts.admin')

@section('title', 'Tambah User')

@section('content')
<h4 class="fw-bold mb-4">Tambah User</h4>

<div class="card shadow-sm">
    <div class="card-body">

        <form action="{{ route('admin.user.store') }}" method="POST">
            @csrf

            <div class="mb-3">
                <label class="form-label">Nama</label>
                <input type="text" name="nama" class="form-control" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Email</label>
                <input type="email" name="email" class="form-control" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Role</label>
                <select name="role" class="form-select" required>
                    <option value="mentee">Mentee</option>
                    <option value="mentor">Mentor</option>
                    <option value="admin">Admin</option>
                </select>
            </div>

            <div class="mb-3">
                <label class="form-label">Password</label>
                <input type="password" name="password" class="form-control" required>
            </div>

            <button class="btn btn-primary">Simpan</button>
            <a href="{{ route('admin.user.index') }}" class="btn btn-secondary">Kembali</a>

        </form>

    </div>
</div>
@endsection
