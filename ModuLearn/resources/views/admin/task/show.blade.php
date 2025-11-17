@extends('layouts.admin')

@section('title', 'Detail Task')

@section('content')
<h4 class="fw-bold mb-3">Detail Task</h4>

<div class="card shadow-sm">
    <div class="card-body">
        <h5 class="fw-bold">{{ $task->judul }}</h5>
        <p class="text-muted">Submodul: <b>{{ $task->submodul->judul }}</b></p>
        <p>{{ $task->deskripsi }}</p>
        <p class="mt-2"><b>Deadline:</b> {{ $task->deadline }}</p>
    </div>
</div>
@endsection
