<nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm fixed-top">
    <div class="container">

        <!-- Logo -->
        <a class="navbar-brand fw-bold" href="{{ url('/') }}">
            ModuLearn
        </a>

        <!-- Toggler mobile -->
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
            data-bs-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false"
            aria-label="{{ __('Toggle navigation') }}">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">

            <!-- Left Side Navbar -->
            <ul class="navbar-nav me-auto">
                <li class="nav-item">
                    <a class="nav-link fw-semibold" href="{{ url('/') }}">Home</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link fw-semibold" href="{{ url('/pelajaran') }}">Pelajaran</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link fw-semibold" href="#tentangKami">Tentang Kami</a>
                </li>
            </ul>

            <!-- Right Side Navbar -->
            <ul class="navbar-nav ms-auto">

                {{-- ========== GUEST (Belum Login) ========== --}}
                @guest
                    <li class="nav-item">
                        <a class="btn btn-primary px-3 fw-semibold" href="{{ route('login') }}">
                            Login
                        </a>
                    </li>
                @endguest


                {{-- ========== AUTH (Sudah Login) ========== --}}
                @auth
                    <li class="nav-item dropdown">
                        <button class="btn btn-outline-primary dropdown-toggle fw-semibold"
                            id="navbarDropdown" role="button"
                            data-bs-toggle="dropdown" aria-expanded="false">

                            {{ Auth::user()->name }}
                        </button>

                        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">

                            {{-- Dashboard --}}
                            <li>
                                <a class="dropdown-item" href="{{ route('dashboard') }}">
                                    Dashboard
                                </a>
                            </li>

                            {{-- Switch Role (hanya mentor/mentee, bukan admin) --}}
                            @if (Auth::user()->role === 'mentor' || Auth::user()->role === 'mentee')
                                <li>
                                    <a class="dropdown-item" href="{{ route('switch.role') }}">
                                        Switch Role
                                    </a>
                                </li>
                            @endif

                            <li><hr class="dropdown-divider"></li>

                            {{-- Logout --}}
                            <li>
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button class="dropdown-item text-danger">
                                        Logout
                                    </button>
                                </form>
                            </li>

                        </ul>
                    </li>
                @endauth

            </ul>

        </div>
    </div>
</nav>

<div style="height: 70px;"></div> <!-- Spacer supaya konten tidak tertutup navbar -->
