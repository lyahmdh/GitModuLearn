@extends('admin.layout')

@section('title', 'Kelola Submodul')

@section('content')
<div class="container">
    <h2 class="mb-4">Submodul: {{ $module->title }}</h2>

    <a href="{{ route('admin.submodules.create', $module->id) }}" 
       class="btn btn-success mb-3">Tambah Submodul</a>

    <div class="card shadow-sm">
        <table class="table table-striped mb-0">
            <thead class="table-dark">
                <tr>
                    <th>Judul</th>
                    <th>Tipe</th>
                    <th>Preview</th>
                    <th>Aksi</th>
                </tr>
            </thead>

            <tbody>
                @forelse($submodules as $sub)
                <tr>
                    <td>{{ $sub->title }}</td>

                    <td>
                        @if($sub->type == 'pdf')
                            <span class="badge bg-primary">PDF</span>
                        @else
                            <span class="badge bg-danger">Video</span>
                        @endif
                    </td>

                    <td>
                        <a href="{{ route('admin.submodules.show', [$module->id, $sub->id]) }}" 
                           class="btn btn-outline-secondary btn-sm">Lihat</a>
                    </td>

                    <td>
                        <a href="{{ route('admin.submodules.edit', [$module->id, $sub->id]) }}" 
                           class="btn btn-sm btn-primary">Edit</a>

                        <form action="{{ route('admin.submodules.delete', [$module->id, $sub->id]) }}" 
                              method="POST" class="d-inline">
                            @csrf @method('DELETE')
                            <button class="btn btn-sm btn-danger"
                                    onclick="return confirm('Hapus submodul ini?')">Hapus</button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr><td colspan="4" class="text-center">Belum ada submodul.</td></tr>
                @endforelse
            </tbody>

        </table>
    </div>
</div>
@endsection
