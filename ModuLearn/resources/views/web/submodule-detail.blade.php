@extends('layouts.app')

@section('content')

<div class="container">

    <h3 class="fw-bold mb-3">{{ $submodule->title }}</h3>

    <p class="text-secondary mb-3">
        Bagian dari modul: <strong>{{ $submodule->module->title }}</strong>
    </p>

    <div class="mb-4">

        @if ($submodule->type === 'pdf')
            <iframe 
                src="{{ $submodule->file_url }}" 
                class="w-100 border"
                style="height: 600px;"
            ></iframe>

        @elseif ($submodule->type === 'video')
            <video class="w-100 rounded" controls>
                <source src="{{ $submodule->file_url }}" type="video/mp4">
            </video>
        @endif

    </div>

    <!-- MARK AS DONE BUTTON -->
    @if(!$isDone)
        <form action="{{ route('submodules.markDone', $submodule->id) }}" method="POST">
            @csrf
            <button class="btn btn-success px-4">✔ Mark as Done</button>
        </form>
    @else
        <span class="badge bg-success">Sudah Selesai</span>
    @endif

</div>

@endsection
