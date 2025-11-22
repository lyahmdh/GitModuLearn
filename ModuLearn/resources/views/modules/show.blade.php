@extends('layouts.app')

@section('content')
<div class="container py-4">

    {{-- HEADER --}}
    <div class="text-center mb-4">
        <h2 class="fw-bold">{{ $module->title }}</h2>
        <p class="text-muted">{{ $module->description }}</p>
    </div>

    {{-- LIKE BUTTON --}}
    <div class="text-center mb-5">
        <form method="POST" action="{{ route('modules.like', $module->id) }}">
            @csrf
            <button class="btn btn-outline-danger px-4">
                ❤️ Like ({{ $module->likes_count }})
            </button>
        </form>
    </div>

    {{-- LIST SUBMODUL --}}
    <h4 class="fw-bold mb-3">Daftar Submodul</h4>

    <div class="list-group">
        @foreach($module->submodules as $sub)
            <a href="{{ route('submodules.show', $sub->id) }}" 
               class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">
                {{ $sub->title }}

                @if($sub->isCompletedByUser(Auth::id()))
                    <span class="badge bg-success rounded-pill">Selesai</span>
                @endif
            </a>
        @endforeach
    </div>

</div>
@endsection
