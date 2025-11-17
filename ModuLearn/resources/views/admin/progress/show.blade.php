@extends('layouts.admin')

@section('title', 'Detail Progress')

@section('content')
<h4 class="fw-bold mb-3">Detail Progress</h4>

<div class="card shadow-sm">
    <div class="card-body">

        <p><b>Mentee:</b> {{ $progress->mentee->nama }}</p>
        <p><b>Modul:</b> {{ $progress->modul->nama }}</p>
        <p><b>Submodul:</b> {{ $progress->submodul->judul }}</p>
        <p><b>Task:</b> {{ $progress->task->judul }}</p>
        <p><b>Status:</b>
            <span class="badge bg-{{ $progress->status == 'Selesai' ? 'success' : 'secondary' }}">
                {{ $progress->status }}
            </span>
        </p>
        <p><b>Tanggal Update:</b> {{ $progress->updated_at }}</p>

        <hr>

        <p class="text-muted">
            Progress diupdate secara otomatis ketika mentee menyelesaikan task atau dibantu oleh mentor.
        </p>

    </div>
</div>
@endsection
