@extends('layouts.app')

@section('title', 'Modul Saya')

@section('content')
<div class="container py-5">

    <h3 class="fw-bold mb-4">Modul Tersedia</h3>

    <div class="row">

        @foreach ($modules as $module)
        <div class="col-md-4 mb-4">
            <div class="card shadow-sm h-100">

                <img src="{{ asset('images/module-cover.png') }}" class="card-img-top">

                <div class="card-body">
                    <h5 class="card-title">{{ $module->title }}</h5>

                    <p class="text-muted small">
                        Mentor: <strong>{{ $module->mentor->name }}</strong><br>
                        ⭐ {{ $module->rating ?? 0 }} / 5
                    </p>

                    <a href="{{ route('mentee.module-detail', $module->id) }}" class="btn btn-primary">
                        Mulai Belajar
                    </a>
                </div>

            </div>
        </div>
        @endforeach

    </div>

</div>
@endsection
