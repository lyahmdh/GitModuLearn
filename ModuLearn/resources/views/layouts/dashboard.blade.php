{{-- resources/views/layouts/dashboard.blade.php --}}
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title') - Dashboard</title>

    {{-- Bootstrap 5 --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    {{-- AdminLTE 4 (Bootstrap 5 version) --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/admin-lte@4.0.0/dist/css/adminlte.min.css">

    @stack('styles')
</head>
<body class="layout-fixed sidebar-expand-lg bg-body-tertiary">

<div class="wrapper">

    {{-- Navbar --}}
    <nav class="main-header navbar navbar-expand-lg navbar-light bg-white border-bottom">
        <div class="container-fluid">

            <button class="btn btn-outline-secondary me-2" data-lte-toggle="sidebar" type="button">
                <i class="fas fa-bars"></i>
            </button>

            <a class="navbar-brand fw-bold" href="#">Dashboard</a>

            <ul class="navbar-nav ms-auto">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" data-bs-toggle="dropdown" href="#">
                        {{ Auth::user()->name }}
                    </a>
                    <div class="dropdown-menu dropdown-menu-end">
                        <a href="{{ route('dashboard.mentee.profile') }}" class="dropdown-item">Profile</a>
                        <hr class="dropdown-divider">
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button class="dropdown-item text-danger">Logout</button>
                        </form>
                    </div>
                </li>
            </ul>

        </div>
    </nav>

    {{-- Sidebar --}}
    <aside class="main-sidebar sidebar-dark-primary elevation-4">   

        <div class="sidebar">

            <nav class="mt-3">
                <ul class="nav nav-pills nav-sidebar flex-column">

                    {{-- DASHBOARD MENU DYNAMIC BY ROLE --}}
                    @if(Auth::user()->role == 'mentee')
                        <li class="nav-item">
                            <a href="{{ route('dashboard.mentee') }}" class="nav-link">
                                <i class="nav-icon fas fa-home"></i>
                                <p>Profile</p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="{{ route('dashboard.mentee.likes') }}" class="nav-link">
                                <i class="nav-icon fas fa-heart"></i>
                                <p>Liked Modules</p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="{{ route('dashboard.mentee.progress') }}" class="nav-link">
                                <i class="nav-icon fas fa-chart-line"></i>
                                <p>Progress</p>
                            </a>
                        </li>
                    @endif


                    @if(Auth::user()->role == 'mentor')
                        <li class="nav-item">
                            <a href="{{ route('dashboard.mentor') }}" class="nav-link">
                                <i class="nav-icon fas fa-home"></i>
                                <p>Dashboard Mentor</p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="{{ route('dashboard.mentor.modules') }}" class="nav-link">
                                <i class="nav-icon fas fa-book"></i>
                                <p>My Modules</p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="{{ route('dashboard.mentor.likes') }}" class="nav-link">
                                <i class="nav-icon fas fa-thumbs-up"></i>
                                <p>Module Likes</p>
                            </a>
                        </li>
                    @endif


                    @if(Auth::user()->role == 'admin')
                        <li class="nav-item">
                            <a href="{{ route('dashboard.admin') }}" class="nav-link">
                                <i class="nav-icon fas fa-home"></i>
                                <p>Admin Dashboard</p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="{{ route('dashboard.admin.users') }}" class="nav-link">
                                <i class="nav-icon fas fa-users"></i>
                                <p>Users</p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="{{ route('dashboard.admin.modules') }}" class="nav-link">
                                <i class="nav-icon fas fa-book"></i>
                                <p>Modules</p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="{{ route('dashboard.admin.categories') }}" class="nav-link">
                                <i class="nav-icon fas fa-tags"></i>
                                <p>Categories</p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="{{ route('dashboard.admin.mentorApproval') }}" class="nav-link">
                                <i class="nav-icon fas fa-check-circle"></i>
                                <p>Mentor Approval</p>
                            </a>
                        </li>
                    @endif

                </ul>
            </nav>

        </div>
    </aside>

    {{-- Content --}}
    <div class="content-wrapper p-4">
        @yield('content')
    </div>

</div>

{{-- JS --}}
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/admin-lte@4.0.0/dist/js/adminlte.min.js"></script>

@stack('scripts')

</body>
</html>
