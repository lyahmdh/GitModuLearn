<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel - ModuLearn</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body { background-color: #eef1f4; }
        .sidebar {
            height: 100vh;
            width: 240px;
            background: #1f2937;
            padding-top: 30px;
            position: fixed;
        }
        .sidebar a {
            padding: 14px 20px;
            display: block;
            color: white;
            text-decoration: none;
        }
        .sidebar a:hover { background-color: #374151; }
        .content {
            margin-left: 240px;
            padding: 20px;
        }
    </style>
</head>

<body>

    <div class="sidebar">
        <h5 class="text-white text-center mb-4">Admin Panel</h5>

        <a href="{{ route('admin.dashboard') }}">Dashboard</a>
        <a href="{{ route('admin.categories.index') }}">Manage Categories</a>
        <a href="{{ route('admin.modules.index') }}">Manage Modules</a>
        <a href="{{ route('admin.users.index') }}">User List</a>
        <a href="{{ route('admin.users.pending') }}">Pending Mentor Approval</a>
        <a href="{{ route('logout') }}">Logout</a>
    </div>

    <div class="content">
        @yield('content')
    </div>

</body>
</html>
