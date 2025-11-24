<nav class="main-header navbar navbar-expand navbar-white navbar-light shadow-sm">

    <!-- Left Navbar -->
    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link" data-widget="pushmenu" href="#"><i class="fas fa-bars"></i></a>
        </li>
        <li class="nav-item d-none d-sm-inline-block">
            <a href="/" class="nav-link">Home</a>
        </li>
    </ul>

    <!-- Right Navbar -->
    <ul class="navbar-nav ml-auto">

        <!-- Profile Dropdown -->
        <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" id="profileDropdown" role="button" data-bs-toggle="dropdown">
                {{ Auth::user()->name }}
            </a>
            <ul class="dropdown-menu dropdown-menu-end">
                <li><a class="dropdown-item" href="{{ route('profile.edit') }}">Edit Profile</a></li>
                <li>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button class="dropdown-item text-danger">Logout</button>
                    </form>
                </li>
            </ul>
        </li>

    </ul>

</nav>
