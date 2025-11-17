@extends('layouts.admin')

@section('title', 'Detail Feedback')

@section('content')
<h4 class="fw-bold mb-3">Detail Feedback</h4>

<div class="card shadow-sm">
    <div class="card-body">

        <p><b>Mentee:</b> {{ $feedback->mentee->nama }}</p>
        <p><b>Modul:</b> {{ $feedback->modul->nama }}</p>

        <hr>

        <p><b>Isi Feedback:</b></p>
        <p>{{ $feedback->pesan }}</p>

    </div>
</div>
@endsection
