<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>@yield('title', 'Dashboard Customer') - Undangan Digital</title>

    {{-- Bootstrap 4 --}}
    <link rel="stylesheet"
          href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">

    {{-- Font Awesome --}}
    <link rel="stylesheet"
          href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

    <style>
        :root {
            --navy: #172b4d;
            --navy-light: #243b61;
            --primary: #4169a1;
            --background: #f5f7fb;
            --text: #263449;
            --muted: #8792a2;
        }

        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            background: var(--background);
            color: var(--text);
            font-family: "Segoe UI", Arial, sans-serif;
        }

        .customer-wrapper {
            min-height: 100vh;
        }

        /* SIDEBAR */
        .customer-sidebar {
            width: 250px;
            position: fixed;
            top: 0;
            bottom: 0;
            left: 0;
            z-index: 1000;
            background: var(--navy);
            color: #fff;
            padding: 25px 16px;
            overflow-y: auto;
            transition: transform .25s ease;
        }

        .customer-brand {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 0 10px 28px;
            color: #fff;
            text-decoration: none !important;
        }

        .customer-brand-icon {
            width: 42px;
            height: 42px;
            border-radius: 12px;
            background: var(--navy-light);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 19px;
        }

        .customer-brand strong {
            display: block;
            font-size: 16px;
        }

        .customer-brand small {
            display: block;
            color: #aab8ce;
            font-size: 11px;
            margin-top: 3px;
        }

        .sidebar-label {
            color: #91a3bf;
            font-size: 10px;
            font-weight: 700;
            letter-spacing: 1.5px;
            padding: 12px 12px;
        }

        .customer-menu {
            list-style: none;
            padding: 0;
            margin: 0;
        }

        .customer-menu li {
            margin-bottom: 6px;
        }

        .customer-menu a,
        .customer-menu button {
            width: 100%;
            display: flex;
            align-items: center;
            gap: 13px;
            padding: 12px 14px;
            border: 0;
            border-radius: 8px;
            background: transparent;
            color: #c2cee0;
            text-decoration: none;
            text-align: left;
            font-size: 13px;
            transition: .2s;
        }

        .customer-menu a i,
        .customer-menu button i {
            width: 18px;
            text-align: center;
        }

        .customer-menu a:hover,
        .customer-menu button:hover,
        .customer-menu a.active {
            background: var(--navy-light);
            color: #fff;
        }

        .sidebar-bottom {
            margin-top: 30px;
            padding-top: 18px;
            border-top: 1px solid rgba(255,255,255,.12);
        }

        /* MAIN */
        .customer-main {
            margin-left: 250px;
            min-height: 100vh;
        }

        .customer-topbar {
            height: 76px;
            background: #fff;
            border-bottom: 1px solid #e9edf3;
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 0 32px;
        }

        .topbar-title {
            font-size: 15px;
            font-weight: 600;
        }

        .customer-profile {
            display: flex;
            align-items: center;
            gap: 11px;
        }

        .profile-avatar {
            width: 38px;
            height: 38px;
            border-radius: 50%;
            background: #e7edf7;
            color: var(--navy);
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 700;
        }

        .profile-name {
            font-size: 13px;
            font-weight: 600;
        }

        .profile-role {
            color: var(--muted);
            font-size: 11px;
        }

        .customer-content {
            padding: 30px 32px;
        }

        .customer-footer {
            padding: 20px 32px;
            color: var(--muted);
            font-size: 12px;
        }

        .sidebar-toggle {
            display: none;
            border: 0;
            background: transparent;
            color: var(--navy);
            font-size: 20px;
        }

        .sidebar-overlay {
            display: none;
        }

        @media (max-width: 768px) {
            .customer-sidebar {
                transform: translateX(-100%);
            }

            .customer-sidebar.open {
                transform: translateX(0);
            }

            .customer-main {
                margin-left: 0;
            }

            .customer-topbar {
                height: 66px;
                padding: 0 16px;
            }

            .customer-content {
                padding: 22px 16px;
            }

            .customer-footer {
                padding: 18px 16px;
            }

            .sidebar-toggle {
                display: inline-block;
                margin-right: 12px;
            }

            .sidebar-overlay.show {
                display: block;
                position: fixed;
                inset: 0;
                z-index: 999;
                background: rgba(0,0,0,.4);
            }

            .topbar-left {
                display: flex;
                align-items: center;
            }
        }
    </style>

    @stack('styles')
