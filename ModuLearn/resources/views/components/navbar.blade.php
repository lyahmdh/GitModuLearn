<nav class="navbar navbar-expand-lg bg-white shadow-sm fixed-top">
    <div class="container">
        <a class="navbar-brand fs-4 fw-bold text-primary" href="{{ url('/') }}">
            ModuLearn
        </a>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarNav">

            <ul class="navbar-nav ms-auto">

                <li class="nav-item">
                    <a class="nav-link" href="{{ url('/') }}">Beranda</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="{{ url('/pelajaran') }}">Pelajaran</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="#tentangKami">Tentang Kami</a>
                </li>

                @guest
                    <li class="nav-item">
                        <a class="btn btn-primary px-3 ms-2" href="{{ route('login') }}">Login</a>
                    </li>
                @endguest

                @auth
                    <li class="nav-item">
                        <a class="btn btn-outline-primary px-3 ms-2" href="{{ route('dashboard') }}">
                            Dashboard
                        </a>
                    </li>
                @endauth

            </ul>

        </div>
    </div>
</nav>

<div style="margin-bottom: 90px;"></div>
