<aside class="main-sidebar sidebar-dark-primary elevation-4">

    <a href="{{ route('mentor.dashboard') }}" class="brand-link text-center">
        <span class="brand-text fw-bold">Mentor Panel</span>
    </a>

    <div class="sidebar">

        <nav class="mt-3">
            <ul class="nav nav-pills nav-sidebar flex-column" role="menu">

                <li class="nav-item">
                    <a href="{{ route('mentor.dashboard') }}" class="nav-link">
                        <i class="bi bi-speedometer2 nav-icon"></i>
                        <p>Dashboard</p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ route('mentor.modules.index') }}" class="nav-link">
                        <i class="bi bi-folder nav-icon"></i>
                        <p>Modul Saya</p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ route('mentee.progress.history') }}" class="nav-link">
                        <i class="bi bi-clock-history nav-icon"></i>
                        <p>Progress Saya</p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ route('mentee.likes.index') }}" class="nav-link">
                        <i class="bi bi-heart nav-icon"></i>
                        <p>Liked Modules</p>
                    </a>
                </li>

            </ul>
        </nav>

    </div>
</aside>
