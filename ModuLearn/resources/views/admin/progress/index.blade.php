@extends('layouts.admin')

@section('title', 'Progress Mentee')

@section('content')
<h4 class="fw-bold mb-4">Progress Semua Mentee</h4>

<div class="card shadow-sm">
    <div class="card-body p-0">
        <table class="table table-hover mb-0">
            <thead class="table-light">
                <tr>
                    <th>No</th>
                    <th>Mentee</th>
                    <th>Modul</th>
                    <th>Submodul</th>
                    <th>Task</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>
            </thead>

            <tbody>
                @foreach($progress as $p)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $p->mentee->nama }}</td>
                    <td>{{ $p->modul->nama }}</td>
                    <td>{{ $p->submodul->judul }}</td>
                    <td>{{ $p->task->judul }}</td>
                    <td>
                        <span class="badge bg-{{ $p->status == 'Selesai' ? 'success' : 'secondary' }}">
                            {{ $p->status }}
                        </span>
                    </td>
                    <td>
                        <a href="{{ route('admin.progress.show', $p->id) }}" class="btn btn-sm btn-outline-info">Detail</a>
                    </td>
                </tr>
                @endforeach
            </tbody>

        </table>
    </div>
</div>
@endsection
