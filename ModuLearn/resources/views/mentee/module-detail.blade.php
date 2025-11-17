@extends('layouts.app')

@section('title', $module->title)

@section('content')
<div class="container py-4">

    <h2 class="fw-bold">{{ $module->title }}</h2>
    <p class="text-muted">Mentor: {{ $module->mentor->name }}</p>

    {{-- PROGRESS --}}
    <div class="my-4">
        <h6 class="fw-semibold">Progress Belajar</h6>
        <div class="progress" style="height: 22px;">
            <div class="progress-bar bg-success"
                role="progressbar"
                style="width: {{ $progress }}%;"
                aria-valuenow="{{ $progress }}"
                aria-valuemin="0"
                aria-valuemax="100">
                {{ $progress }}%
            </div>
        </div>
    </div>

    <h4 class="fw-bold mt-5">Submodul</h4>
    <div class="list-group mt-3">

        @foreach ($module->submodules as $sub)
        <a href="{{ route('mentee.submodule', $sub->id) }}"
           class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">

            <div>
                <strong>{{ $sub->title }}</strong>
                <br>
                <span class="text-muted small">{{ strtoupper($sub->type) }}</span>
            </div>

            @if ($sub->type == 'video')
                <span class="badge bg-primary">Video</span>
            @else
                <span class="badge bg-success">PDF</span>
            @endif

        </a>
        @endforeach

    </div>

</div>
@endsection
