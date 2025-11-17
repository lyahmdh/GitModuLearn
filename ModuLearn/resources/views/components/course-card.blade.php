<div class="col-md-4 mb-3">
    <div class="card shadow-sm h-100">
        <div class="card-body">
            <h5 class="card-title">{{ $course->name }}</h5>

            <a href="{{ route('courses.show', $course->id) }}"
               class="btn btn-outline-primary w-100 mt-2">
                Lihat Modul
            </a>
        </div>
    </div>
</div>
