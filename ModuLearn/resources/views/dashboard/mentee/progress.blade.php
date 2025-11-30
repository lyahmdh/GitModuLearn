@extends('layouts.dashboard')
@section('title', 'Dashboard') 
@section('content')

<style>
  .pmx-root { padding: 1.25rem 0; }
  .pmx-heading { font-size:1.6rem; font-weight:800; margin-bottom:1rem; }

  .pmx-card {
    border-radius: 14px;
    padding: 14px;
    border: 1px solid #eef4ff;
    background: linear-gradient(180deg,#fff,#fbfdff);
    box-shadow: 0 10px 22px rgba(10,20,40,0.04);
    transition: transform .14s ease, box-shadow .14s ease;
    overflow: hidden;
    display:flex;
    gap:14px;
    align-items:flex-start;
  }
  .pmx-card:hover { transform: translateY(-6px); box-shadow: 0 24px 48px rgba(10,20,40,0.06); }

  .pmx-icon {
    width:66px; height:66px; border-radius:12px; flex-shrink:0;
    display:flex; align-items:center; justify-content:center;
    background: linear-gradient(135deg,#eef6ff,#eaf8ff);
    border:1px solid #e6f0ff;
  }
  .pmx-icon svg { width:36px; height:36px; }

  .pmx-body { flex:1; min-width:0; }
  .pmx-title { margin:0 0 6px 0; font-weight:800; font-size:1.05rem; overflow:hidden; text-overflow:ellipsis; white-space:nowrap; }
  .pmx-desc { margin:0 0 10px 0; color:#6c757d; font-size:0.95rem; overflow:hidden; text-overflow:ellipsis; white-space:nowrap; }

  .pmx-progress-row { display:flex; gap:12px; align-items:center; justify-content:space-between; margin-top:8px; }
  .pmx-progress {
    flex:1;
    height:18px;
    background:#f1f5ff;
    border-radius:12px;
    overflow:hidden;
    border:1px solid #e8efff;
    position:relative;
  }
  .pmx-fill {
    height:100%;
    width:0%;
    border-radius:12px;
    transition: width 900ms cubic-bezier(.2,.9,.2,1);
    display:flex;
    align-items:center;
    justify-content:flex-end;
    padding-right:8px;
    color:#fff;
    font-weight:700;
    font-size:0.85rem;
    box-sizing:border-box;
    white-space:nowrap;
  }
  .pmx-fill--low { background: linear-gradient(90deg,#ff6b6b,#ff8a6b); }   /* <40% */
  .pmx-fill--mid { background: linear-gradient(90deg,#ffb74d,#ffc857); }   /* 40-74% */
  .pmx-fill--high { background: linear-gradient(90deg,#4caf50,#61d38a); }  /* >=75% */

  .pmx-meta { color:#6c757d; font-size:0.9rem; margin-top:8px; display:flex; justify-content:space-between; gap:12px; align-items:center; }
  .pmx-badge { padding:6px 10px; border-radius:999px; font-weight:700; font-size:0.85rem; }
  .pmx-badge--done { background:#d4edda; color:#155724; border:1px solid #c3e6cb; }
  .pmx-badge--doing { background:#fff3cd; color:#856404; border:1px solid #ffeeba; }
  .pmx-badge--idle { background:#f8d7da; color:#721c24; border:1px solid #f5c6cb; }

  .pmx-actions { display:flex; gap:8px; align-items:center; margin-top:8px; }

  .pmx-percent { min-width:64px; text-align:right; font-weight:800; font-size:0.98rem; }

  .pmx-missing { color:#b02a37; font-weight:700; }

  @media (max-width:767px){
    .pmx-card { flex-direction:column; align-items:stretch; }
    .pmx-desc { white-space:normal; }
    .pmx-percent { text-align:left; }
  }
</style>

<div class="container pmx-root">
  <h3 class="pmx-heading">Progress Belajar Kamu</h3>

  @php
    // check existence of route names once to avoid repeated calls
    $hasModulesShow = \Illuminate\Support\Facades\Route::has('modules.show');
    $hasModulesResume = \Illuminate\Support\Facades\Route::has('modules.resume');
    $hasModulesIndex = \Illuminate\Support\Facades\Route::has('modules.index');
  @endphp

  @if(empty($progressList) || collect($progressList)->isEmpty())
    <div class="pmx-card">
      <div class="pmx-icon" aria-hidden="true" style="background:#f8f9fa;">
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path fill="#6c757d" d="M12 2a10 10 0 1 0 0 20 10 10 0 0 0 0-20zM11 6h2v6h-2V6zm0 8h2v2h-2v-2z"/></svg>
      </div>
      <div class="pmx-body">
        <h5 class="pmx-title">Belum ada progress modul</h5>
        <p class="pmx-desc">Mulai pelajari modul untuk melihat progressmu di sini.</p>
        <div class="pmx-actions">
          @if($hasModulesIndex)
            <a href="{{ route('modules.index') }}" class="btn btn-sm btn-outline-primary">Telusuri Modul</a>
          @else
            <a href="#" class="btn btn-sm btn-outline-primary">Telusuri Modul</a>
          @endif
        </div>
      </div>
    </div>
  @else
    @foreach($progressList as $i => $item)
      @php
        $module = $item['module'] ?? null;
        $progress = isset($item['progress']) ? (int)$item['progress'] : 0;
        $completed = isset($item['completed']) ? (int)$item['completed'] : 0;
        $total = isset($item['total']) ? (int)$item['total'] : 0;
        $status = $progress >= 100 ? 'done' : ($progress == 0 ? 'idle' : 'doing');
        $mid = $module->id ?? null;
        $title = $module->title ?? '—';
        $desc = $module->description ?? '-';
      @endphp

      @if($module)
        <div class="pmx-card mb-3" data-pmx-index="{{ $i }}">
          <div class="pmx-icon" aria-hidden="true">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none"><path d="M3 5.5C3 4.67 3.67 4 4.5 4H19.5C20.33 4 21 4.67 21 5.5V18.5C21 19.33 20.33 20 19.5 20H4.5C3.67 20 3 19.33 3 18.5V5.5Z" stroke="#2b6cff" stroke-width="1.2" stroke-linecap="round" stroke-linejoin="round"/><path d="M7 8H17" stroke="#2b6cff" stroke-width="1.2" stroke-linecap="round" stroke-linejoin="round"/></svg>
          </div>

          <div class="pmx-body">
            <div style="display:flex; align-items:start; justify-content:space-between; gap:12px;">
              <div style="min-width:0;">
                <h5 class="pmx-title">{{ $title }}</h5>
                <p class="pmx-desc">{{ Str::limit($desc, 120) }}</p>
              </div>

              <div style="display:flex; flex-direction:column; align-items:flex-end; gap:8px;">
                <span class="pmx-badge {{ $status == 'done' ? 'pmx-badge--done' : ($status == 'idle' ? 'pmx-badge--idle' : 'pmx-badge--doing') }}">
                  {{ $status == 'done' ? 'Selesai' : ($status == 'idle' ? 'Belum Mulai' : 'Sedang Berlangsung') }}
                </span>

                <div class="pmx-actions">
                  {{-- Safe "Lihat Modul" link: only call route() if route exists --}}
                  @if($hasModulesShow && $mid)
                    <a href="{{ route('modules.show', $mid) }}" class="btn btn-sm btn-outline-primary">Lihat Modul</a>
                  @elseif($hasModulesIndex)
                    <a href="{{ route('modules.index') }}" class="btn btn-sm btn-outline-primary">Lihat Modul</a>
                  @else
                    <a href="#" class="btn btn-sm btn-outline-primary">Lihat Modul</a>
                  @endif

                  {{-- Safe "Lanjutkan" link --}}
                  @if($hasModulesResume && $mid)
                    <a href="{{ route('modules.resume', $mid) }}" class="btn btn-sm btn-secondary">Lanjutkan</a>
                  @elseif($hasModulesShow && $mid)
                    {{-- fallback: go to show if resume not available --}}
                    <a href="{{ route('modules.show', $mid) }}" class="btn btn-sm btn-secondary">Lanjutkan</a>
                  @else
                    {{-- fallback to index or disabled link --}}
                    @if($hasModulesIndex)
                      <a href="{{ route('modules.index') }}" class="btn btn-sm btn-secondary">Lanjutkan</a>
                    @else
                      <a href="#" class="btn btn-sm btn-secondary">Lanjutkan</a>
                    @endif
                  @endif
                </div>
              </div>
            </div>

            <div class="pmx-progress-row">
              <div class="pmx-progress" role="progressbar" aria-valuemin="0" aria-valuemax="100" aria-valuenow="{{ $progress }}">
                <div class="pmx-fill" data-pmx-progress="{{ $progress }}">{{ $progress >= 9 ? $progress . '%' : '' }}</div>
              </div>

              <div class="pmx-percent" data-pmx-target="{{ $progress }}">0%</div>
            </div>

            <div class="pmx-meta">
              <div>{{ $completed }} selesai dari {{ $total }} submodul</div>
              <div class="text-muted" style="font-size:0.92rem;">
                <small>{{ optional($module)->updated_at ? optional($module)->updated_at->diffForHumans() : '' }}</small>
              </div>
            </div>
          </div>
        </div>

      @else
        <div class="pmx-card mb-3">
          <div class="pmx-icon" aria-hidden="true" style="background:#fff6f6;">
            <svg width="28" height="28" viewBox="0 0 24 24" fill="none"><path d="M12 3l9 16H3L12 3z" stroke="#d6333e" stroke-width="1.4" stroke-linecap="round" stroke-linejoin="round"/></svg>
          </div>
          <div class="pmx-body">
            <p class="pmx-missing mb-1">Module tidak ditemukan (mungkin sudah dihapus).</p>
            <div class="pmx-meta" style="margin-top:6px;">
              <div class="text-muted">Periksa daftar modul atau hubungi admin.</div>
              @if($hasModulesIndex)
                <div><a href="{{ route('modules.index') }}" class="btn btn-sm btn-outline-primary">Telusuri Modul</a></div>
              @else
                <div><a href="#" class="btn btn-sm btn-outline-primary">Telusuri Modul</a></div>
              @endif
            </div>
          </div>
        </div>
      @endif

    @endforeach
  @endif

  {{-- pagination --}}
  @if(method_exists($progressList, 'links'))
    <div class="mt-3">{{ $progressList->links() }}</div>
  @endif
</div>

<script>
(function(){
  function animateNumber(el, from, to, duration){
    const start = performance.now();
    function frame(now){
      const t = Math.min(1, (now - start)/duration);
      el.textContent = Math.floor(from + (to - from) * t) + '%';
      if(t < 1) requestAnimationFrame(frame);
    }
    requestAnimationFrame(frame);
  }

  document.addEventListener('DOMContentLoaded', function(){
    const fills = document.querySelectorAll('.pmx-fill');
    fills.forEach((fill, idx) => {
      const pct = Math.max(0, Math.min(100, parseInt(fill.getAttribute('data-pmx-progress') || '0', 10)));
      if(pct >= 75) fill.classList.add('pmx-fill--high');
      else if(pct >= 40) fill.classList.add('pmx-fill--mid');
      else fill.classList.add('pmx-fill--low');

      setTimeout(()=> {
        fill.style.width = pct + '%';
        if(pct >= 9) fill.textContent = pct + '%';
      }, 120 + idx * 80);
    });

    const counters = document.querySelectorAll('[data-pmx-target]');
    counters.forEach((c, idx) => {
      const tgt = Math.max(0, Math.min(100, parseInt(c.getAttribute('data-pmx-target') || '0', 10)));
      setTimeout(()=> animateNumber(c, 0, tgt, 900 + Math.random()*300), 150 + idx * 80);
    });
  });
})();
</script>

@endsection
