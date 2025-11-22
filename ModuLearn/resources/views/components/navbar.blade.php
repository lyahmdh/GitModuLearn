<nav class="main-header navbar navbar-expand navbar-light bg-white border-bottom">
    <div class="container-fluid">

        {{-- Left navbar links --}}
        <ul class="navbar-nav">
            {{-- Sidebar toggle for mentor/mentee dashboard --}}
            <li class="nav-item d-lg-none">
                <a class="nav-link" data-widget="pushmenu" href="#" role="button">
                    <i class="bi bi-list fs-4"></i>
                </a>
            </li>

            <li class="nav-item">
                <a href="{{ url('/') }}" class="nav-link fw-bold">Modulearn</a>
            </li>
        </ul>

        {{-- Right navbar links --}}
        <ul class="navbar-nav ms-auto">
            @guest
                <li class="nav-item"><a href="{{ route('login') }}" class="nav-link">Login</a></li>
                <li class="nav-item"><a href="{{ route('register') }}" class="nav-link">Register</a></li>
            @else
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" data-bs-toggle="dropdown" href="#">
                        <i class="bi bi-person-circle me-1"></i>
                        {{ Auth::user()->name }}
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end">
                        <li><a href="{{ route('profile.edit') }}" class="dropdown-item">Profile</a></li>
                        <li>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button class="dropdown-item text-danger">Logout</button>
                            </form>
                        </li>
                    </ul>
                </li>
            @endguest
        </ul>

    </div>
</nav>
