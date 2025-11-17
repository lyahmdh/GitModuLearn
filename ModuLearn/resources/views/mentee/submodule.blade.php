@extends('layouts.app')

@section('title', $submodule->title)

@section('content')
<div class="container py-4">

    <h3 class="fw-bold mb-4">{{ $submodule->title }}</h3>

    {{-- VIDEO --}}
    @if ($submodule->type === 'video')
        <div class="ratio ratio-16x9 mb-4">
            <iframe src="{{ $submodule->content_url }}" allowfullscreen></iframe>
        </div>
    @endif

    {{-- PDF --}}
    @if ($submodule->type === 'pdf')
        <div class="mb-4">
            <iframe src="{{ $submodule->content_url }}" width="100%" height="600px"></iframe>
        </div>
    @endif

    <a href="{{ url()->previous() }}" class="btn btn-secondary">Kembali</a>

</div>
@endsection
