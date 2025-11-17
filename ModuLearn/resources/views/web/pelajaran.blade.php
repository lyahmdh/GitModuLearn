@extends('layouts.app')

@section('content')

<div class="container">
    <h3 class="fw-bold mb-4">Pilih Pelajaran</h3>

    <div class="row">
        @foreach ($categories as $category)
            @include('components.course-card', ['category' => $course])
        @endforeach
    </div>
</div>

@endsection
