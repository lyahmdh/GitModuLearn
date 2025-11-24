@extends('layouts.dashboard')
@section('title', 'Dashboard') 
@section('content')

<style>
    .modern-input {
        border-radius: 12px;
        padding: 10px 14px;
        border: 1.5px solid #d6d6d6;
        transition: 0.25s ease-in-out;
    }
</style>


<div class="container py-4">

    <h1 class="mb-4 text-primary" 
        style="font-size: 2.5rem; font-weight: 800; border-bottom: 4px solid #000000; padding-bottom: 8px;">
        Edit Profile
    </h1>

    {{-- FORM UPDATE --}}
    <form method="POST" action="{{ route('profile.update') }}" enctype="multipart/form-data">
        @csrf
        @method('PATCH')

        {{-- FOTO PROFIL --}}
        <div class="card border border-2 rounded-4 shadow-sm py-4 px-3" style="background: #FFFFFF; border-radius: 12px">
            <h6 class="fw-bold mb-3">Foto Profil</h6>

            <img src="{{ $user->profile_photo_path 
                ? asset($user->profile_photo_path) 
                : asset('assets/default-profile.png') }}"
                class="rounded-circle shadow-sm mb-3"
                width="90" height="90" style="object-fit: cover;">

            <input type="file" name="profile_photo" class="form-control modern-input">
        </div>


        {{-- NAMA --}}
        <div class="card border border-2 rounded-4 shadow-sm py-4 px-3" style="background: #FFFFFF; border-radius: 12px">
            <h6 class="fw-bold mb-2">Nama</h6>
            <input type="text" name="name" class="form-control modern-input"
                   value="{{ auth()->user()->name }}" required>
        </div>

        {{-- EMAIL --}}
        <div class="card border border-2 rounded-4 shadow-sm py-4 px-3" style="background: #FFFFFF; border-radius: 12px">
            <h6 class="fw-bold mb-2">Email</h6>
            <input type="email" name="email" class="form-control modern-input"
                   value="{{ auth()->user()->email }}" required>
        </div>

        {{-- INSTITUSI --}}
        <div class="card border border-2 rounded-4 shadow-sm py-4 px-3" style="background: #FFFFFF; border-radius: 12px">
            <h6 class="fw-bold mb-2">Institusi</h6>

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

        {{-- INTEREST FIELD --}}
        <div class="card border border-2 rounded-4 shadow-sm py-4 px-3" style="background: #FFFFFF; border-radius: 12px">
            <h6 class="fw-bold mb-2">Interest Field</h6>

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

        {{-- SUBMIT BUTTON --}}
        <div class="text-end mt-3">
            <button class="btn btn-primary px-4 py-2 rounded-3 fw-semibold">Simpan Perubahan</button>
        </div>
    </form>


    {{-- DELETE ACCOUNT --}}
    <div class="card shadow-sm p-4 rounded-4 mt-4 border-danger">
        <h6 class="fw-bold text-danger mb-2">Hapus Akun</h6>

        <form method="POST" action="{{ route('profile.destroy') }}">
            @csrf
            @method('DELETE')

            <button class="btn btn-danger px-4 py-2 rounded-3">Hapus Akun</button>
        </form>
    </div>

</div>
@endsection
