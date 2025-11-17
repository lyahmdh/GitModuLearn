@extends('layouts.app')

@section('content')

<div class="container">

    <div class="row mb-4">

        <div class="col-md-8">
            <h2 class="fw-bold">{{ $module->title }}</h2>

            <p class="text-secondary mb-1">
                Mentor: {{ $module->mentor->name }}
            </p>

            <span class="badge bg-primary mb-3">
                👍 {{ $module->likes_count }}
            </span>

            <p>{{ $module->description }}</p>
        </div>

        <div class="col-md-4 text-end">
            <img src="{{ $module->thumbnail_url ?? '/images/default-module.jpg' }}"
                 class="img-fluid rounded shadow-sm"
                 alt="module">
        </div>

    </div>

    <hr>

    <h4 class="fw-bold mb-3">Daftar Submodul</h4>

    @foreach ($submodules as $submodule)
        @include('components.submodule-item', ['submodule' => $submodule])
    @endforeach

</div>

@endsection
