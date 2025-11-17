@extends('layouts.admin')

@section('title', 'Edit User')

@section('content')
<h4 class="fw-bold mb-4">Edit User</h4>

<div class="card shadow-sm">
    <div class="card-body">

        <form action="{{ route('admin.user.update', $user->id) }}" method="POST">
            @csrf @method('PUT')

            <div class="mb-3">
                <label class="form-label">Nama</label>
                <input type="text" name="nama" class="form-control" value="{{ $user->nama }}" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Email</label>
                <input type="email" name="email" class="form-control" value="{{ $user->email }}" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Role</label>
                <select name="role" class="form-select">
                    <option value="mentee" {{ $user->role == 'mentee' ? 'selected' : '' }}>Mentee</option>
                    <option value="mentor" {{ $user->role == 'mentor' ? 'selected' : '' }}>Mentor</option>
                    <option value="admin" {{ $user->role == 'admin' ? 'selected' : '' }}>Admin</option>
                </select>
            </div>

            <button class="btn btn-warning">Update</button>
            <a href="{{ route('admin.user.index') }}" class="btn btn-secondary">Kembali</a>

        </form>

    </div>
</div>
@endsection
