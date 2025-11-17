<div class="col-md-4 mb-4">
    <a href="{{ route('modules.show', $module->id) }}" class="text-decoration-none">
        <div class="card shadow-sm border-0 h-100">

            <img src="{{ $module->thumbnail_url ?? '/images/default-module.jpg' }}"
                 class="card-img-top" alt="module">

            <div class="card-body">
                <h5 class="fw-bold text-dark">{{ $module->title }}</h5>
                <p class="text-secondary small mb-2">
                    Mentor: {{ $module->mentor->name }}
                </p>

                <span class="badge bg-primary">
                    👍 {{ $module->likes_count ?? 0 }}
                </span>
            </div>

        </div>
    </a>
</div>
