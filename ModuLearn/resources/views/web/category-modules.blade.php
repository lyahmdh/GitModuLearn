@extends('layouts.app')

@section('content')
<div class="container py-4">
    <h1 class="mb-4">Modul untuk: {{ $category->name }}</h1>

    @if($modules->isEmpty())
        <p>Tidak ada modul untuk kategori ini.</p>
    @else
        <div class="list-group">
            @foreach($modules as $module)
                <a href="#" class="list-group-item list-group-item-action">
                    <h5 class="mb-1">{{ $module->title }}</h5>
                    <small>{{ $module->description }}</small>
                </a>
            @endforeach
        </div>
    @endif
</div>
@endsection
