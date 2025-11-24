@extends('layouts.dashboard')
@section('title', 'Dashboard') 
@section('content')
<div class="container py-4">

    <h1 class="mb-4 text-primary" 
        style="font-size: 2.5rem; font-weight: 800; border-bottom: 4px solid #000000; padding-bottom: 8px;">
        Dashboard Mentee
    </h1>

    <div class="row g-4">

        {{-- MODUL DIIKUTI --}}
        <div class="col-md-4 mb-3">
            <div class="card border border-2 rounded-4 shadow-sm py-4 px-3" style="background: #FFFFFF;">
                <div class="d-flex align-items-center">
                    <div class="ms-3">
                        <h6 class="fw-bold mb-1 text-primary" style="font-size: 1.1rem; font-weight: 700">Modul Diikuti</h6>
                        <h3 class="fw-bold mb-0" style="font-size: 2rem; font-weight: 300">{{ $totalModules }}</h3>
                    </div>
                </div>
            </div>
        </div>

        {{-- SUBMODUL SELESAI --}}
        <div class="col-md-4 mb-3">
            <div class="card border border-2 rounded-4 shadow-sm py-4 px-3" style="background: #FFFFFF;">
                <div class="d-flex align-items-center">
                    <div class="ms-3">
                        <h6 class="fw-bold mb-1 text-success" style="font-size: 1.1rem; font-weight: 700">Submodul Selesai</h6>
                        <h3 class="fw-bold mb-0" style="font-size: 2rem; font-weight: 300">{{ $totalCompleted }}</h3>
                    </div>
                </div>
            </div>
        </div>

        {{-- MODUL DISUKAI --}}
        <div class="col-md-4 mb-3">
            <div class="card border border-2 rounded-4 shadow-sm py-4 px-3" style="background: #FFFFFF;">
                <div class="d-flex align-items-center">
                    <div class="ms-3">
                        <h6 class="fw-bold mb-1 text-danger" style="font-size: 1.1rem; font-weight: 700">Modul Disukai</h6>
                        <h3 class="fw-bold mb-0" style="font-size: 2rem; font-weight: 300">{{ $totalLiked }}</h3>
                    </div>
                </div>
            </div>
        </div>



    </div>


</div>
@endsection
