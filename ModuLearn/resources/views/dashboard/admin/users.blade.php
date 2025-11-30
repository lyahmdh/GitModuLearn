@extends('layouts.dashboard')
@section('title', 'Users')
@section('content')
<div class="container py-4">

    {{-- JUDUL --}}
    <h1 class="mb-4 text-primary"
        style="font-size: 2.5rem; font-weight: 800; border-bottom: 4px solid #000000; padding-bottom: 8px;">
        Semua User
    </h1>

    {{-- WRAPPER TABLE  --}}
    <div class="p-4 shadow-sm"
         style="background: #ffffff; border-radius: 20px;">

        <table class="table table-striped table-bordered" style="width: 100%;">

            <thead>
                <tr>
                    <th style="padding: 14px;">ID</th>
                    <th style="padding: 14px;">Nama</th>
                    <th style="padding: 14px;">Email</th>
                    <th style="padding: 14px;">Role</th>
                    <th style="padding: 14px;">Tanggal Daftar</th>
                </tr>
            </thead>

            <tbody>
                @foreach($users as $user)
                <tr>
                    <td style="padding: 14px;">{{ $user->id }}</td>
                    <td style="padding: 14px;">{{ $user->name }}</td>
                    <td style="padding: 14px;">{{ $user->email }}</td>
                    <td style="padding: 14px;">{{ $user->role }}</td>
                    <td style="padding: 14px;">{{ $user->created_at->format('d M Y') }}</td>
                </tr>
                @endforeach
            </tbody>

        </table>

    </div>

</div>
@endsection
