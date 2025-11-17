@extends('admin.layout')

@section('title', 'Tambah Submodul')

@section('content')
<div class="container col-md-6">

    <h2 class="mb-4">Tambah Submodul untuk Modul: {{ $module->title }}</h2>

    <div class="card shadow-sm p-4">

        <form action="{{ route('admin.submodules.store', $module->id) }}" 
              method="POST" enctype="multipart/form-data">
            @csrf

            <div class="mb-3">
                <label class="form-label">Judul Submodul</label>
                <input type="text" name="title" class="form-control" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Tipe Konten</label>
                <select name="type" class="form-select" id="typeSelect" required>
                    <option value="pdf">PDF</option>
                    <option value="video">Video</option>
                </select>
            </div>

            <div id="pdfInput" class="mb-3">
                <label class="form-label">Upload PDF</label>
                <input type="file" name="pdf_file" accept="application/pdf" class="form-control">
            </div>

            <div id="videoInput" class="mb-3 d-none">
                <label class="form-label">URL Video (YouTube/MP4)</label>
                <input type="text" name="video_url" class="form-control">
            </div>

            <button class="btn btn-success">Simpan</button>
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
