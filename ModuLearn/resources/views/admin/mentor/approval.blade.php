@extends('admin.layout')

@section('title', 'Approval Mentor')

@section('content')
<div class="container">
    <h2 class="mb-4">Daftar Mentor Pending</h2>

    <div class="card shadow-sm">
        <table class="table table-hover">
            <thead class="table-dark">
                <tr>
                    <th>Nama</th>
                    <th>Email</th>
                    <th>Bukti Dokumen</th>
                    <th>Aksi</th>
                </tr>
            </thead>

            <tbody>
                @forelse($pending as $mentor)
                <tr>
                    <td>{{ $mentor->name }}</td>
                    <td>{{ $mentor->email }}</td>
                    <td>
                        <a href="{{ asset('storage/'.$mentor->document_path) }}" target="_blank" class="btn btn-outline-secondary btn-sm">
                            Lihat Dokumen
                        </a>
                    </td>

                    <td>
                        <form action="{{ route('admin.mentor.approve', $mentor->id) }}" method="POST">
                            @csrf
                            <button class="btn btn-success btn-sm">Setujui</button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr><td colspan="4" class="text-center">Tidak ada mentor pending</td></tr>
                @endforelse
            </tbody>

        </table>
    </div>
</div>
@endsection
