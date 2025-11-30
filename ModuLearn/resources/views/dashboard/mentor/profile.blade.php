@extends('layouts.dashboard')
@section('title', 'Dashboard')
@section('content')

<style>
    .modern-input {
        border-radius: 12px;
        padding: 12px 14px;
        border: 1.5px solid #d6d6d6;
        transition: 0.25s ease-in-out;
        background: #fafafa;
    }

    .modern-input:focus {
        border-color: #0d6efd;
        box-shadow: 0 0 0 3px rgba(13,110,253,0.18);
        background: #fff;
    }

    .section-card {
        border-radius: 18px;
        transition: 0.25s ease;
        border: none;
        background: #ffffff;
    }

    .section-card:hover {
        transform: translateY(-3px);
        box-shadow: 0px 12px 25px rgba(0, 0, 0, 0.12);
    }

    .danger-card {
        border-left: 6px solid #dc3545;
        border-radius: 16px;
        background: #fff5f5;
    }

    .page-title {
        border-left: 6px solid #0d6efd;
        padding-left: 14px;
        font-weight: 800;
        font-size: 2.2rem;
    }

    .profile-photo {
        transition: 0.3s ease;
        border: 4px solid #f1f1f1;
    }

    .profile-photo:hover {
        transform: scale(1.07);
        border-color: #d1e4ff;
    }

    .action-btn {
        border-radius: 12px;
        padding: 10px 18px;
        font-weight: 600;
        transition: .25s ease;
    }

    .action-btn:hover {
        transform: translateY(-2px);
        opacity: .9;
    }

    .delete-btn {
        border-radius: 12px;
        font-weight: 600;
        padding: 10px 18px;
        background: #dc3545;
        border: none;
        color: white;
        transition: .25s ease;
    }

    .delete-btn:hover {
        background: #bb2d3b;
        transform: translateY(-2px);
    }

    .file-btn {
        background: #e7f1ff;
        border: 1px solid #0d6efd;
        color: #0d6efd;
        font-weight: 600;
        padding: 6px 14px;
        border-radius: 10px;
        transition: .2s ease;
    }

    .file-btn:hover {
        background: #d7e9ff;
    }
</style>

<div class="container py-4">

    <!-- TITLE -->
    <h1 class="page-title mb-4">Edit Profile</h1>

    <!-- CARD PROFILE -->
    <div class="card shadow section-card p-4 mb-4">

        <form method="POST" action="{{ route('profile.update') }}" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <!-- FOTO PROFIL -->
            <h5 class="fw-bold mb-3 text-primary">Foto Profil</h5>

            <div class="d-flex align-items-center gap-4 mb-4">
                <img src="{{ $user->profile_photo_path 
                    ? asset($user->profile_photo_path) 
                    : asset('assets/default-profile.png') }}"
                    class="rounded-circle profile-photo shadow-sm"
                    width="110" height="110" style="object-fit: cover;">

                <div>
                    <input type="file" id="profile_photo" name="profile_photo" class="d-none">

                    <div class="text-muted small mt-1 ms-1">Format JPG/PNG, Max 2MB</div>
                </div>
            </div>

            <hr>

            <!-- NAMA -->
            <div class="mb-3">
                <h6 class="fw-semibold mb-1">Nama</h6>
                <input type="text" name="name" value="{{ auth()->user()->name }}"
                       class="form-control modern-input" required>
            </div>

            <!-- EMAIL -->
            <div class="mb-3">
                <h6 class="fw-semibold mb-1">Email</h6>
                <input type="email" name="email" value="{{ auth()->user()->email }}"
                       class="form-control modern-input" required>
            </div>

            <!-- INSTITUSI -->
            <div class="mb-3">
                <h6 class="fw-semibold mb-1">Institusi</h6>
                <select name="institution" class="form-control modern-input" required>
                    <option value="{{ auth()->user()->institution }}" selected>
                        {{ auth()->user()->institution }}
                    </option>

                    @php
                        $institutions = [
                            'Universitas Indonesia',
                            'Institut Teknologi Bandung',
                            'Universitas Gadjah Mada',
                            'Universitas Brawijaya',
                            'Lainnya'
                        ];
                    @endphp

                    @foreach($institutions as $item)
                        @if($item !== auth()->user()->institution)
                            <option value="{{ $item }}">{{ $item }}</option>
                        @endif
                    @endforeach
                </select>
            </div>

            <!-- INTEREST FIELD -->
            <div class="mb-3">
                <h6 class="fw-semibold mb-1">Interest Field</h6>
                <select name="interest_field" class="form-control modern-input" required>
                    <option value="{{ auth()->user()->interest_field }}" selected>
                        {{ auth()->user()->interest_field }}
                    </option>

                    @php
                        $interests = [
                            'Teknologi',
                            'Bisnis',
                            'Ekonomi',
                            'Sastra',
                            'Ilmu Budaya',
                            'Ilmu Politik'
                        ];
                    @endphp

                    @foreach($interests as $item)
                        @if($item !== auth()->user()->interest_field)
                            <option value="{{ $item }}">{{ $item }}</option>
                        @endif
                    @endforeach
                </select>
            </div>

            <!-- BUTTON -->
            <div class="text-end mt-4">
                <button class="btn btn-primary action-btn">
                    Simpan Perubahan
                </button>
            </div>

        </form>
    </div>

    <!-- DELETE ACCOUNT -->
    <div class="card shadow-sm p-4 danger-card">

        <h4 class="fw-bold text-danger mb-2">Hapus Akun</h4>
        <p class="text-muted mb-3">
            Menghapus akun bersifat permanen dan seluruh data tidak dapat dipulihkan.
        </p>

        <form method="POST" action="{{ route('profile.destroy') }}">
            @csrf
            @method('DELETE')

            <button class="delete-btn">
                Hapus Akun
            </button>
        </form>

    </div>

</div>
@endsection
