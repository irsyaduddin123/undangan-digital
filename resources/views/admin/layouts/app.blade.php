<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>
        @yield('title', 'Admin Dashboard') - Undangan Digital
    </title>

    {{-- Bootstrap --}}
    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
        rel="stylesheet"
    >

    {{-- Bootstrap Icons --}}
    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css"
        rel="stylesheet"
    >

    <style>
        body {
            background-color: #f5f7fb;
            font-family: Arial, sans-serif;
        }

        .sidebar {
            width: 250px;
            min-height: 100vh;
            background-color: #0f172a;
            position: fixed;
            left: 0;
            top: 0;
            z-index: 1000;
        }

        .sidebar-brand {
            height: 70px;
            display: flex;
            align-items: center;
            padding: 0 20px;
            color: white;
            font-size: 20px;
            font-weight: bold;
            border-bottom: 1px solid rgba(255,255,255,0.1);
        }

        .sidebar-menu {
            padding: 20px 12px;
        }

        .sidebar-menu .menu-title {
            color: #94a3b8;
            font-size: 11px;
            font-weight: bold;
            margin: 20px 10px 8px;
            text-transform: uppercase;
        }

        .sidebar-menu a {
            display: flex;
            align-items: center;
            gap: 12px;
            color: #cbd5e1;
            text-decoration: none;
            padding: 11px 12px;
            margin-bottom: 4px;
            border-radius: 7px;
            transition: 0.2s;
        }

        .sidebar-menu a:hover,
        .sidebar-menu a.active {
            background-color: #1e293b;
            color: white;
        }

        .sidebar-menu i {
            font-size: 18px;
        }

        .main-content {
            margin-left: 250px;
            min-height: 100vh;
        }

        .top-navbar {
            height: 70px;
            background-color: white;
            border-bottom: 1px solid #e5e7eb;
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 0 30px;
        }

        .content-wrapper {
            padding: 30px;
        }

        .page-title {
            font-size: 24px;
            font-weight: 700;
            color: #0f172a;
        }

        .page-subtitle {
            color: #64748b;
            font-size: 14px;
        }

        @media (max-width: 768px) {
            .sidebar {
                width: 220px;
                margin-left: -220px;
            }

            .main-content {
                margin-left: 0;
            }
        }
    </style>

    @stack('styles')
</head>

<body>

    {{-- Sidebar --}}
    @include('admin.layouts.sidebar')

    <div class="main-content">

        {{-- Navbar --}}
        @include('admin.layouts.navbar')

        {{-- Main Content --}}
        <main class="content-wrapper">

            @yield('content')

        </main>

    </div>

    {{-- Bootstrap JS --}}
    <script
        src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js">
    </script>

    @stack('scripts')

</body>

</html>
