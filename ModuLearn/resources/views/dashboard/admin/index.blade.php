@extends('layouts.dashboard')
@section('title', 'Dashboard') 
@section('content')
<div class="container py-4">

    <h3 class="fw-bold mb-4">Dashboard Admin</h3>

    <div class="row">

        <div class="col-md-4">
            <div class="card shadow-sm p-3 mb-3">
                <h5 class="fw-bold">Total User</h5>
                <p class="fs-3">{{ $totalUsers }}</p>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card shadow-sm p-3 mb-3">
                <h5 class="fw-bold">Total Modul</h5>
                <p class="fs-3">{{ $totalModules }}</p>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card shadow-sm p-3 mb-3">
                <h5 class="fw-bold">Permintaan Mentor</h5>
                <p class="fs-3">{{ $pendingMentors }}</p>
            </div>
        </div>

    </div>

</div>
@endsection
