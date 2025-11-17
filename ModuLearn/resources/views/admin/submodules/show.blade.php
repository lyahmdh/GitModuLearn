@extends('admin.layout')

@section('title', $submodule->title)

@section('content')
<div class="container">
    <h2 class="mb-4">{{ $submodule->title }}</h2>

    @if($submodule->type === 'pdf')
        <div class="card shadow-sm p-3">
            <iframe src="{{ asset('storage/' . $submodule->content) }}" 
                    width="100%" height="700px"></iframe>
        </div>

    @elseif($submodule->type === 'video')
        <div class="card shadow-sm p-3">
            <div class="ratio ratio-16x9">
                <iframe src="{{ $submodule->content }}" allowfullscreen></iframe>
            </div>
        </div>
    @endif

</div>
@endsection
