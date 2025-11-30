@extends('layouts.app')

@section('content')

<link rel="stylesheet" href="{{ asset('css/module_detail.css') }}">
<style>
    .frame {
        position: absolute;
        left: calc(50% - 578px);
        width: 1156px;
        background-color: #ffffff;
        border-radius: 20px;
        height: 400px;
        padding-bottom: 200px;
        /* position: relative; */
        padding-top: 30px;
        margin-top: 30px;
        margin-bottom: 30px;
    }

    /* THUMBNAIL */
    .rectangle {
        position: absolute;
        top: 32px;
        left: 41px;
        width: 250px;
        height: 250px;
        border-radius: 12px;
        object-fit: cover;
    }

    /* LIKE ICON */
    .like-icon-btn {
        position: absolute;
        top: 32px;
        left: 1050px;
        width: 64px;
        height: 64px;
        background: #d9d9d9;
        border: none;
        border-radius: 32px;
        display: flex;
        justify-content: center;
        align-items: center;
    }

    .like-icon-btn img {
        width: 22px;
        height: 22px;
    }

    .text-wrapper {
        position: absolute;
        top: 24px;
        left: calc(50% - 311px);
        font-family: Inter, sans-serif;
        font-weight: 700;
        font-size: 56px;
        color: #626262;
    }

    .div {
        position: absolute;
        top: 89px;
        left: calc(50% - 308px);
        font-size: 22px;
        color: #626262;
    }

    .text-wrapper-7 {
        position: absolute;
        top: 227px;
        left: calc(50% - 308px);
        font-size: 18px;
        font-weight: 700;
    }

    .text-wrapper-8 {
        position: absolute;
        top: 255px;
        left: calc(50% - 308px);
        font-size: 18px;
        font-weight: 700;
    }

    .p {
        position: absolute;
        top: 124px;
        left: calc(50% - 308px);
        width: 880px;
        font-size: 17px;
        color: #626262;
    }

    /* SUBMODULE BOX */
    .submodule-box {
        position: absolute;
        left: calc(50% - 578px);
        width: 1156px;
        height: 150px;
        background: #d9d9d9;
        border-radius: 20px;
        padding-left: 20px;
        padding-top: 10px;
        margin-top: 400px;
    }

    .sub-title {
        font-size: 30px;
        font-weight: 700; 
        color: #626262;
    }

    /* STATUS TAG */
    .status-tag {
        position: absolute;
        top: 20px;
        right: 20px;
    }

    .status-box {
        padding: 4px 16px;
        border-radius: 20px;
        background: #fff;
        font-size: 16px;
        font-weight: bold;
    }

    .status-box.done {
        color: green;
    }

    .status-box.not-done {
        color: #626262;
    }

    /* Open Submodule Link */
    .open-submodule {
        position: absolute;
        bottom: 20px;
        right: 20px;
        font-size: 18px;
        font-weight: 600;
        color: #444;
        text-decoration: none;
    }
</style>

<div class="frame">

    {{-- FOTO THUMBNAIL --}}
    <img class="rectangle" src="{{ $module->thumbnail }}" alt="thumbnail">

    {{-- LIKE BUTTON (TANPA MENGUBAH SCRIPT) --}}
    <button 
        id="like-button"
        class="like-icon-btn"
        data-module="{{ $module->id }}"
    >
        @if($isLiked)
            <img src="/icons/unlike.svg" width="22">
        @else
            <img src="/icons/like.svg" width="22">
        @endif
    </button>

    {{-- JUDUL --}}
    <div class="text-wrapper">{{ $module->title }}</div>

    {{-- AUTHOR --}}
    <div class="div">Oleh: {{ $module->user?->name ?? '-' }}</div>

    {{-- KATEGORI --}}
    <div class="text-wrapper-7">Kategori: {{ $module->category?->name ?? '-' }}</div>

    {{-- LIKES COUNT --}}
    <div class="text-wrapper-8">
        <span id="likes-count">{{ $module->likes_count }}</span> ❤️
    </div>

    {{-- DESKRIPSI --}}
    <p class="p">{{ $module->description }}</p>


    {{-- LIST SUBMODUL (DINAMIS SESUAI JUMLAH) --}}
    @foreach($module->submodules as $index => $sub)
        <div class="submodule-box">
            
            {{-- JUDUL SUBMODUL --}}
            <div class="sub-title">{{ $sub->title }}</div>

            {{-- STATUS --}}
            <div class="status-tag">
                @if($sub->isDoneBy(auth()->id()))
                    <div class="status-box done">Selesai</div>
                @else
                    <div class="status-box not-done">Belum Selesai</div>
                @endif
            </div>

            {{-- LINK --}}
            <a 
                href="{{ route('pelajaran.submodule.show', ['moduleId'=>$module->id,'submoduleId'=>$sub->id]) }}"
                class="open-submodule"
            >
                Buka Materi →
            </a>

        </div>
    @endforeach

</div>
@endsection



@push('scripts')
<script>
document.getElementById('like-button').addEventListener('click', function () {

    let moduleId = this.dataset.module;

    fetch(`/modules/${moduleId}/like`, {
        method: 'POST',
        headers: {
            "Content-Type": "application/json",
            "X-CSRF-TOKEN": "{{ csrf_token() }}"
        }
    })

    .then(res => res.json())
    .then(data => {

        document.getElementById('likes-count').innerText = data.likes_count;

        if (data.liked) {
            this.innerHTML = `<img src="/icons/unlike.svg" width="22">`;
        } else {
            this.innerHTML = `<img src="/icons/like.svg" width="22">`;
        }
    })
    .catch(err => console.error(err));
});
</script>
@endpush
