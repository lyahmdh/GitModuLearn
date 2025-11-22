@extends('layouts.dashboard')
@section('title', 'Dashboard') 
@section('content')
<div class="container py-4">

    <h3 class="fw-bold mb-4">Semua Modul</h3>

    <table class="table table-bordered table-striped shadow-sm">
        <thead class="table-dark">
            <tr>
                <th>Modul</th>
                <th>Kategori</th>
                <th>Likes</th>
                <th>Aksi</th>
            </tr>
        </thead>

        <tbody>
            @foreach($modules as $mod)
            <tr>
                <td>{{ $mod->title }}</td>
                <td>{{ $mod->category->name }}</td>
                <td>{{ $mod->likes_count }}</td>
                <td>
                    <form method="POST" action="{{ route('api.modules.delete', $mod->id) }}">
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
