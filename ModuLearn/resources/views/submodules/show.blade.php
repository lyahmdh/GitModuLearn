@extends('layouts.app')

@section('content')
<div class="container py-4">

    <!-- BACK BUTTON -->
    <a href="{{ route('pelajaran.module.show', $submodule->module_id) }}" class="btn btn-secondary mb-3">
        ← Kembali ke Modul
    </a>

    <!-- JUDUL DI BOX BIRU -->
    <div class="submodule-title-box d-block">
        {{ $submodule->title }}
    </div>

    {{-- CONTENT DISPLAY --}}
    <div class="card shadow-sm p-4 mb-4">
        <div class="content-area mt-2">
            @php $url = $submodule->content_url; @endphp

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
                <iframe width="100%" height="450" src="{{ $embed }}" frameborder="0" allowfullscreen></iframe>

            {{-- 2. GOOGLE DRIVE --}}
            @elseif(Str::contains($url, 'drive.google.com'))
                @php
                    $fileId = Str::contains($url, '/d/') ? Str::between($url, '/d/', '/') : Str::after($url, 'id=');
                @endphp
                @if($fileId)
                    <iframe src="https://drive.google.com/file/d/{{ $fileId }}/preview"
                            width="100%" height="650" allow="autoplay">
                    </iframe>
                @else
                    <p>Link Google Drive tidak valid.</p>
                @endif

            {{-- 3. PDF --}}
            @elseif(Str::endsWith($url, '.pdf'))
                <iframe src="{{ $url }}" width="100%" height="700"></iframe>

            {{-- 4. VIDEO FILE --}}
            @elseif(Str::endsWith($url, '.mp4') || Str::endsWith($url, '.webm') || Str::endsWith($url, '.mov'))
                <video width="100%" controls>
                    <source src="{{ $url }}">
                    Browser kamu tidak mendukung video tag.
                </video>

            {{-- 5. DEFAULT --}}
            @else
                <iframe src="{{ $url }}" width="100%" height="700" style="border: none;"></iframe>
            @endif
        </div>
    </div>

    {{-- MARK AS COMPLETED --}}
    <form method="POST" 
        action="{{ route('pelajaran.submodule.toggle', [$submodule->module_id, $submodule->id]) }}">
        @csrf

        <button class="btn-completed">
            @if ($submodule->isCompletedBy(auth()->id()))
                Batalkan Selesai
            @else
                Tandai Selesai
            @endif
        </button>
    </form>

</div>

<style>
/* BOX JUDUL SUBMODULE */
.submodule-title-box {
    display: block;
    background-color: #0a57ff;
    color: #ffffff;
    font-weight: 700;
    font-size: 28px;
    padding: 10px 20px;
    border-radius: 12px;
    margin: 20px 0;
}

/* CARD */
.card {
    border-radius: 20px;
    padding: 25px 30px;
    background-color: #ffffff;
    transition: all 0.3s ease;
}
.card:hover {
    box-shadow: 0 15px 30px rgba(0,0,0,0.1);
}

/* Iframe & Video */
.content-area iframe,
.content-area video {
    border-radius: 12px;
    box-shadow: 0 5px 15px rgba(0,0,0,0.1);
}

/* BUTTONS */

/* Back button */
a.btn-secondary {
    border-radius: 30px;
    padding: 10px 20px;
    font-weight: 600;
    margin-bottom: 50px;
    transition: all 0.2s ease;
}

/* Tombol mark as complete (sama bentuk sebelum & sesudah) */
.btn-completed {
    background-color: #ffffff; /* hitam */
    color: #000000;
    border: 2px solid #0a57ff; /* border biru */
    border-radius: 30px;
    padding: 10px 20px;
    font-weight: 600;
    transition: all 0.2s ease;
    cursor: pointer;
}

.btn-completed:hover {
    background-color: #D0DFFF; /* sedikit terang saat hover */
    border-color: #0a57ff;
}

/* Container */
.container {
    max-width: 1200px;
    margin: 0 auto;
}
</style>
@endsection
