<div class="list-group mb-3">

    <a href="{{ route('submodules.show', $submodule->id) }}"
       class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">

        <div>
            <h6 class="fw-bold mb-1">{{ $submodule->title }}</h6>
            <small class="text-secondary">
                {{ $submodule->type == 'pdf' ? '📄 PDF File' : '🎬 Video' }}
            </small>
        </div>

        @if($submodule->isDone)
            <span class="badge bg-success">Done</span>
        @endif

    </a>

</div>
