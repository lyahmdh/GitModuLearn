@extends('layouts.app')

@section('content')
<div class="container py-4">

    {{-- BACK --}}
    <a href="{{ route('modules.show', $submodule->module_id) }}" class="btn btn-secondary mb-3">
        ← Kembali ke Modul
    </a>

    {{-- TITLE --}}
    <h2 class="fw-bold mb-3">{{ $submodule->title }}</h2>

    {{-- CONTENT DISPLAY --}}
    <div class="card shadow-sm p-4 mb-4">
        {!! $submodule->content !!}
    </div>

    {{-- MARK AS COMPLETED --}}
    <form method="POST" action="{{ route('submodules.complete', $submodule->id) }}">
        @csrf
        <button class="btn btn-success px-4">
            Tandai Selesai
        </button>
    </form>

</div>
@endsection
