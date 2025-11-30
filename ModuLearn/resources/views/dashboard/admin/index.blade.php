@extends('layouts.dashboard')
@section('title', 'Dashboard') 
@section('content')
<div class="container py-4">

    {{-- JUDUL --}}
    <h1 class="mb-4 text-primary" 
        style="font-size: 2.5rem; font-weight: 800; border-bottom: 4px solid #000000; padding-bottom: 8px;">
        Dashboard Admin
    </h1>

    <div class="row g-4">

        {{-- TOTAL USER --}}
        <div class="col-md-4 mb-3">
            <div class="card border border-2 rounded-4 shadow-sm py-4 px-3" style="background: #FFFFFF;">
                <div class="ms-1">
                    <h6 class="fw-bold mb-1 text-primary" style="font-size: 1.1rem; font-weight:700;">
                        Total User
                    </h6>
                    <h3 class="fw-bold mb-0" style="font-size: 2rem; font-weight:300;">
                        {{ $totalUsers }}
                    </h3>
                </div>
            </div>
        </div>

        {{-- TOTAL MODUL --}}
        <div class="col-md-4 mb-3">
            <div class="card border border-2 rounded-4 shadow-sm py-4 px-3" style="background: #FFFFFF;">
                <div class="ms-1">
                    <h6 class="fw-bold mb-1 text-primary" style="font-size: 1.1rem; font-weight:700;">
                        Total Modul
                    </h6>
                    <h3 class="fw-bold mb-0" style="font-size: 2rem; font-weight:300;">
                        {{ $totalModules }}
                    </h3>
                </div>
            </div>
        </div>

        {{-- PERMINTAAN MENTOR --}}
        <div class="col-md-4 mb-3">
            <div class="card border border-2 rounded-4 shadow-sm py-4 px-3" style="background: #FFFFFF;">
                <div class="ms-1">
                    <h6 class="fw-bold mb-1 text-primary" style="font-size: 1.1rem; font-weight:700;">
                        Permintaan Mentor
                    </h6>
                    <h3 class="fw-bold mb-0" style="font-size: 2rem; font-weight:300;">
                        {{ $pendingMentors }}
                    </h3>
                </div>
            </div>
        </div>

    </div>

</div>
@endsection
