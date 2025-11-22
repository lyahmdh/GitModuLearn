@extends('layouts.dashboard')
@section('title', 'Dashboard') 
@section('content')
<div class="container py-4">

    <h3 class="fw-bold mb-4">Edit Profil</h3>

    <div class="card shadow-sm p-4">

        <form method="POST" action="{{ route('profile.update') }}">
            @csrf
            @method('PATCH')

            {{-- NAME --}}
            <div class="mb-3">
                <label class="form-label">Nama</label>
                <input type="text" name="name" 
                    class="form-control" 
                    value="{{ auth()->user()->name }}" required>
            </div>

            {{-- EMAIL --}}
            <div class="mb-3">
                <label class="form-label">Email</label>
                <input type="email" name="email" 
                    class="form-control" 
                    value="{{ auth()->user()->email }}" required>
            </div>

            {{-- INSTITUSI --}}
            <div class="mb-3">
                <label class="form-label">Institusi</label>
                <input type="text" name="institution" 
                    class="form-control" 
                    value="{{ auth()->user()->institution }}" required>
            </div>

            {{-- Interest Field --}}
            <div class="mb-3">
                <label class="form-label">Interest Field</label>
                <input type="text" name="institution" 
                    class="form-control" 
                    value="{{ auth()->user()->interest_field }}" required>
            </div>

            {{-- SUBMIT --}}
            <button class="btn btn-primary px-4">Simpan Perubahan</button>

        </form>

        {{-- DELETE ACCOUNT --}}
        <form class="mt-4" method="POST" action="{{ route('profile.destroy') }}">
            @csrf
            @method('DELETE')

            <button class="btn btn-danger">
                Hapus Akun
            </button>
        </form>

    </div>

</div>
@endsection
