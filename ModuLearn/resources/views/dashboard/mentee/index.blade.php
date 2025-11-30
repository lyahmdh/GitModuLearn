@extends('layouts.dashboard')
@section('title', 'Dashboard') 
@section('content')

<style>
    /* CARD BESAR */
    .stat-card {
        background: #fff;
        border-radius: 20px;
        padding: 32px 28px;
        border: 2px solid #e2e2e2;
        display: flex;
        align-items: center;
        min-height: 150px;
        transition: all .25s ease;
    }

    /* Hover */
    .stat-card:hover {
        transform: translateY(-8px) scale(1.03);
        box-shadow: 0 15px 30px rgba(0,0,0,0.18);
        border-color: #cfcfcf;
    }

    /* SQUARE ICON BOX */
    .icon-box {
        width: 75px;       
        height: 75px;     
        border-radius: 14px;
        display: flex;
        justify-content: center;
        align-items: center;
        font-size: 36px;  
        color: #fff;
        flex-shrink: 0;
    }

    /* Judul */
    .stat-title {
        font-size: 1.15rem;
        font-weight: 700;
        margin: 0;
    }

    /* Angka utama */
    .stat-value {
        font-size: 2.6rem;
        font-weight: 700;
        margin-top: 4px;
    }

    /* Label group */
    .label-group {
        margin-left: 18px;
        display: flex;
        flex-direction: column;
        justify-content: center;
    }
</style>


<div class="container py-4">

    <h1 class="mb-4 text-primary" 
        style="font-size: 2.3rem; font-weight: 800; border-bottom: 4px solid #000000; padding-bottom: 8px;">
        Dashboard Mentee
    </h1>

    <div class="row g-4">

        {{-- MODUL DIIKUTI --}}
        <div class="col-md-4">
            <div class="stat-card">
                
                {{-- ICON BOX SQUARE (BOOK/JOURNAL) --}}
                <div class="icon-box" style="background:#0d6efd;">
                    <!-- Inline SVG: journal/book -->
                    <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" viewBox="0 0 16 16" aria-hidden="true" focusable="false">
                      <path fill="#fff" d="M1 2.828c.885-.37 2.154-.828 4-.828 1.847 0 3.115.457 4 .828V14c-.885-.37-2.154-.828-4-.828-1.847 0-3.115.457-4 .828V2.828z"/>
                      <path fill="#fff" d="M6 1h8v13H6V1z" opacity="0.9"/>
                    </svg>
                </div>

                <div class="label-group">
                    <p class="stat-title text-primary">Modul Diikuti</p>
                    <p class="stat-value">{{ $totalModules }}</p>
                </div>
            </div>
        </div>

        {{-- SUBMODUL SELESAI --}}
        <div class="col-md-4">
            <div class="stat-card">

                <div class="icon-box" style="background:#198754;">
                    <!-- Inline SVG: check-square (centred) -->
                    <svg xmlns="http://www.w3.org/2000/svg" width="44" height="44" viewBox="0 0 16 16" aria-hidden="true" focusable="false">
                      <path fill="#fff" d="M14 1H2a1 1 0 0 0-1 1v12a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1zM6.5 10.5L3.5 7.5l1-1L6.5 8.5l4.5-4.5 1 1L6.5 10.5z"/>
                    </svg>
                </div>

                <div class="label-group">
                    <p class="stat-title text-success">Submodul Selesai</p>
                    <p class="stat-value">{{ $totalCompleted }}</p>
                </div>
            </div>
        </div>

        {{-- MODUL DISUKAI --}}
        <div class="col-md-4">
            <div class="stat-card">

                <div class="icon-box" style="background:#dc3545;">
                    <!-- Inline SVG: heart -->
                    <svg xmlns="http://www.w3.org/2000/svg" width="42" height="42" viewBox="0 0 24 24" aria-hidden="true" focusable="false">
                      <path fill="#fff" d="M12 21s-7-4.635-9.5-7.057C-1 10.5 3 4 7.5 6.5 9 7.5 10 9 12 11c2-2 3-3.5 4.5-4.5C21 4 25 10.5 21.5 13.943 19 16.365 12 21 12 21z" opacity="0.95"/>
                    </svg>
                </div>

                <div class="label-group">
                    <p class="stat-title text-danger">Modul Disukai</p>
                    <p class="stat-value">{{ $totalLiked }}</p>
                </div>
            </div>
        </div>

    </div>

</div>

@endsection
