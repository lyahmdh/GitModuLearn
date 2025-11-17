@extends('layouts.app')

@section('title', 'Modul Saya')

@section('content')
<div class="container py-4">

    <div class="d-flex justify-content-between mb-3">
        <h3 class="fw-bold">Modul Saya</h3>
        <a href="{{ route('mentor.module.create') }}" class="btn btn-primary">+ Tambah Modul</a>
    </div>

    <div class="card shadow-sm">
        <div class="card-body table-responsive">

            <table class="table table-bordered align-middle">
                <thead class="table-light">
                    <tr>
                        <th>Judul</th>
                        <th>Kategori</th>
                        <th>Likes</th>
                        <th width="200">Aksi</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach ($modules as $module)
                    <tr>
                        <td>{{ $module->title }}</td>
                        <td>{{ $module->category->name }}</td>
                        <td>{{ $module->likes_count }}</td>
                        <td>
                            <a href="{{ route('mentor.module.detail', $module->id) }}" class="btn btn-sm btn-primary">
                                Detail
                            </a>

                            <a href="{{ route('mentor.module.edit', $module->id) }}" class="btn btn-sm btn-warning">
                                Edit
                            </a>

                            <form action="{{ route('mentor.module.delete', $module->id) }}" method="POST"
                                  class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-sm btn-danger"
                                        onclick="return confirm('Hapus modul ini?')">
                                    Hapus
                                </button>
                            </form>

                        </td>
                    </tr>
                    @endforeach
                </tbody>

            </table>

        </div>
    </div>

</div>
@endsection
