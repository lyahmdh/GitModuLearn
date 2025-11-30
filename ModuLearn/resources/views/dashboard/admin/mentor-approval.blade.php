@extends('layouts.dashboard')
@section('title', 'Dashboard') 
@section('content')
<div class="container py-4">

    {{-- JUDUL --}}
    <h1 class="mb-4 text-primary"
        style="font-size: 2.5rem; font-weight: 800; border-bottom: 4px solid #000; padding-bottom: 8px;">
        Verifikasi Mentor
    </h1>

    {{-- WRAPPER TABEL --}}
    <div class="card shadow-sm p-4" style="background:#fff; border-radius:18px;">

        <table class="table align-middle" style="width:100%;">
            <thead class="table-dark">
                <tr>
                    <th class="text-start">Nama</th>
                    <th class="text-start">Email</th>
                    <th class="text-start">Dokumen</th>
                    <th class="text-start">Aksi</th>
                </tr>
            </thead>

            <tbody>
                @foreach($requests as $req)
                <tr id="request-{{ $req->id }}">

                    <td style="font-size:1rem; font-weight:500;">
                        {{ $req->user->name }}
                    </td>

                    <td style="font-size:1rem; font-weight:500;">
                        {{ $req->user->email }}
                    </td>

                    <td>
                        <a href="{{ asset('storage/' . $req->document) }}" 
                           target="_blank" 
                           class="btn text-white btn-sm"
                           style="background:#0d6efd; border-radius:12px; padding:6px 16px;">
                            Lihat
                        </a>
                    </td>

                    <td class="d-flex gap-2">
                        <button 
                            class="btn text-white btn-sm approve-btn" 
                            data-id="{{ $req->id }}"
                            style="background:#198754; border-radius:12px; padding:6px 16px;">
                            Approve
                        </button>

                        <button 
                            class="btn text-white btn-sm reject-btn" 
                            data-id="{{ $req->id }}"
                            style="background:#dc3545; border-radius:12px; padding:6px 16px;">
                            Reject
                        </button>
                    </td>

                </tr>
                @endforeach
            </tbody>
        </table>

    </div>




{{-- APPROVAL --}}
<script>
document.querySelectorAll('.approve-btn').forEach(button => {
    button.addEventListener('click', async () => {

        if(!confirm('Yakin ingin approve request ini?')) return;

        const id = button.getAttribute('data-id');

        try {
            const res = await fetch(`/admin/mentor-verification/${id}/approve`, {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    'Accept': 'application/json',
                    'Content-Type': 'application/json'
                },
            });

            const result = await res.json();

            if(res.ok){
                alert(result.message || 'Request berhasil diapprove!');
                document.getElementById(`request-${id}`).remove();
            } else {
                alert(result.message || 'Gagal approve request.');
            }
        } catch (err) {
            console.error(err);
            alert('Terjadi error. Coba lagi.');
        }
    });
});
</script>

@endsection
