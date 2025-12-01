@extends('layouts.guest')

@section('content')

<style>
    /* ================= HERO SECTION ================= */
    .hero-section {
    background: #eaf4ff; /* soft blue */
    padding: 120px 0;
    display: flex;
    justify-content: center;
    align-items: center;
    }

    .hero-img {
        width: 750px;      /* ukuran fix, bebas kamu mau ubah */
        height: auto;
        object-fit: contain;
    }


    /* ================= FEATURES SECTION ================= */
    .fitur-section {
        background: #ffffff;
        padding: 90px 0;
    }

    .fitur-title {
        font-weight: 800;
        font-size: 3.5rem;
        color: #0A57FF;
        margin-bottom: 50px;
    }

    .fitur-box {
        background: #ffffff;
        border-radius: 18px;
        padding: 25px 30px;
        display: flex;
        flex-direction: column;   /* center vertically */
        align-items: center;      /* center horizontally */
        text-align: center;       /* center text */
        gap: 14px;
        transition: 0.25s ease;
        box-shadow: 0 3px 10px rgba(0,0,0,0.06);
        height: 100%;
        max-width: 500px;
        margin-left: auto;
        margin-right: auto;
        margin-bottom: 20px;
    }

    .fitur-box:hover {
        transform: translateY(-6px);
        box-shadow: 0 10px 25px rgba(0,0,0,0.13);
    }

    .fitur-icon-img {
        width: 45px;
        opacity: 0.9;
    }

    .fitur-box h5 {
        font-size: 1.5rem;
        font-weight: 800;
        margin: 0;
        color: #333;
    }

    .fitur-box p {
        color: #6e6e6e;
        font-size: 0.92rem;
        margin: 0;
    }
</style>


{{-- ================= HERO SECTION ================= --}}
<div class="hero-section">
    <img src="/images/hero.png" alt="ModuLearn Hero" class="hero-img">
</div>

{{-- ================= FEATURES SECTION ================= --}}
<div class="fitur-section" id="fitur">
    <div class="container text-center">

        <h2 class="fitur-title mb-5">Our Features</h2>

        <div class="row g-4 justify-content-center">

            {{-- MODUL --}}
            <div class="col-md-5">
                <div class="fitur-box">
                    <img src="/images/icons/modul.png" class="fitur-icon-img" alt="Modul">
                    <h5>Modul</h5>
                    <p>Topik utama pembelajaran yang disusun oleh mentor.</p>
                </div>
            </div>

            {{-- SUBMODUL --}}
            <div class="col-md-5">
                <div class="fitur-box">
                    <img src="/images/icons/submodul.png" class="fitur-icon-img" alt="Submodul">
                    <h5>Submodul</h5>
                    <p>Bagian dari modul yang berisi materi atau tugas spesifik.</p>
                </div>
            </div>

            {{-- LIKES --}}
            <div class="col-md-5">
                <div class="fitur-box">
                    <img src="/images/icons/likes.png" class="fitur-icon-img" alt="Likes">
                    <h5>Likes</h5>
                    <p>Menyukai modul yang diinginkan dan tercatat pada dashboard.</p>
                </div>
            </div>

            {{-- DONE --}}
            <div class="col-md-5">
                <div class="fitur-box">
                    <img src="/images/icons/done.png" class="fitur-icon-img" alt="Done">
                    <h5>Done</h5>
                    <p>Menandai submodul yang telah selesai dan tercatat pada progress.</p>
                </div>
            </div>

        </div>
    </div>
</div>

@endsection
