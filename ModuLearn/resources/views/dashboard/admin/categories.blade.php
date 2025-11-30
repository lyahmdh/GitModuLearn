@extends('layouts.dashboard')
@section('title', 'Dashboard') 
@section('content')
<div class="container py-4">

    {{-- JUDUL --}}
    <h1 class="mb-4 text-primary"
        style="font-size: 2.5rem; font-weight: 800; border-bottom: 4px solid #000000; padding-bottom: 8px;">
        Kategori Modul
    </h1>

    {{-- CARD TAMBAH KATEGORI --}}
    <div class="card shadow-sm p-4 mb-4" style="background: #fff; border-radius: 18px;">
        <form method="POST" action="{{ route('api.categories.store') }}" id="add-category-form">
            @csrf

            <div class="d-flex w-100">

                {{-- Field Nama  --}}
                <input type="text" name="name" class="form-control"
                       placeholder="Tambah kategori baru..." required
                       style="min-width: 300px;">

                {{-- Tombol Tambah --}}
                <button class="btn ms-auto text-white"
                        style="background:#0d6efd; border-radius:12px; padding: 8px 20px;">
                    Tambah
                </button>
            </div>
        </form>
    </div>

    {{-- WRAPPER TABEL --}}
    <div class="card shadow-sm p-4" style="background:#fff; border-radius:18px;">

        <table class="table align-middle" style="width:100%;">
            <thead class="table-dark">
                <tr>
                    {{-- Kolom nama --}}
                    <th style="width:70%; text-align:left;">Nama</th>

                    {{-- Kolom aksi --}}
                    <th style="width:30%; text-align:left; padding-left:178px;">Aksi</th>
                </tr>
            </thead>

            <tbody>
                @foreach($categories as $cat)
                <tr id="category-{{ $cat->id }}">

                    {{-- Nama kategori --}}
                    <td style="font-size: 1rem; font-weight: 500; text-align:left;">
                        {{ $cat->name }}
                    </td>

                    {{-- Tombol Hapus --}}
                    <td style="text-align:right; padding-right:25px;">
                        <form method="POST" action="{{ route('api.categories.delete', $cat->id) }}" class="delete-form d-inline-block">
                            @csrf
                            @method('DELETE')

                            <button class="text-white"
                                style="
                                    background:#dc3545;
                                    border: none;
                                    padding:6px 14px;
                                    border-radius:12px;
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
// AJAX HAPUS KATEGORI
document.querySelectorAll('.delete-form').forEach(form => {
    form.addEventListener('submit', async function(e){
        e.preventDefault();
        if (!confirm('Yakin ingin menghapus kategori ini?')) return;

        const res = await fetch(form.action, {
            method: 'DELETE',
            headers: {
                'X-CSRF-TOKEN': form.querySelector('input[name="_token"]').value,
                'Accept': 'application/json'
            }
        });

        const data = await res.json();

        if(res.ok){
            form.closest('tr').remove();
            alert(data.message || "Kategori berhasil dihapus!");
        } else {
            alert(data.message || "Gagal menghapus kategori");
        }
    });
});

// AJAX TAMBAH KATEGORI
document.getElementById('add-category-form').addEventListener('submit', async function(e){
    e.preventDefault();

    let formData = new FormData(this);

    const res = await fetch(this.action, {
        method: 'POST',
        body: formData,
        headers: { 'Accept': 'application/json' }
    });

    const result = await res.json();

    if(res.ok){
        const tbody = document.querySelector('table tbody');

        tbody.innerHTML += `
            <tr id="category-${result.data.id}">
                <td style="text-align:left; font-weight:500;">${result.data.name}</td>
                <td style="text-align:right; padding-right:25px;">
                    <form method="POST" action="/api/categories/${result.data.id}" class="delete-form d-inline-block">
                        @csrf
                        @method('DELETE')
                        <button class="text-white"
                                style="background:#dc3545; border:none; padding:6px 14px; border-radius:12px;">
                            Hapus
                        </button>
                    </form>
                </td>
            </tr>
        `;

        this.reset();
        alert(result.message || 'Kategori berhasil ditambahkan!');
    } else {
        alert(result.message || 'Gagal menambahkan kategori');
    }
});
</script>

@endsection
