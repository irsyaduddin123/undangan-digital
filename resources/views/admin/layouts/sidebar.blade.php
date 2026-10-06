<aside class="sidebar">

    {{-- Brand --}}
    <div class="sidebar-brand">
        <div class="brand-icon">
            <i class="bi bi-envelope-heart-fill"></i>
        </div>

        <div>
            <div class="brand-title">Undangan</div>
            <div class="brand-subtitle">DIGITAL</div>
        </div>
    </div>


    {{-- Menu --}}
    <div class="sidebar-menu">

        {{-- MAIN --}}
        <div class="menu-title">
            MAIN MENU
        </div>

        <a href="{{ route('admin.dashboard') }}"
           class="{{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
            <i class="bi bi-grid-1x2-fill"></i>
            <span>Dashboard</span>
        </a>


        {{-- UNDANGAN --}}
        <div class="menu-title">
            UNDANGAN
        </div>

        <a href="{{ route('admin.invitations.index') }}">
            <i class="bi bi-envelope-paper-fill"></i>
            <span>Undangan</span>
        </a>

        <a href="{{ route('admin.templates.index') }}"
           class="{{ request()->routeIs('admin.templates.*') ? 'active' : '' }}">
            <i class="bi bi-palette-fill"></i>
            <span>Template</span>
        </a>


        {{-- TRANSAKSI --}}
        <div class="menu-title">
            TRANSAKSI
        </div>

        <a href="#">
            <i class="bi bi-box-seam-fill"></i>
            <span>Paket</span>
        </a>

        <a href="#">
            <i class="bi bi-cart-check-fill"></i>
            <span>Pesanan</span>

            {{-- Badge --}}
            <span class="menu-badge">
                0
            </span>
        </a>


        {{-- CUSTOMER --}}
        <div class="menu-title">
            CUSTOMER
        </div>

        <a href="#">
            <i class="bi bi-people-fill"></i>
            <span>Customer</span>
        </a>

        <a href="#">
            <i class="bi bi-chat-heart-fill"></i>
            <span>Buku Tamu</span>
        </a>


        {{-- SYSTEM --}}
        <div class="menu-title">
            SYSTEM
        </div>

        <a href="#">
            <i class="bi bi-gear-fill"></i>
            <span>Pengaturan</span>
        </a>

        <a href="#">
            <i class="bi bi-box-arrow-right"></i>
            <span>Logout</span>
        </a>

    </div>

</aside>


<style>

    /* ========================================
       SIDEBAR
    ======================================== */

    .sidebar {
        width: 250px;
        min-height: 100vh;
        background: #0b1736;
        position: fixed;
        left: 0;
        top: 0;
        z-index: 1000;

        box-shadow: 4px 0 15px rgba(0, 0, 0, 0.08);

        overflow-y: auto;
    }


    /* ========================================
       BRAND
    ======================================== */

    .sidebar-brand {
        height: 75px;

        display: flex;
        align-items: center;

        padding: 0 20px;

        border-bottom: 1px solid rgba(255, 255, 255, 0.08);

        gap: 12px;
    }


    .brand-icon {
        width: 40px;
        height: 40px;

        display: flex;
        align-items: center;
        justify-content: center;

        background: #1d4ed8;

        border-radius: 10px;

        color: white;

        font-size: 19px;

        box-shadow: 0 5px 15px rgba(29, 78, 216, 0.3);
    }


    .brand-title {
        color: white;

        font-size: 17px;

        font-weight: 700;

        line-height: 18px;
    }


    .brand-subtitle {
        color: #64748b;

        font-size: 9px;

        letter-spacing: 2px;

        font-weight: 600;

        margin-top: 3px;
    }


    /* ========================================
       MENU
    ======================================== */

    .sidebar-menu {
        padding: 18px 12px 30px;
    }


    .menu-title {
        color: #64748b;

        font-size: 10px;

        font-weight: 700;

        letter-spacing: 1px;

        margin:

        20px 10px 8px;
    }


    .menu-title:first-child {
        margin-top: 0;
    }


    .sidebar-menu a {
        position: relative;

        display: flex;

        align-items: center;

        gap: 12px;

        width: 100%;

        padding: 11px 12px;

        margin-bottom: 4px;

        border-radius: 8px;

        color: #aebbd0;

        text-decoration: none;

        font-size: 14px;

        font-weight: 500;

        transition: all 0.2s ease;
    }


    /* ICON */

    .sidebar-menu a i {
        width: 20px;

        font-size: 17px;

        text-align: center;

        color: #8291aa;

        transition: 0.2s;
    }


    /* HOVER */

    .sidebar-menu a:hover {
        background: #14244a;

        color: white;

        transform: translateX(2px);
    }


    .sidebar-menu a:hover i {
        color: #60a5fa;
    }


    /* ACTIVE */

    .sidebar-menu a.active {
        background: #1d4ed8;

        color: white;

        box-shadow:
            0 5px 12px rgba(29, 78, 216, 0.25);
    }


    .sidebar-menu a.active i {
        color: white;
    }


    /* ========================================
       BADGE
    ======================================== */

    .menu-badge {
        margin-left: auto;

        min-width: 22px;
        height: 22px;

        display: flex;

        align-items: center;
        justify-content: center;

        padding: 0 6px;

        background: #ef4444;

        color: white;

        border-radius: 20px;

        font-size: 10px;

        font-weight: 700;
    }


    /* ========================================
       SCROLLBAR
    ======================================== */

    .sidebar::-webkit-scrollbar {
        width: 4px;
    }

    .sidebar::-webkit-scrollbar-track {
        background: #0b1736;
    }

    .sidebar::-webkit-scrollbar-thumb {
        background: #1e3a70;

        border-radius: 10px;
    }


    /* ========================================
       MOBILE
    ======================================== */

    @media (max-width: 768px) {

        .sidebar {
            width: 230px;

            margin-left: -230px;

            transition: 0.3s;
        }

    }

</style>