<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mentor Dashboard - ModuLearn</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body { background-color: #f5f7fa; }
        .sidebar {
            height: 100vh;
            width: 240px;
            background: #0d6efd;
            position: fixed;
            padding-top: 30px;
        }
        .sidebar a {
            padding: 14px 20px;
            color: white;
            display: block;
            text-decoration: none;
        }
        .sidebar a:hover { background-color: #0b5ed7; }
        .content {
            margin-left: 240px;
            padding: 20px;
        }
    </style>
</head>

<body>

    <div class="sidebar">
        <h5 class="text-white text-center mb-4">Mentor Panel</h5>

        <a href="{{ route('mentor.dashboard') }}">Dashboard</a>
        <a href="{{ route('mentor.modules.index') }}">My Modules</a>
        <a href="{{ route('mentor.profile') }}">Profile</a>
        <a href="{{ route('switchRole') }}">Switch to Mentee</a>
        <a href="{{ route('logout') }}">Logout</a>
    </div>

    <div class="content">
        @yield('content')
    </div>

</body>
</html>
