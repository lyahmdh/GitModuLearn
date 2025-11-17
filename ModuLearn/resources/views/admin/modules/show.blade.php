@extends('layouts.admin')

@section('title', 'Detail Modul')

@section('content')
<h4 class="fw-bold mb-3">Detail Modul</h4>

<div class="card shadow-sm mb-4">
    <div class="card-body">
        <h5 class="fw-bold">{{ $modul->nama }}</h5>
        <p>{{ $modul->deskripsi }}</p>
    </div>
</div>

<h5 class="fw-bold">Daftar Submodul</h5>

<div class="card shadow-sm">
    <div class="card-body p-0">
        <table class="table table-hover mb-0">
            <thead class="table-light">
                <tr>
                    <th>No</th>
                    <th>Judul Submodul</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($modul->submodul as $s)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $s->judul }}</td>
                    <td>
                        <a href="{{ route('admin.submodul.show', $s->id) }}" class="btn btn-sm btn-info">Detail</a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
