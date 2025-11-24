@extends('layouts.dashboard')
@section('title', 'Modules Admin')
@section('content')

<table class="table">
    <thead>
        <tr>
            <th>Judul</th>
            <th>Kategori</th>
            <th>Likes</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        @foreach($modules as $mod)
        <tr id="module-{{ $mod->id }}">
            <td>{{ $mod->title }}</td>
            <td>{{ $mod->category->name }}</td>
            <td>{{ $mod->likes_count }}</td>
            <td>
                <form method="POST" action="{{ route('admin.modules.destroy', $mod->id) }}" class="delete-form">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>

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
