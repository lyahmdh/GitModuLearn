@extends('layouts.app')

@section('title', 'Detail Modul')

@section('content')
<div class="container py-4">

    <h2 class="fw-bold">{{ $module->title }}</h2>
    <p class="text-muted">{{ $module->description }}</p>

    <div class="mb-4">
        <a href="{{ route('mentor.submodule.create', $module->id) }}" class="btn btn-primary">
            + Tambah Submodul
        </a>
    </div>

    <h4 class="fw-bold mt-4">Submodul</h4>

    <div class="list-group mt-3">

        @foreach ($module->submodules as $sub)
        <div class="list-group-item d-flex justify-content-between align-items-center">

            <div>
                <strong>{{ $sub->title }}</strong><br>
                <span class="text-muted small">{{ strtoupper($sub->type) }}</span>
            </div>

            <div>
                <a href="{{ route('mentor.submodule.edit', $sub->id) }}"
                   class="btn btn-sm btn-warning">Edit</a>

                <form action="{{ route('mentor.submodule.delete', $sub->id) }}"
                      method="POST" class="d-inline">
                    @csrf
                    @method('DELETE')
                    <button class="btn btn-sm btn-danger"
                            onclick="return confirm('Hapus submodul?')">
                        Hapus
                    </button>
                </form>
            </div>

        </div>
        @endforeach

    </div>

</div>
@endsection
