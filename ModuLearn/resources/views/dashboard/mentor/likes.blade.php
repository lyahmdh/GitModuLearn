@extends('layouts.dashboard')
@section('title', 'Liked Modules')
@section('content')

<div class="container py-4">

    <!-- CARD UTAMA PEMBUNGKUS SECTION -->
    <div class="card shadow-sm border-0 rounded-3 p-4">
        <div class="card-body">

            <h3 class="fw-bold mb-4 text-primary">Modul yang Kamu Like</h3>

            @if($likedModules->isEmpty())
                <div class="text-center text-muted py-5">
                    <h5>Kamu belum menyukai modul apapun.</h5>
                </div>
            @else

            <div class="row g-4">
                @foreach($likedModules as $mod)
                    <div class="col-md-4">

                        <!-- CARD MODUL -->
                        <div class="card shadow-sm border rounded h-100">
                            <div class="card-body d-flex flex-column">

                                <h5 class="fw-bold">{{ $mod->title }}</h5>

                                <p class="text-muted mb-1">
                                    <i class="bi bi-folder"></i> {{ $mod->category->name }}
                                </p>

                                <p class="mb-3">
                                    <i class="bi bi-heart-fill text-danger"></i>
                                    {{ $mod->likes_count }} Likes
                                </p>

                                <div class="mt-auto">
                                    <a 
                                        href="{{ route('modules.show', $mod->id) }}" 
                                        class="btn btn-primary w-100">
                                        Lihat Modul
                                    </a>
                                </div>

                            </div>
                        </div>
                        <!-- END CARD MODUL -->

                    </div>
                @endforeach
            </div>

            @endif

        </div>
    </div>
    <!-- END CARD UTAMA -->

</div>

@endsection
