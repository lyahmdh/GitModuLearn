<aside class="main-sidebar sidebar-dark-primary elevation-4">

    <a href="{{ route('admin.dashboard') }}" class="brand-link text-center">
        <span class="brand-text fw-bold">Admin Panel</span>
    </a>

    <div class="sidebar">

        <nav class="mt-3">
            <ul class="nav nav-pills nav-sidebar flex-column" role="menu">

                <li class="nav-item">
                    <a href="{{ route('admin.dashboard') }}" class="nav-link">
                        <i class="bi bi-speedometer2 nav-icon"></i>
                        <p>Dashboard</p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ route('admin.verification.index') }}" class="nav-link">
                        <i class="bi bi-person-check nav-icon"></i>
                        <p>Verifikasi Mentor</p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ route('admin.categories.index') }}" class="nav-link">
                        <i class="bi bi-tags nav-icon"></i>
                        <p>Kategori Modul</p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ route('admin.modules.index') }}" class="nav-link">
                        <i class="bi bi-journal-text nav-icon"></i>
                        <p>Kelola Modul</p>
                    </a>
                </li>

            </ul>
        </nav>

    </div>
</aside>
