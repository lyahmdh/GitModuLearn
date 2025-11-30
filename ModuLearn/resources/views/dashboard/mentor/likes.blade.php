@extends('layouts.dashboard')
@section('title', 'Liked Modules')
@section('content')
<div class="container py-4">
    <h3 class="fw-bold mb-4">Modul yang Kamu Like</h3>

    <div class="row">
        @foreach($likedModules as $mod)
            <div class="col-md-4 mb-3">
                <div class="card p-3 shadow-sm">
                    <h5>{{ $mod->title }}</h5>
                    <p>Kategori: {{ $mod->category->name }}</p>
                    <p>Likes: {{ $mod->likes_count }}</p>
                </div>
            </div>
        @endforeach
    </div>
</div>
@endsection
