<div class="col-md-4 col-lg-3 mb-4">
    <a href="{{ route('categories.show', $category->id) }}" class="text-decoration-none">
        <div class="card shadow-sm border-0">
            <img src="{{ $category->thumbnail_url ?? '/images/default-category.jpg' }}"
                 class="card-img-top" alt="category">

            <div class="card-body text-center">
                <h5 class="card-title fw-bold text-dark">{{ $category->name }}</h5>
            </div>
        </div>
    </a>
</div>
