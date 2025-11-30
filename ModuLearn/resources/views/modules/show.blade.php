@extends('layouts.app')

@section('content')
<div class="container py-4">

    {{-- HEADER --}}
    <div class="text-center mb-4">
        <h2 class="fw-bold">{{ $module->title }}</h2>
        <p class="text-muted">{{ $module->description }}</p>
        <p class="text-muted">Oleh: {{ $module->user?->name ?? '-' }}</p>

    </div>


    {{-- LIKE BUTTON --}}
    <div class="text-center mb-5">
    <button 
        id="like-button"
        class="btn btn-outline-danger px-4"
        data-module="{{ $module->id }}"
    >
        @if($isLiked)
            💔 Unlike (<span id="likes-count">{{ $module->likes_count }}</span>)
        @else
            ❤️ Like (<span id="likes-count">{{ $module->likes_count }}</span>)
        @endif
    </button>


    </div>

    {{-- LIST SUBMODUL --}}
    <h4 class="fw-bold mb-3">Daftar Submodul</h4>

    <div class="list-group">
        @foreach($module->submodules as $sub)
            <a href="{{ route('pelajaran.submodule.show', ['moduleId' => $module->id, 'submoduleId' => $sub->id]) }}" 
               class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">
                {{ $sub->title }}

                @if($sub->isDoneBy(auth()->id()))
                    <span class="badge bg-success">Selesai</span>
                @endif

            </a>
        @endforeach
    </div>

</div>
@endsection

@push('scripts')
<script>
document.getElementById('like-button').addEventListener('click', function () {

    let moduleId = this.dataset.module;

    fetch(`/modules/${moduleId}/like`, {
        method: 'POST',
        headers: {
            "Content-Type": "application/json",
            "X-CSRF-TOKEN": "{{ csrf_token() }}"
        }
    })

    .then(res => res.json())
    .then(data => {

        document.getElementById('likes-count').innerText = data.likes_count;

        if (data.liked) {
            this.innerHTML = `💔 Unlike (<span id="likes-count">${data.likes_count}</span>)`;
        } else {
            this.innerHTML = `❤️ Like (<span id="likes-count">${data.likes_count}</span>)`;
        }
    })
    .catch(err => console.error(err));
});
</script>
@endpush

