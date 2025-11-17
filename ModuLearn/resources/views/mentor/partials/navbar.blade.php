<nav class="navbar navbar-expand-lg bg-white border-bottom mb-3">
    <div class="container">

        <a class="navbar-brand fw-bold" href="{{ route('mentor.dashboard') }}">Modulearn Mentor</a>

        <ul class="navbar-nav ms-auto">

            <li class="nav-item me-2">
                <a href="{{ route('mentor.modules') }}" class="btn btn-outline-primary btn-sm">Modul Saya</a>
            </li>

            <li class="nav-item me-2">
                <a href="{{ route('switch.toMentee') }}" class="btn btn-outline-secondary btn-sm">Switch ke Mentee</a>
            </li>

            <li class="nav-item">
                <a href="{{ route('logout') }}" class="btn btn-danger btn-sm">Logout</a>
            </li>

        </ul>

    </div>
</nav>
