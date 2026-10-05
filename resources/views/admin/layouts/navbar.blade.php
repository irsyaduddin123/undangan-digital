<nav class="top-navbar">

    {{-- Left Side --}}
    <div class="navbar-left">

        {{-- Mobile Toggle --}}
        <button type="button"
                class="sidebar-toggle"
                onclick="toggleSidebar()">
            <i class="bi bi-list"></i>
        </button>

        <div class="navbar-page">
            <span class="navbar-page-title">
                @yield('page-title', 'Dashboard')
            </span>

            <span class="navbar-page-subtitle">
                / Admin
            </span>
        </div>

    </div>


    {{-- Right Side --}}
    <div class="navbar-right">

        {{-- Notification --}}
        <div class="navbar-notification">

            <button type="button"
                    class="notification-button"
                    data-bs-toggle="dropdown"
                    aria-expanded="false">

                <i class="bi bi-bell"></i>

                <span class="notification-badge">
                    0
                </span>

            </button>

            <ul class="dropdown-menu dropdown-menu-end notification-dropdown">

                <li class="notification-header">
                    <strong>Notifikasi</strong>
                    <span>0 Baru</span>
                </li>

                <li>
                    <div class="empty-notification">

                        <i class="bi bi-bell-slash"></i>

                        <p>
                            Tidak ada notifikasi
                        </p>

                    </div>
                </li>

            </ul>

        </div>


        {{-- Divider --}}
        <div class="navbar-divider"></div>


        {{-- Admin Profile --}}
        <div class="dropdown">

            <button type="button"
                    class="admin-profile"
                    data-bs-toggle="dropdown"
                    aria-expanded="false">

                {{-- Avatar --}}
                <div class="admin-avatar">
                    <i class="bi bi-person-fill"></i>
                </div>


                {{-- Admin Info --}}
                <div class="admin-info">

                    <span class="admin-name">
                        {{ auth()->user()->name ?? 'Administrator' }}
                    </span>

                    <span class="admin-role">
                        Administrator
                    </span>

                </div>


                <i class="bi bi-chevron-down profile-arrow"></i>

            </button>


            {{-- Profile Dropdown --}}
            <ul class="dropdown-menu dropdown-menu-end profile-dropdown">

                <li class="profile-dropdown-header">

                    <div class="profile-avatar-large">
                        <i class="bi bi-person-fill"></i>
                    </div>

                    <div>
                        <strong>
                            {{ auth()->user()->name ?? 'Administrator' }}
                        </strong>

                        <small>
                            {{ auth()->user()->email ?? 'admin@example.com' }}
                        </small>
                    </div>

                </li>

                <li>
                    <hr class="dropdown-divider">
                </li>

                <li>
                    <a class="dropdown-item" href="#">
                        <i class="bi bi-person"></i>
                        Profil Saya
                    </a>
                </li>

                <li>
                    <a class="dropdown-item" href="#">
                        <i class="bi bi-gear"></i>
                        Pengaturan
                    </a>
                </li>

                <li>
                    <hr class="dropdown-divider">
                </li>

                {{-- Logout --}}
                <li>

                    <form method="POST"
                          action="{{ route('logout') }}">

                        @csrf

                        <button type="submit"
                                class="dropdown-item logout-item">

                            <i class="bi bi-box-arrow-right"></i>

                            Logout

                        </button>

                    </form>

                </li>

            </ul>

        </div>

    </div>

</nav>


