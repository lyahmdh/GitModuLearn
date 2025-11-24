@extends('layouts.dashboard')
@section('title', 'Dashboard') 
@section('content')
<div class="container py-4">

    <h3 class="fw-bold mb-4">Verifikasi Mentor</h3>

    <table class="table table-bordered table-striped shadow-sm">
        <thead class="table-dark">
            <tr>
                <th>Nama</th>
                <th>Email</th>
                <th>Dokumen</th>
                <th>Aksi</th>
            </tr>
        </thead>

        <tbody>

        @foreach($requests as $req)
        <tr id="request-{{ $req->id }}">
            <td>{{ $req->user->name }}</td>
            <td>{{ $req->user->email }}</td>
            <td>
                <a href="{{ asset('storage/' . $req->document) }}" target="_blank" class="btn btn-info btn-sm">
                    Lihat
                </a>
            </td>
            <td class="d-flex gap-2">
                <button class="btn btn-success btn-sm approve-btn" data-id="{{ $req->id }}">Approve</button>
                <button class="btn btn-danger btn-sm reject-btn" data-id="{{ $req->id }}">Reject</button>
            </td>
        </tr>
        @endforeach

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
                        document.getElementById(`request-${id}`).remove(); // hapus row
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


        </tbody>
    </table>

</div>
@endsection
