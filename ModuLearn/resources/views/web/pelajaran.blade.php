@extends('layouts.app')

@section('content')

<div class="container">
    <h3 class="fw-bold mb-4">Pilih Pelajaran</h3>

    <div class="row">
        @foreach ($categories as $category)
            @include('components.category-card', ['category' => $category])
        @endforeach
    </div>
</div>

@endsection