</head>

<body>

<div class="customer-wrapper">

    {{-- SIDEBAR --}}
    <aside class="customer-sidebar" id="customerSidebar">

        <a href="{{ route('customer.dashboard') }}"
           class="customer-brand">
            <div class="customer-brand-icon">
                <i class="fas fa-envelope-open-text"></i>
            </div>

            <div>
                <strong>Undangan Digital</strong>
                <small>Customer Dashboard</small>
            </div>
        </a>

        <div class="sidebar-label">MENU UTAMA</div>

        <ul class="customer-menu">
            <li>
                <a href="{{ route('customer.dashboard') }}"
                   class="{{ request()->routeIs('customer.dashboard') ? 'active' : '' }}">
                    <i class="fas fa-th-large"></i>
                    Dashboard
                </a>
            </li>

            <li>
                <a href="{{ route('customer.invitations') }}"
                class="{{ request()->routeIs('customer.invitations.*') ? 'active' : '' }}">
                    <i class="fas fa-envelope"></i>
                    Undangan Saya
                </a>
            </li>

            <li>
                <a href="{{ route('customer.guests') }}" 
                class="{{ request()->routeIs('customer.guests.*') ? 'active' : '' }}">
                    <i class="fas fa-users"></i>
                    Daftar Tamu
                </a>
            </li>

            <li>
                <a href="{{ route('customer.rsvp') }}">
                    <i class="fas fa-chart-bar"></i>
                    Rekap RSVP
                </a>
            </li>
        </ul>

        <div class="sidebar-label mt-4">AKUN</div>

        <ul class="customer-menu">
            <li>
                <a href="#">
                    <i class="fas fa-user-circle"></i>
                    Profil Saya
                </a>
            </li>
        </ul>

        <div class="sidebar-bottom">
            <ul class="customer-menu">
                <li>
                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button type="submit">
                            <i class="fas fa-sign-out-alt"></i>
                            Keluar
                        </button>
                    </form>
                </li>
            </ul>
        </div>

    </aside>

    <div class="sidebar-overlay" id="sidebarOverlay"></div>

    {{-- MAIN CONTENT --}}
    <main class="customer-main">

        <header class="customer-topbar">
            <div class="topbar-left">
                <button class="sidebar-toggle"
                        id="sidebarToggle"
                        type="button"
                        aria-label="Buka menu">
                    <i class="fas fa-bars"></i>
                </button>

                <span class="topbar-title">
                    @yield('page-heading', 'Dashboard')
                </span>
            </div>

            <div class="customer-profile">
                <div class="profile-avatar">
                    {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                </div>

                <div>
                    <div class="profile-name">
                        {{ auth()->user()->name }}
                    </div>
                    <div class="profile-role">Customer</div>
                </div>
            </div>
        </header>

        <section class="customer-content">
            @yield('content')
        </section>

        <footer class="customer-footer">
            &copy; {{ date('Y') }} Undangan Digital. All rights reserved.
        </footer>

    </main>

</div>

<script>
    const sidebar = document.getElementById('customerSidebar');
    const sidebarToggle = document.getElementById('sidebarToggle');
    const sidebarOverlay = document.getElementById('sidebarOverlay');

    function closeSidebar() {
        sidebar.classList.remove('open');
        sidebarOverlay.classList.remove('show');
    }

    if (sidebarToggle) {
        sidebarToggle.addEventListener('click', function () {
            sidebar.classList.toggle('open');
            sidebarOverlay.classList.toggle('show');
        });
    }

    if (sidebarOverlay) {
        sidebarOverlay.addEventListener('click', closeSidebar);
    }
</script>

@stack('scripts')

</body>
</html>