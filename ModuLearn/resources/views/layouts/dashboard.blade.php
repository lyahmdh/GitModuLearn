<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'Dashboard - Modulearn' }}</title>

    {{-- Tailwind --}}
    <script src="https://cdn.tailwindcss.com"></script>

    {{-- Font Awesome --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

    @stack('styles')
</head>

<body class="bg-gray-100">

    {{-- =========================================================
        NAVBAR (Versi Landing Login)
    ========================================================== --}}
    <nav class="bg-white shadow-sm border-b">
        <div class="max-w-7xl mx-auto px-4 flex justify-between items-center h-16">


            {{-- Logo --}}
            <a href="
                    @if(Auth::check() && Auth::user()->role === 'admin')
                        {{ route('dashboard.admin') }}
                    @else
                        /landing-login
                    @endif"
                class="flex items-center font-bold text-lg"            >
                <img src="{{ asset('assets/logo.png') }}" alt="Modulearn" class="h-8 mr-2">
            </a>


            {{-- Nav Links --}}
            @if(auth()->user()->role === 'mentor' || auth()->user()->role === 'mentee')
                <div class="flex gap-6">
                    <a href="/landing-login" class="hover:text-blue-500">Beranda</a>
                    <a href="/pelajaran" class="hover:text-blue-500">Pelajaran</a>
                </div>
            @endif

            {{-- Profile + Logout --}}
            <div class="flex items-center gap-4">

                {{-- Logout --}}
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button class="px-4 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700">
                        Logout
                    </button>
                </form>

                {{-- Foto Profil --}}
                <a href="
                    @if(auth()->user()->role === 'admin')
                        {{ route('dashboard.admin') }}
                    @elseif(auth()->user()->role === 'mentor')
                        {{ route('dashboard.mentor') }}
                    @else
                        {{ route('dashboard.mentee') }}
                    @endif
                ">
                    <img src="{{ auth()->user()->profile_photo_path 
                            ? asset(auth()->user()->profile_photo_path) 
                            : asset('assets/default-profile.png') }}"
                        class="h-10 w-10 rounded-full object-cover">
                </a>
            </div>

        </div>
    </nav>



    {{-- =========================================================
        MAIN STRUCTURE (Sidebar + Content)
    ========================================================== --}}
    <div class="flex">

        {{-- ====================================================
            SIDEBAR MODERN TAILWIND (Dynamic Role)
        ===================================================== --}}
        <aside class="w-64 bg-white h-screen p-5 shadow sticky top-0">

            <nav class="space-y-2">

                {{-- ================= MENTEE ================= --}}
                @if(auth()->user()->role === 'mentee')

                    <a href="{{ route('dashboard.mentee.profile') }}"
                       class="flex items-center gap-3 p-3 rounded-lg hover:bg-blue-100">
                        <i class="fa fa-user text-gray-600"></i>
                        <span>Edit Profile</span>
                    </a>

                    <a href="{{ route('dashboard.mentee.likes') }}"
                       class="flex items-center gap-3 p-3 rounded-lg hover:bg-blue-100">
                        <i class="fa fa-heart text-gray-600"></i>
                        <span>Liked Modules</span>
                    </a>

                    <a href="{{ route('dashboard.mentee.progress') }}"
                       class="flex items-center gap-3 p-3 rounded-lg hover:bg-blue-100">
                        <i class="fa fa-chart-line text-gray-600"></i>
                        <span>Progress</span>
                    </a>

                    {{-- Ajukan Verifikasi Mentor --}}
                    <a href="{{ route('mentor.verification.form') }}"
                    class="flex items-center gap-3 p-3 rounded-lg bg-yellow-100 hover:bg-yellow-200 border border-yellow-300 rounded-lg font-medium">
                        <i class="fa fa-id-card text-yellow-700"></i>
                        <span>Ajukan Verifikasi Mentor</span>
                    </a>

                @endif


                {{-- ================= MENTOR ================= --}}
                @if(auth()->user()->role === 'mentor')

                    <a href="{{ route('dashboard.mentor.profile') }}"
                       class="flex items-center gap-3 p-3 rounded-lg hover:bg-blue-100">
                        <i class="fa fa-user text-gray-600"></i>
                        <span>Edit Profile</span>
                    </a>

                    <a href="{{ route('dashboard.mentor.likes') }}"
                       class="flex items-center gap-3 p-3 rounded-lg hover:bg-blue-100">
                       <i class="fa fa-thumbs-up text-gray-600"></i>
                        <span>Liked Modules</span>
                    </a>

                    <a href="{{ route('dashboard.mentor.progress') }}"
                       class="flex items-center gap-3 p-3 rounded-lg hover:bg-blue-100">
                        <i class="fa fa-chart-line text-gray-600"></i>
                        <span>Progress</span>
                    </a>                    

                    <a href="{{ route('dashboard.mentor.modules.my-modules') }}"
                       class="flex items-center gap-3 p-3 rounded-lg hover:bg-blue-100">
                        <i class="fa fa-book text-gray-600"></i>
                        <span>My Modules</span>
                    </a>

                @endif


                {{-- ================= ADMIN ================= --}}
                @if(auth()->user()->role === 'admin')

                    <a href="{{ route('dashboard.admin') }}"
                       class="flex items-center gap-3 p-3 rounded-lg hover:bg-blue-100">
                        <i class="fa fa-home text-gray-600"></i>
                        <span>Admin Dashboard</span>
                    </a>

                    <a href="{{ route('dashboard.admin.users') }}"
                       class="flex items-center gap-3 p-3 rounded-lg hover:bg-blue-100">
                        <i class="fa fa-users text-gray-600"></i>
                        <span>Users</span>
                    </a>

                    <a href="{{ route('dashboard.admin.modules') }}"
                       class="flex items-center gap-3 p-3 rounded-lg hover:bg-blue-100">
                        <i class="fa fa-book text-gray-600"></i>
                        <span>Modules</span>
                    </a>

                    <a href="{{ route('dashboard.admin.categories') }}"
                       class="flex items-center gap-3 p-3 rounded-lg hover:bg-blue-100">
                        <i class="fa fa-tags text-gray-600"></i>
                        <span>Categories</span>
                    </a>

                    <a href="{{ route('dashboard.admin.mentorApproval') }}"
                       class="flex items-center gap-3 p-3 rounded-lg hover:bg-blue-100">
                        <i class="fa fa-check-circle text-gray-600"></i>
                        <span>Mentor Approval</span>
                    </a>

                @endif

            </nav>

        </aside>


        {{-- ====================================================
            CONTENT AREA
        ===================================================== --}}
        <main class="flex-1 p-8">
            @yield('content')
        </main>

    </div>

    @stack('scripts')

</body>
</html>
