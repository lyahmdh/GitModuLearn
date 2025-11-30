@extends('layouts.app')

@section('content')
<div class="container py-4">

    {{-- BACK --}}
    <a href="{{ route('pelajaran.module.show', $submodule->module_id) }}" class="btn btn-secondary mb-3">
        ← Kembali ke Modul
    </a>

    {{-- TITLE --}}
    <h2 class="fw-bold mb-3">{{ $submodule->title }}</h2>

    {{-- ================================
         CONTENT DISPLAY (RENDER URL)
       ================================ --}}
    <div class="card shadow-sm p-4 mb-4">

        @php
            $url = $submodule->content_url;
        @endphp

        <div class="content-area mt-2">

            {{-- 1. YOUTUBE --}}
            @if(Str::contains($url, 'youtube.com') || Str::contains($url, 'youtu.be'))

                @php
                    if (Str::contains($url, 'watch?v=')) {
                        $embed = str_replace('watch?v=', 'embed/', $url);
                    } else {
                        $videoId = Str::afterLast($url, '/');
                        $embed = 'https://www.youtube.com/embed/' . $videoId;
                    }
                @endphp

                <iframe width="100%" height="450"
                        src="{{ $embed }}"
                        frameborder="0"
                        allowfullscreen>
                </iframe>

            {{-- 2. GOOGLE DRIVE --}}
            @elseif(Str::contains($url, 'drive.google.com'))

                @php
                    $fileId = null;

                    if (Str::contains($url, '/d/')) {
                        $fileId = Str::between($url, '/d/', '/');
                    } elseif (Str::contains($url, 'id=')) {
                        $fileId = Str::after($url, 'id=');
                    }
                @endphp

                @if($fileId)
                    <iframe 
                        src="https://drive.google.com/file/d/{{ $fileId }}/preview"
                        width="100%" height="650"
                        allow="autoplay">
                    </iframe>
                @else
                    <p>Link Google Drive tidak valid.</p>
                @endif

            {{-- 3. PDF --}}
            @elseif(Str::endsWith($url, '.pdf'))
                <iframe src="{{ $url }}"
                        width="100%" height="700">
                </iframe>

            {{-- 4. VIDEO FILE MP4/WEBM/MOV --}}
            @elseif(Str::endsWith($url, '.mp4') || Str::endsWith($url, '.webm') || Str::endsWith($url, '.mov'))
                <video width="100%" controls>
                    <source src="{{ $url }}">
                    Browser kamu tidak mendukung video tag.
                </video>

            {{-- 5. DEFAULT (SEMUA LINK LAIN DI-IFRAME) --}}
            @else
                <iframe src="{{ $url }}"
                        width="100%" height="700"
                        style="border: none;">
                </iframe>
            @endif

        </div>
    </div>

    {{-- MARK AS COMPLETED --}}
    <form method="POST" 
      action="{{ route('pelajaran.submodule.toggle', [$submodule->module_id, $submodule->id]) }}">
        @csrf

        @if ($submodule->isCompletedBy(auth()->id()))
            <button class="btn btn-warning">Batalkan Selesai</button>
        @else
            <button class="btn btn-success">Tandai Selesai</button>
        @endif
    </form>

</div>
@endsection
