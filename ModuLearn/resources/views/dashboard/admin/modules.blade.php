@extends('layouts.dashboard')
@section('title', 'Modules Admin')
@section('content')

<div class="container py-4">

    {{-- JUDUL --}}
    <h1 class="mb-4 text-primary" 
        style="font-size: 2.5rem; font-weight: 800; border-bottom: 4px solid #000000; padding-bottom: 8px;">
        Modules
    </h1>

    {{-- WRAPPER TABEL --}}
    <div class="p-4 shadow-sm" 
         style="background: #FFFFFF; border-radius: 18px;">

        <table class="table table-bordered align-middle" style="width: 100%; border-radius: 18px; overflow:hidden;">
            <thead class="table-light">
                <tr>
                    <th class="text-center">Judul</th>
                    <th class="text-center">Kategori</th>
                    <th class="text-center">Likes</th>
                    <th class="text-center">Aksi</th>
                </tr>
            </thead>

            <tbody>
                @foreach($modules as $mod)
                <tr id="module-{{ $mod->id }}">
                    <td>{{ $mod->title }}</td>
                    <td>{{ $mod->category->name }}</td>
                    <td class="text-center">{{ $mod->likes_count }}</td>
                    <td class="text-center">
                        <form method="POST" action="{{ route('admin.modules.destroy', $mod->id) }}" class="delete-form d-inline">
                            @csrf
                            @method('DELETE')
                            
                            {{-- TOMBOL HAPUS CUSTOM --}}
                            <button type="submit"
                                style="
                                    background:#dc3545;
                                    color:white;
                                    border:none;
                                    padding:6px 14px;
                                    border-radius:18px;
                                ">
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

<script>
document.querySelectorAll('.delete-form').forEach(form => {
    form.addEventListener('submit', async function(e){
        e.preventDefault();

        if (!confirm('Yakin ingin menghapus modul ini?')) return;

        const url = form.action;
        const token = form.querySelector('input[name="_token"]').value;

        try {
            const res = await fetch(url, {
                method: 'DELETE',
                headers: {
                    'X-CSRF-TOKEN': token,
                    'Accept': 'application/json'
                }
            });

            const result = await res.json();

            if(res.ok){
                form.closest('tr').remove();
                alert(result.message || 'Modul berhasil dihapus!');
            } else {
                alert(result.message || 'Gagal menghapus modul');
            }
        } catch (err) {
            alert('Terjadi error. Coba lagi.');
            console.error(err);
        }
    });
});
</script>

@endsection
