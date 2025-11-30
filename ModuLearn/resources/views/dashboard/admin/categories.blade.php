@extends('layouts.dashboard')
@section('title', 'Dashboard') 
@section('content')
<div class="container py-4">

    <h3 class="fw-bold mb-4">Kategori Modul</h3>

    {{-- Tambah kategori --}}
    <div class="card shadow-sm p-3 mb-4">
        <form method="POST" action="{{ route('api.categories.store') }}" id="add-category-form">
            @csrf
            <div class="d-flex">
                <input type="text" name="name" class="form-control" placeholder="Tambah kategori baru..." required>
                <button class="btn btn-primary ms-2">Tambah</button>
            </div>
        </form>
    </div>

    {{-- Tabel kategori --}}
    <table class="table table-bordered table-striped shadow-sm" id="categories-table">
        <thead class="table-dark">
            <tr>
                <th>Nama</th>
                <th>Aksi</th>
            </tr>
        </thead>

        <tbody>
            @foreach($categories as $cat)
            <tr id="category-{{ $cat->id }}">
                <td>{{ $cat->name }}</td>
                <td>
                    <form method="POST" action="{{ route('api.categories.delete', $cat->id) }}" class="delete-form">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-danger btn-sm">Hapus</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>

    </table>

</div>

<script>
// Hapus kategori dengan AJAX
document.querySelectorAll('.delete-form').forEach(form => {
    form.addEventListener('submit', async function(e){
        e.preventDefault();

        if (!confirm('Yakin ingin menghapus kategori ini?')) return;

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
                const row = form.closest('tr');
                row.remove();
                alert(result.message || 'Kategori berhasil dihapus!');
            } else {
                alert(result.message || 'Gagal menghapus kategori');
            }
        } catch(err){
            alert('Terjadi error. Coba lagi.');
            console.error(err);
        }
    });
});

// Tambah kategori dengan AJAX (optional)
document.getElementById('add-category-form').addEventListener('submit', async function(e){
    e.preventDefault();

    const form = e.target;
    const formData = new FormData(form);

    try {
        const res = await fetch(form.action, {
            method: 'POST',
            body: formData,
            headers: {
                'Accept': 'application/json'
            }
        });

        const result = await res.json();

        if(res.ok){
            // Tambahkan row baru ke tabel
            const tbody = document.querySelector('#categories-table tbody');
            const tr = document.createElement('tr');
            tr.id = `category-${result.data.id}`;
            tr.innerHTML = `
                <td>${result.data.name}</td>
                <td>
                    <form method="POST" action="/api/categories/${result.data.id}" class="delete-form">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-danger btn-sm">Hapus</button>
                    </form>
                </td>
            `;
            tbody.appendChild(tr);
            form.reset();
            alert(result.message || 'Kategori berhasil ditambahkan!');
        } else {
            alert(result.message || 'Gagal menambahkan kategori');
        }
    } catch(err){
        alert('Terjadi error. Coba lagi.');
        console.error(err);
    }
});
</script>

@endsection
