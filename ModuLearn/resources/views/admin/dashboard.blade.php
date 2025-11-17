@extends('admin.layout')

@section('title', 'Admin Dashboard')

@section('content')
<div class="container">
    <h2 class="mb-4">Admin Dashboard</h2>

    <div class="row">
        <div class="col-md-4">
            <div class="card shadow-sm">
                <div class="card-body">
                    <h4>Total User</h4>
                    <p class="display-6">{{ $totalUsers ?? 0 }}</p>
                    <a href="{{ route('admin.users') }}" class="btn btn-primary btn-sm">Kelola User</a>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card shadow-sm">
                <div class="card-body">
                    <h4>Total Modul</h4>
                    <p class="display-6">{{ $totalModules ?? 0 }}</p>
                    <a href="{{ route('admin.modules') }}" class="btn btn-primary btn-sm">Kelola Modul</a>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card shadow-sm">
                <div class="card-body">
                    <h4>Approval Mentor Pending</h4>
                    <p class="display-6">{{ $pendingMentors ?? 0 }}</p>
                    <a href="{{ route('admin.mentor.approval') }}" class="btn btn-warning btn-sm">Lihat Approval</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
