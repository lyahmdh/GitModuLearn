@extends('layouts.dashboard')

@section('title', 'Verifikasi Mentor')

@section('content')
<div class="container py-4">

    <h3 class="fw-bold mb-4">Ajukan Verifikasi Mentor</h3>

    <div class="card shadow-sm p-4">

        {{-- ALERT --}}
        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <p class="mb-3">
            Unggah dokumen verifikasi (KTP, CV, atau Sertifikat).
        </p>

        <form method="POST" action="{{ route('mentor.verification.store') }}" enctype="multipart/form-data">
            @csrf

            <div class="mb-3">
                <label class="form-label">Upload Dokumen</label>
                <input type="file" name="document" class="form-control" required>
            </div>

            <button type="submit" class="btn btn-primary">Submit</button>
        </form>

    </div>

</div>
@endsection
