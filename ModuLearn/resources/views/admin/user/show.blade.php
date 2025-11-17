@extends('layouts.admin')

@section('title', 'Detail User')

@section('content')
<h4 class="fw-bold mb-3">Detail User</h4>

<div class="card shadow-sm">
    <div class="card-body">

        <p><b>Nama:</b> {{ $user->nama }}</p>
        <p><b>Email:</b> {{ $user->email }}</p>
        <p><b>Role:</b> <span class="badge bg-dark">{{ ucfirst($user->role) }}</span></p>
        <p><b>Dibuat pada:</b> {{ $user->created_at }}</p>

    </div>
</div>
@endsection