<style>

    /* ========================================
       TOP NAVBAR
    ======================================== */

    .top-navbar {

        height: 70px;

        background: #ffffff;

        border-bottom: 1px solid #e5e7eb;

        display: flex;

        align-items: center;

        justify-content: space-between;

        padding: 0 30px;

        position: sticky;

        top: 0;

        z-index: 900;

    }


    /* ========================================
       LEFT
    ======================================== */

    .navbar-left {

        display: flex;

        align-items: center;

        gap: 15px;

    }


    .sidebar-toggle {

        width: 38px;

        height: 38px;

        border: none;

        background: #f1f5f9;

        color: #334155;

        border-radius: 8px;

        display: flex;

        align-items: center;

        justify-content: center;

        font-size: 20px;

        cursor: pointer;

        transition: 0.2s;

    }


    .sidebar-toggle:hover {

        background: #e2e8f0;

        color: #1d4ed8;

    }


    .navbar-page {

        display: flex;

        align-items: center;

        gap: 7px;

    }


    .navbar-page-title {

        color: #0f172a;

        font-size: 16px;

        font-weight: 700;

    }


    .navbar-page-subtitle {

        color: #94a3b8;

        font-size: 13px;

    }


    /* ========================================
       RIGHT
    ======================================== */

    .navbar-right {

        display: flex;

        align-items: center;

        gap: 18px;

    }


    /* ========================================
       NOTIFICATION
    ======================================== */

    .navbar-notification {

        position: relative;

    }


    .notification-button {

        width: 40px;

        height: 40px;

        border: none;

        background: transparent;

        color: #475569;

        border-radius: 8px;

        display: flex;

        align-items: center;

        justify-content: center;

        font-size: 19px;

        cursor: pointer;

        position: relative;

        transition: 0.2s;

    }


    .notification-button:hover {

        background: #f1f5f9;

        color: #1d4ed8;

    }


    .notification-badge {

        position: absolute;

        top: 3px;

        right: 2px;

        min-width: 16px;

        height: 16px;

        padding: 0 4px;

        background: #ef4444;

        color: white;

        border-radius: 20px;

        font-size: 9px;

        font-weight: 700;

        display: flex;

        align-items: center;

        justify-content: center;

    }


    /* ========================================
       NOTIFICATION DROPDOWN
    ======================================== */

    .notification-dropdown {

        width: 310px;

        padding: 0;

        border: none;

        border-radius: 10px;

        box-shadow: 0 10px 35px rgba(15, 23, 42, 0.15);

        overflow: hidden;

    }


    .notification-header {

        padding: 15px 18px;

        display: flex;

        align-items: center;

        justify-content: space-between;

        border-bottom: 1px solid #e5e7eb;

    }


    .notification-header strong {

        color: #0f172a;

        font-size: 14px;

    }


    .notification-header span {

        color: #1d4ed8;

        font-size: 11px;

        font-weight: 600;

    }


    .empty-notification {

        text-align: center;

        padding: 30px 15px;

        color: #94a3b8;

    }


    .empty-notification i {

        font-size: 30px;

        display: block;

        margin-bottom: 8px;

    }


    .empty-notification p {

        margin: 0;

        font-size: 13px;

    }


    /* ========================================
       DIVIDER
    ======================================== */

    .navbar-divider {

        width: 1px;

        height: 32px;

        background: #e2e8f0;

    }


    /* ========================================
       ADMIN PROFILE
    ======================================== */

    .admin-profile {

        border: none;

        background: transparent;

        display: flex;

        align-items: center;

        gap: 10px;

        cursor: pointer;

        padding: 4px;

    }


    .admin-avatar {

        width: 38px;

        height: 38px;

        border-radius: 50%;

        background: #1d4ed8;

        color: white;

        display: flex;

        align-items: center;

        justify-content: center;

        font-size: 17px;

    }


    .admin-info {

        display: flex;

        flex-direction: column;

        text-align: left;

        line-height: 1.3;

    }


    .admin-name {

        color: #0f172a;

        font-size: 13px;

        font-weight: 700;

    }


    .admin-role {

        color: #94a3b8;

        font-size: 10px;

        margin-top: 2px;

    }


    .profile-arrow {

        color: #94a3b8;

        font-size: 12px;

        margin-left: 3px;

    }


    /* ========================================
       PROFILE DROPDOWN
    ======================================== */

    .profile-dropdown {

        width: 260px;

        padding: 8px;

        border: none;

        border-radius: 10px;

        box-shadow: 0 10px 35px rgba(15, 23, 42, 0.15);

    }


    .profile-dropdown-header {

        display: flex;

        align-items: center;

        gap: 10px;

        padding: 10px;

    }


    .profile-avatar-large {

        width: 42px;

        height: 42px;

        flex-shrink: 0;

        background: #1d4ed8;

        color: white;

        border-radius: 50%;

        display: flex;

        align-items: center;

        justify-content: center;

        font-size: 18px;

    }


    .profile-dropdown-header strong {

        display: block;

        color: #0f172a;

        font-size: 13px;

    }


    .profile-dropdown-header small {

        display: block;

        color: #94a3b8;

        font-size: 10px;

        margin-top: 2px;

        max-width: 170px;

        overflow: hidden;

        text-overflow: ellipsis;

    }


    .profile-dropdown .dropdown-item {

        border-radius: 7px;

        padding: 9px 10px;

        color: #475569;

        font-size: 13px;

        display: flex;

        align-items: center;

        gap: 10px;

    }


    .profile-dropdown .dropdown-item i {

        width: 18px;

        font-size: 16px;

    }


    .profile-dropdown .dropdown-item:hover {

        background: #f1f5f9;

        color: #1d4ed8;

    }


    .profile-dropdown .logout-item:hover {

        color: #dc2626;

        background: #fef2f2;

    }


    /* ========================================
       MOBILE
    ======================================== */

    @media (max-width: 768px) {

        .top-navbar {

            padding: 0 15px;

        }


        .admin-info,

        .profile-arrow {

            display: none;

        }


        .navbar-page-subtitle {

            display: none;

        }

    }

</style>


<script>

    function toggleSidebar() {

        const sidebar = document.querySelector('.sidebar');

        const mainContent = document.querySelector('.main-content');

        if (!sidebar) return;

        if (window.innerWidth <= 768) {

            if (sidebar.style.marginLeft === '0px') {

                sidebar.style.marginLeft = '-230px';

            } else {

                sidebar.style.marginLeft = '0px';

            }

        } else {

            if (sidebar.style.width === '0px') {

                sidebar.style.width = '250px';

                mainContent.style.marginLeft = '250px';

            } else {

                sidebar.style.width = '0px';

                mainContent.style.marginLeft = '0px';

            }

        }

    }

</script>
