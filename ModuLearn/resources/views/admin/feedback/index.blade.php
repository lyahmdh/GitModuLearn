@extends('layouts.admin')

@section('title', 'Feedback Mentee')

@section('content')
<h4 class="fw-bold mb-4">Daftar Feedback</h4>

<div class="card shadow-sm">
    <div class="card-body p-0">

        <table class="table table-hover">
            <thead class="table-light">
                <tr>
                    <th>No</th>
                    <th>Mentee</th>
                    <th>Modul</th>
                    <th>Isi Feedback</th>
                    <th>Aksi</th>
                </tr>
            </thead>

            <tbody>
                @foreach($feedback as $f)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $f->mentee->nama }}</td>
                    <td>{{ $f->modul->nama }}</td>
                    <td>{{ Str::limit($f->pesan, 40) }}</td>
                    <td>
                        <a href="{{ route('admin.feedback.show', $f->id) }}" class="btn btn-sm btn-outline-info">
                            Detail
                        </a>
                    </td>
                </tr>
                @endforeach
            </tbody>

        </table>

    </div>
</div>
@endsection
