<div class="card shadow-sm h-100">
    <img src="{{ $image ?? 'https://placehold.co/600x300' }}" class="card-img-top" alt="Module Image">

    <div class="card-body">
        <h5 class="card-title">{{ $title }}</h5>
        <p class="card-text text-muted">{{ $description }}</p>

        <div class="d-flex justify-content-between">
            <span class="text-primary">
                <i class="bi bi-person"></i> {{ $mentor }}
            </span>

            <span class="text-danger">
                <i class="bi bi-heart"></i> {{ $likes }}
            </span>
        </div>

        <a href="{{ $link }}" class="btn btn-primary w-100 mt-3">Lihat Modul</a>
    </div>
</div>
