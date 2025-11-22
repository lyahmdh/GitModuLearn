@extends('layouts.dashboard')
@section('title', 'Dashboard') 
@section('content')
<div class="container py-4">

    <h3 class="fw-bold mb-4">Verifikasi Mentor</h3>

    <table class="table table-bordered table-striped shadow-sm">
        <thead class="table-dark">
            <tr>
                <th>Nama</th>
                <th>Email</th>
                <th>Dokumen</th>
                <th>Aksi</th>
            </tr>
        </thead>

        <tbody>

            @foreach($requests as $req)
            <tr>
                <td>{{ $req->user->name }}</td>
                <td>{{ $req->user->email }}</td>
                <td>
                    <a href="{{ asset('storage/' . $req->document) }}" target="_blank" class="btn btn-info btn-sm">
                        Lihat
                    </a>
                </td>
                <td class="d-flex gap-2">
                    
                    <form method="POST" action="{{ route('admin.mentorVerification.approve', $req->id) }}">
                        @csrf
                        <button class="btn btn-success btn-sm">Approve</button>
                    </form>

                    <form method="POST" action="{{ route('admin.mentorVerification.reject', $req->id) }}">
                        @csrf
                        <button class="btn btn-danger btn-sm">Reject</button>
                    </form>

                </td>
            </tr>
            @endforeach

        </tbody>
    </table>

</div>
@endsection
