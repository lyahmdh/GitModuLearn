@extends('layouts.app')

@section('content')
<style>
    /* == Modern Card == */
    .module-card {
        background-color: #ffffff;
        margin-left:100px;
        margin-right:100px;
        border-radius: 30px;
        min-height: 224px;
        padding: 25px 30px;
        display: flex;
        align-items: center;
        gap: 30px;
        transition: all 0.3s ease; /* animasi smooth */
    }

    .module-card:hover {
        box-shadow: 0 15px 30px rgba(0,0,0,0.15); /* shadow saat hover */
        transform: translateY(-5px); /* naik sedikit */
    }


    .module-thumb {
        width: 200px;
        height: 200px;
        border-radius: 14px;
        border: 2px solid #0a57ff;
        object-fit: cover;
        background: #fff;
    }

    .module-info {
        flex: 1;
    }

    .module-title {
        font-weight: 700;
        color: #3b3b3b;
        font-size: 35px;
        margin: 0;
    }

    .module-category {
        font-weight: 700;
        color: #3b3b3b;
        font-size: 17px;
        margin-top: 8px;
    }

    .module-likes {
        font-weight: 700;
        color: #3b3b3b;
        font-size: 13px;
        margin-top: 8px;
    }

    .module-desc {
        font-weight: 400;
        color: #3b3b3b;
        font-size: 13px;
        max-width: 450px;
        margin-top: 15px;
    }

    .module-btn {
        background: #2E4FBC;
        border-radius: 30px;
        padding: 6px 25px;
        font-weight: 700;
        color: #ffffff;
        font-size: 16px;
        border: none;
        margin-top: 18px;
        display: inline-block;
        text-decoration: none;
    }
</style>

<div class="container py-4">

    {{-- SEARCH + KATEGORI --}}
    <form method="GET" class="mb-4">
        <div class="d-flex gap-3" style="margin-left:100px; margin-right:90px;">

            {{-- SEARCH BAR --}}
            <input 
                type="text" 
                name="search" 
                class="form-control rounded-pill px-4"
                placeholder="Cari modul..."
                value="{{ request('search') }}"
                style="width: 1100px; height: 48px; flex: 1; border-radius: 30px; border: 2px solid #0a57ff;">

            {{-- DROPDOWN CATEGORY --}}
            <select 
                name="category" 
                class="form-select rounded-pill px-3" 
                onchange="this.form.submit()" 
                style="width: 220px; height:48px; border-radius: 30px; border: 2px solid #0a57ff;">
                <option value="">Semua Kategori</option>
                @foreach($categories as $cat)
                    <option value="{{ $cat->id }}" 
                        {{ request('category') == $cat->id ? 'selected' : '' }}>
                        {{ $cat->name }}
                    </option>
                @endforeach
            </select>

        </div>
    </form>

    {{-- LIST MODUL --}}
    <div class="row">
        @foreach($modules as $mod)
            <div class="col-12 mb-4">

                <div class="module-card">

                    {{-- THUMBNAIL --}}
                    <img src="{{ asset('storage/' . $mod->thumbnail) }}"
                        class="module-thumb">

                    {{-- TEXT SECTION --}}
                    <div class="module-info">

                        <h2 class="module-title">{{ $mod->title }}</h2>

                        <div class="module-category">
                            Kategori: {{ $mod->category->name ?? '-' }}
                        </div>

                        <div class="module-likes">
                            {{ $mod->likes_count ?? 0 }} ❤️
                        </div>

                        <p class="module-desc">
                            {{ Str::limit($mod->description, 140) }}
                        </p>

                        <a href="{{ route('pelajaran.module.show', $mod->id) }}" 
                        class="module-btn">
                            Lihat modul
                        </a>

                    </div>
                </div>

            </div>
        @endforeach
    </div>



@endsection
