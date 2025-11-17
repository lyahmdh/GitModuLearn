@extends('layouts.app')

@section('content')

<div class="container">

    <h3 class="fw-bold mb-4">{{ $category->name }}</h3>

    @if($modules->count() == 0)
        <p class="text-secondary">Belum ada modul untuk kategori ini.</p>
    @endif

    <div class="row">
        @foreach ($modules as $module)
            @include('components.module-card', ['module' => $module])
        @endforeach
    </div>

</div>

@endsection
