    @extends('layouts.app')

    @section('content')

    <link rel="stylesheet" href="{{ asset('css/module_detail.css') }}">
    <style>
        .frame {
            width: 1156px;
            background-color: #0a57ff;
            border-radius: 20px;
            height: 314px; /* tetap */
            position: relative;
            margin: 30px auto;
            padding: 0; /* height sudah cukup */
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
            background-color: #ffffff;
            border: none;
            border-radius: 32px;
            display: flex;
            justify-content: center;
            align-items: center;
            transition: transform 0.2s ease, box-shadow 0.2s ease; /* animasi */
            cursor: pointer;
        }

        .like-icon-btn:hover {
            transform: scale(1.1); /* membesar saat hover */
            box-shadow: 0 6px 12px rgba(0,0,0,0.2); /* shadow muncul */
        }

        .like-icon-btn:active {
            transform: scale(0.95); /* efek ditekan */
        }


        .like-icon-btn img {
            width: 22px;
            height: 22px;
        }

        .text-wrapper {
            position: absolute;
            top: 24px;
            left: 320px;
            font-weight: 800;
            font-size: 56px;
            color: #ffffff;
        }

        .div {
            position: absolute;
            top: 92px;
            left: 320px;
            font-size: 22px;
            font-weight: 700;
            color: #626262;
        }

        .text-wrapper-7 {
            position: absolute;
            top: 230px;
            left: 320px;
            font-size: 18px;
            font-weight: 700;
        }

        .text-wrapper-8 {
            position: absolute;
            top: 258px;
            left: 320px;
            font-size: 18px;
            font-weight: 700;
        }

        .p {
            position: absolute;
            top: 124px;
            left: 320px;
            width: 880px;
            font-size: 17px;
            color: #ffffff;
        }
        .text-white {
            color: #ffffff;
        }

        /* SUBMODULES DI LUAR FRAME */
        .submodule-container {
            width: 1156px;
            margin: 20px auto; /* jarak dari frame */
        }

        /* SUBMODULE BOX */
        .submodule-box {
            width: 100%;
            height: 150px;
            background: #ffffff;
            border-radius: 20px;
            padding: 10px 20px;
            margin-top: 20px;
            position: relative;
            transition: all 0.3s ease; /* animasi smooth */
            cursor: pointer; /* terlihat interaktif */
        }

        .submodule-box:hover {
            box-shadow: 0 10px 20px rgba(0,0,0,0.15);
            transform: translateY(-5px);
        }


        .sub-title {
            font-size: 30px;
            font-weight: 700; 
            color: #000000;
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
            background-color: #ffffff;   
            border: 2px solid #0a57ff;
            font-size: 16px;
            font-weight: bold;
        }


        .status-box.done {
            color: #0a57ff;
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
            color: #000000;
            text-decoration: none;
        }
    </style>

    <div class="frame">

        {{-- FOTO THUMBNAIL --}}
        <img src="{{ asset('storage/' . $module->thumbnail) }}" class="rectangle" alt="thumbnail">

        {{-- LIKE BUTTON --}}
        <button id="like-button" class="like-icon-btn" data-module="{{ $module->id }}">
            @if($isLiked)
                <img src="/icons/unlike.svg" width="22">
            @else
                <img src="/icons/like.svg" width="22">
            @endif
        </button>

        {{-- JUDUL --}}
        <div class="text-wrapper">{{ $module->title }}</div>

        {{-- AUTHOR --}}
        <div class="div text-white">Oleh: {{ $module->user?->name ?? '-' }}</div>

        {{-- KATEGORI --}}
        <div class="text-wrapper-7 text-white">Kategori: {{ $module->category?->name ?? '-' }}</div>

        {{-- LIKES --}}
        <div class="text-wrapper-8 text-white">
            <span id="likes-count">{{ $module->likes_count }}</span> ❤️
        </div>

        {{-- DESKRIPSI --}}
        <p class="p">{{ $module->description }}</p>

    </div> <!-- frame END -->

    {{-- SUBMODULES DI LUAR FRAME --}}
    <div class="submodule-container">
        @foreach($module->submodules as $sub)
            <div class="submodule-box">
                <div class="sub-title">{{ $sub->title }}</div>

                <div class="status-tag">
                    @if($sub->isDoneBy(auth()->id()))
                        <div class="status-box done">Selesai</div>
                    @else
                        <div class="status-box not-done">Belum Selesai</div>
                    @endif
                </div>

                <a href="{{ route('pelajaran.submodule.show', ['moduleId'=>$module->id,'submoduleId'=>$sub->id]) }}"
                class="open-submodule">
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
