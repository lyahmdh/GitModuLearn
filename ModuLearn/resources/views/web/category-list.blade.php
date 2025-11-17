@extends('layouts.app')

@section('content')
<div class="container py-4">
    <h1 class="mb-4">Semua Kategori</h1>

    <div class="row">
        @foreach($categories as $category)
            <div class="col-md-4 mb-3">
                <div class="card shadow-sm">
                    <div class="card-body">
                        <h4>{{ $category->name }}</h4>
                        <a href="{{ route('pelajaran.show', $category->id) }}" class="btn btn-primary mt-2">
                            Lihat Modul
                        </a>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>
@endsection
