@extends('admin.layout')

@section('title', 'Edit Submodul')

@section('content')
<div class="container col-md-6">

    <h2 class="mb-4">Edit Submodul: {{ $submodule->title }}</h2>

    <div class="card shadow-sm p-4">
        <form action="{{ route('admin.submodules.update', [$module->id, $submodule->id]) }}"
              method="POST" enctype="multipart/form-data">

            @csrf @method('PUT')

            <div class="mb-3">
                <label class="form-label">Judul Submodul</label>
                <input type="text" name="title" class="form-control" value="{{ $submodule->title }}">
            </div>

            <div class="mb-3">
                <label class="form-label">Tipe Konten</label>
                <select name="type" id="typeSelect" class="form-select">
                    <option value="pdf" @selected($submodule->type=='pdf')>PDF</option>
                    <option value="video" @selected($submodule->type=='video')>Video</option>
                </select>
            </div>

            <div id="pdfInput" class="mb-3 {{ $submodule->type=='pdf' ? '' : 'd-none' }}">
                <label class="form-label">Upload PDF Baru (Opsional)</label>
                <input type="file" name="pdf_file" class="form-control" accept="application/pdf">
                <p class="mt-1">PDF sekarang: 
                    <a href="{{ asset('storage/'.$submodule->content) }}" target="_blank">Lihat</a>
                </p>
            </div>

            <div id="videoInput" class="mb-3 {{ $submodule->type=='video' ? '' : 'd-none' }}">
                <label class="form-label">URL Video Baru (Opsional)</label>
                <input type="text" name="video_url" class="form-control" value="{{ $submodule->content }}">
            </div>

            <button class="btn btn-primary">Update</button>

        </form>
    </div>

</div>

<script>
    const typeSelect = document.getElementById('typeSelect');
    const pdfInput = document.getElementById('pdfInput');
    const videoInput = document.getElementById('videoInput');

    typeSelect.addEventListener('change', () => {
        if (typeSelect.value === 'pdf') {
            pdfInput.classList.remove('d-none');
            videoInput.classList.add('d-none');
        } else {
            pdfInput.classList.add('d-none');
            videoInput.classList.remove('d-none');
        }
    });
</script>

@endsection
