@extends('layouts.dashboard')
@section('title', 'Liked Modules')
@section('content')

<!-- Inline style unik untuk menghindari override -->
<style>
  .lm-root {
    padding-top: 1.5rem;
    padding-bottom: 2rem;
  }

  .lm-heading {
    font-size: 1.6rem;
    font-weight: 800;
    margin-bottom: 1.25rem;
  }

  .lm-card {
    background: #ffffff;
    border-radius: 18px;
    padding: 22px;
    border: 2px solid #ececec;
    min-height: 140px;
    transition: transform .22s ease, box-shadow .22s ease, border-color .22s ease;
    display: flex;
    align-items: flex-start;
    gap: 16px;
  }

  .lm-card:hover {
    transform: translateY(-6px) scale(1.015);
    box-shadow: 0 14px 28px rgba(0,0,0,0.10);
    border-color: #d6d6d6;
  }

  .lm-icon {
    width: 66px;
    height: 66px;
    border-radius: 14px;
    display: flex;
    align-items: center;
    justify-content: center;
    flex-shrink: 0;
  }

  .lm-icon svg {
    width: 36px;
    height: 36px;
  }

  .lm-title {
    font-size: 1.05rem;
    font-weight: 700;
    margin: 0 0 6px 0;
  }

  .lm-meta {
    color: #6c757d;
    margin: 0 0 8px 0;
    font-size: 0.95rem;
  }

  .lm-likes {
    color: #dc3545;
    font-weight: 700;
    font-size: 0.95rem;
  }

  @media (max-width: 767px) {
    .lm-card {
      padding: 16px;
      min-height: auto;
      flex-direction: column;
      align-items: stretch;
    }
    .lm-icon {
      width: 56px;
      height: 56px;
    }
    .lm-icon svg {
      width: 28px;
      height: 28px;
    }
  }
</style>

<div class="container lm-root">

    <h3 class="lm-heading">Modul yang Kamu Like</h3>

    <div class="row">
        @forelse($likedModules as $mod)
            <div class="col-md-4 mb-4">
                <div class="lm-card">

                    <div class="lm-icon" style="background:#fdecea;">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                            <path fill="#dc3545" d="M12 21s-7-4.635-9.5-7.057C-1 10.5 3 4 7.5 6.5 9 7.5 10 9 12 11c2-2 3-3.5 4.5-4.5C21 4 25 10.5 21.5 13.943 19 16.365 12 21 12 21z"/>
                        </svg>
                    </div>

                    <div class="flex-grow-1">
                        <h5 class="lm-title">{{ $mod->title ?? '—' }}</h5>
                        <p class="lm-meta">Kategori: <strong>{{ optional($mod->category)->name ?? '—' }}</strong></p>
                        <p class="lm-likes">❤️ {{ $mod->likes_count ?? 0 }} Likes</p>
                    </div>

                </div>
            </div>
        @empty
            <div class="col-12">
                <div class="lm-card">
                    <div class="lm-icon" style="background:#f8f9fa;">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                            <path fill="#6c757d" d="M12 2a10 10 0 1 0 0 20 10 10 0 0 0 0-20zM11 6h2v6h-2V6zm0 8h2v2h-2v-2z"/>
                        </svg>
                    </div>
                    <div>
                        <h5 class="lm-title">Belum ada modul yang kamu like</h5>
                        <p class="lm-meta">Telusuri modul dan like yang kamu suka.</p>
                    </div>
                </div>
            </div>
        @endforelse
    </div>

    @if(method_exists($likedModules, 'links'))
      <div class="mt-3">{{ $likedModules->links() }}</div>
    @endif

</div>

@endsection
