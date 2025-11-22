@extends('layouts.dashboard')
@section('title', 'Dashboard') 
@section('content')
<div class="container py-4">

    <h3 class="fw-bold mb-4">Modul yang Kamu Like</h3>

    <div class="row">
        @foreach($likedModules as $mod)
        <div class="col-md-4 mb-4">
            <div class="card shadow-sm h-100">

                <img src="{{ $mod->thumbnail }}" class="card-img-top" style="height:180px;object-fit:cover;">

                <div class="card-body">
                    <h5 class="fw-bold">{{ $mod->title }}</h5>
                    <p class="text-muted">{{ Str::limit($mod->description, 100) }}</p>

                    <a href="{{ route('modules.show', $mod->id) }}" class="btn btn-primary w-100">
                        Buka Modul
                    </a>
                </div>

            </div>
        </div>
        @endforeach
    </div>

</div>
@endsection
