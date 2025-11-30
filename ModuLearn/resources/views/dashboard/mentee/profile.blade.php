@extends('layouts.dashboard')
@section('title', 'Dashboard') 
@section('content')

<!-- Inline styles unik dengan prefix 'ep-' -->
<style>
  .ep-container { padding: 1.5rem 0; }
  .ep-heading {
    font-size: 2.2rem;
    font-weight: 800;
    margin-bottom: 1rem;
    border-bottom: 4px solid #000;
    padding-bottom: 8px;
  }

  .ep-card {
    background: #fff;
    border-radius: 14px;
    padding: 20px;
    border: 1.5px solid #ececec;
    box-shadow: 0 8px 18px rgba(0,0,0,0.04);
    transition: transform .18s ease, box-shadow .18s ease;
  }
  .ep-card:hover { transform: translateY(-6px); box-shadow: 0 18px 36px rgba(0,0,0,0.06); }

  .ep-row { gap: 1.25rem; }

  .ep-profile-wrap {
    display:flex;
    gap: 18px;
    align-items:center;
    flex-wrap:wrap;
  }

  .ep-avatar {
    width:110px;
    height:110px;
    border-radius:50%;
    object-fit:cover;
    border:4px solid #fff;
    box-shadow: 0 6px 18px rgba(0,0,0,0.08);
  }

  .ep-input {
    border-radius: 12px;
    padding: 10px 14px;
    border: 1.5px solid #d6d6d6;
    transition: box-shadow .18s ease, border-color .18s ease;
    width:100%;
    background: #fff;
  }
  .ep-input:focus { box-shadow: 0 6px 18px rgba(13,110,253,0.08); border-color: #9fc1ff; outline: none; }

  .ep-file-label {
    display:inline-flex;
    align-items:center;
    gap:10px;
    padding:8px 12px;
    background:#0d6efd;
    color:#fff;
    border-radius:10px;
    cursor:pointer;
    user-select:none;
    font-weight:600;
    font-size:0.95rem;
  }

  .ep-small {
    font-size:0.92rem;
    color:#6c757d;
    margin-top:6px;
  }

  .ep-section { margin-bottom:1rem; }

  .ep-meta-row { display:flex; gap:12px; align-items:center; margin-top:10px; flex-wrap:wrap; }

  .ep-btn {
    padding:10px 18px;
    border-radius:10px;
    font-weight:700;
  }

  .ep-danger-card {
    background: #fff7f7;
    border: 1.5px solid #f5c6cb;
    color: #842029;
  }

  .ep-toggle-btn {
    cursor: pointer;
    background: transparent;
    border: 1px dashed #cfcfcf;
    padding: 8px 12px;
    border-radius: 8px;
    font-weight: 700;
  }

  .ep-pass-msg { font-size:0.95rem; margin-top:8px; }

  @media (max-width:767px) {
    .ep-avatar { width:90px; height:90px; }
  }
</style>

<div class="container ep-container">

  <h1 class="ep-heading text-primary">Edit Profile</h1>

  {{-- Flash messages --}}
  @if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
  @endif

  @if($errors->any())
    <div class="alert alert-danger">
      <ul class="mb-0">
        @foreach($errors->all() as $err)
          <li>{{ $err }}</li>
        @endforeach
      </ul>
    </div>
  @endif

  {{-- FORM UPDATE --}}
  <form method="POST" action="{{ route('profile.update') }}" enctype="multipart/form-data" class="row g-4" id="ep-form">
    @csrf
    @method('PUT')

    <div class="col-12">
      <div class="ep-card ep-section">
        <h5 class="mb-3 fw-bold">Foto Profil</h5>

        <div class="ep-profile-wrap">
          {{-- Current avatar --}}
          <img id="ep-avatar-preview"
               src="{{ $user->profile_photo_path ? asset($user->profile_photo_path) : asset('assets/default-profile.png') }}"
               alt="Avatar" class="ep-avatar">

          <div style="min-width:200px;">
            <label class="ep-file-label" for="ep-profile-photo">
              <!-- inline svg camera icon -->
              <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" aria-hidden="true">
                <path d="M4 7h2l2-3h6l2 3h2v11a2 2 0 0 1-2 2H6a2 2 0 0 1-2-2V7z" stroke="#fff" stroke-width="1.3" stroke-linecap="round" stroke-linejoin="round"/>
                <circle cx="12" cy="13" r="3" stroke="#fff" stroke-width="1.3"/>
              </svg>
              Pilih Foto
            </label>

            <input id="ep-profile-photo" type="file" name="profile_photo" accept="image/*" style="display:none;" class="ep-input">

            <div class="ep-small">Ukuran maksimal 2MB. Tipe: jpg, png, webp.</div>

            {{-- preview filename --}}
            <div id="ep-file-name" class="ep-small mt-2 text-muted"></div>
          </div>
        </div>
      </div>
    </div>

    {{-- NAME --}}
    <div class="col-md-6">
      <div class="ep-card ep-section">
        <h6 class="fw-bold mb-2">Nama</h6>
        <input type="text" name="name" class="ep-input" value="{{ old('name', auth()->user()->name) }}" required>
      </div>
    </div>

    {{-- EMAIL --}}
    <div class="col-md-6">
      <div class="ep-card ep-section">
        <h6 class="fw-bold mb-2">Email</h6>
        <input type="email" name="email" class="ep-input" value="{{ old('email', auth()->user()->email) }}" required>
      </div>
    </div>

    {{-- INSTITUSI --}}
    <div class="col-md-6">
      <div class="ep-card ep-section">
        <h6 class="fw-bold mb-2">Institusi</h6>

        <select name="institution" class="ep-input" required>
          <option value="{{ auth()->user()->institution }}" selected>{{ auth()->user()->institution ?: 'Pilih institusi' }}</option>

          @php
            $institutions = [
                'Universitas Indonesia',
                'Institut Teknologi Bandung',
                'Universitas Gadjah Mada',
                'Universitas Brawijaya',
                'Lainnya'
            ];
          @endphp

          @foreach($institutions as $item)
            @if($item !== auth()->user()->institution)
              <option value="{{ $item }}">{{ $item }}</option>
            @endif
          @endforeach
        </select>
      </div>
    </div>

    {{-- INTEREST FIELD --}}
    <div class="col-md-6">
      <div class="ep-card ep-section">
        <h6 class="fw-bold mb-2">Interest Field</h6>

        <select name="interest_field" class="ep-input" required>
          <option value="{{ auth()->user()->interest_field }}" selected>{{ auth()->user()->interest_field ?: 'Pilih interest field' }}</option>

          @php
            $interests = [
                'Teknologi',
                'Bisnis',
                'Ekonomi',
                'Sastra',
                'Ilmu Budaya',
                'Ilmu Politik'
            ];
          @endphp

          @foreach($interests as $item)
            @if($item !== auth()->user()->interest_field)
              <option value="{{ $item }}">{{ $item }}</option>
            @endif
          @endforeach
        </select>
      </div>
    </div>

    {{-- UBAH PASSWORD (BARU DITAMBAHKAN) --}}
    <div class="col-12">
      <div class="ep-card ep-section">
        <div class="d-flex justify-content-between align-items-center">
          <h6 class="fw-bold mb-0">Ubah Password</h6>
          <button type="button" id="ep-toggle-password" class="ep-toggle-btn">Tampilkan</button>
        </div>

        <div id="ep-password-area" style="display:none; margin-top:12px;">
          <div class="mb-2">
            <label class="form-label">Password Saat Ini</label>
            <input type="password" name="current_password" id="ep-current-password" class="ep-input" placeholder="Masukkan password saat ini">
          </div>

          <div class="mb-2">
            <label class="form-label">Password Baru</label>
            <input type="password" name="password" id="ep-new-password" class="ep-input" placeholder="Minimal 8 karakter">
          </div>

          <div class="mb-2">
            <label class="form-label">Konfirmasi Password Baru</label>
            <input type="password" name="password_confirmation" id="ep-new-password-confirm" class="ep-input" placeholder="Ketik ulang password baru">
          </div>

          <div id="ep-pass-msg" class="ep-pass-msg text-muted"></div>
        </div>
      </div>
    </div>

    {{-- ACTIONS --}}
    <div class="col-12 d-flex justify-content-between align-items-center mt-2">

      <div>
        <a href="{{ route('dashboard') }}" class="btn btn-outline-secondary ep-btn">Kembali</a>
      </div>

      <div class="d-flex gap-2">
        <button type="submit" class="btn btn-primary ep-btn">Simpan Perubahan</button>
      </div>

    </div>

  </form>

  {{-- DELETE ACCOUNT --}}
  <div class="mt-4">
    <div class="ep-card ep-danger-card p-3">
      <div class="d-flex justify-content-between align-items-start flex-wrap">
        <div>
          <h6 class="fw-bold text-danger mb-1">Hapus Akun</h6>
          <p class="mb-0" style="color:#7a1f24;">Menghapus akun akan menghilangkan semua data profil kamu. Tindakan ini tidak dapat dibatalkan.</p>
        </div>

        <div class="mt-3 mt-sm-0">
          <form method="POST" action="{{ route('profile.destroy') }}" onsubmit="return confirm('Yakin ingin menghapus akun? Tindakan ini tidak dapat dibatalkan.');">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger ep-btn">Hapus Akun</button>
          </form>
        </div>
      </div>
    </div>
  </div>

</div>

<script>
  (function(){
    // image preview
    const input = document.getElementById('ep-profile-photo');
    const preview = document.getElementById('ep-avatar-preview');
    const nameEl = document.getElementById('ep-file-name');
    const label = document.querySelector('.ep-file-label');

    label && label.addEventListener('click', () => input && input.click());

    if (input) {
      input.addEventListener('change', function(e){
        const file = this.files && this.files[0];
        if (!file) {
          nameEl.textContent = '';
          return;
        }

        // show filename & size (KB)
        const sizeKB = Math.round(file.size / 1024);
        nameEl.textContent = `${file.name} • ${sizeKB} KB`;

        // validate size
        const maxBytes = 2.5 * 1024 * 1024;
        if (file.size > maxBytes) {
          alert('File terlalu besar. Maksimum 2.5MB.');
          this.value = '';
          nameEl.textContent = '';
          return;
        }

        // preview
        const reader = new FileReader();
        reader.onload = function(ev) {
          preview.src = ev.target.result;
        };
        reader.readAsDataURL(file);
      });
    }

    const toggleBtn = document.getElementById('ep-toggle-password');
    const passArea = document.getElementById('ep-password-area');
    const newPw = document.getElementById('ep-new-password');
    const newPwC = document.getElementById('ep-new-password-confirm');
    const currentPw = document.getElementById('ep-current-password');
    const passMsg = document.getElementById('ep-pass-msg');

    if(toggleBtn){
      toggleBtn.addEventListener('click', function(){
        if(passArea.style.display === 'none' || passArea.style.display === ''){
          passArea.style.display = 'block';
          toggleBtn.textContent = 'Sembunyikan';
        } else {
          passArea.style.display = 'none';
          toggleBtn.textContent = 'Tampilkan';
          if(newPw) newPw.value = '';
          if(newPwC) newPwC.value = '';
          if(currentPw) currentPw.value = '';
          passMsg.textContent = '';
          passMsg.className = 'ep-pass-msg text-muted';
        }
      });
    }

    // validation messages
    [newPw, newPwC].forEach(el=>{
      if(!el) return;
      el.addEventListener('input', function(){
        const a = newPw.value || '';
        const b = newPwC.value || '';

        if(!a && !b){
          passMsg.textContent = 'Isi field password hanya jika ingin mengganti password.';
          passMsg.className = 'ep-pass-msg text-muted';
          return;
        }

        if(a.length && a.length < 8){
          passMsg.textContent = 'Password minimal 8 karakter.';
          passMsg.className = 'ep-pass-msg text-danger';
          return;
        }

        if(a && b && a !== b){
          passMsg.textContent = 'Password konfirmasi tidak cocok.';
          passMsg.className = 'ep-pass-msg text-danger';
          return;
        }

        if(a && b && a === b){
          passMsg.textContent = 'Password valid dan cocok. Setelah submit, server akan mengganti password.';
          passMsg.className = 'ep-pass-msg text-success';
          return;
        }

        passMsg.textContent = '';
        passMsg.className = 'ep-pass-msg text-muted';
      });
    });

    const form = document.getElementById('ep-form');
    form && form.addEventListener('submit', function(e){
      const a = newPw && newPw.value;
      const b = newPwC && newPwC.value;
      const c = currentPw && currentPw.value;

      if( (a || b) && !c ){
        e.preventDefault();
        alert('Masukkan password saat ini untuk mengganti password.');
        currentPw && currentPw.focus();
        return false;
      }

      if(a || b){
        if(a.length < 8){ e.preventDefault(); alert('Password baru minimal 8 karakter.'); return false; }
        if(a !== b){ e.preventDefault(); alert('Konfirmasi password tidak cocok.'); return false; }
      }

      return true;
    });

  })();
</script>

@endsection
