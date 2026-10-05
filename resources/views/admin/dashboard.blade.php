@extends('admin.layouts.app')

@section('title', 'Dashboard')

@section('page-title', 'Dashboard')

@section('content')

    {{-- Page Header --}}
    <div class="mb-4">

        <h1 class="page-title mb-1">
            Dashboard
        </h1>

        <p class="page-subtitle mb-0">
            Selamat datang kembali,
            <strong>{{ auth()->user()->name ?? 'Admin' }}</strong>.
            Berikut ringkasan aplikasi undangan digital.
        </p>

    </div>


    {{-- STATISTICS --}}
    <div class="row g-4 mb-4">

        {{-- Customer --}}
        <div class="col-xl-3 col-md-6">

            <div class="dashboard-card">

                <div class="card-content">

                    <div>
                        <p class="card-label">
                            Total Customer
                        </p>

                        <h2 class="card-value">
                            {{ number_format($totalCustomer) }}
                        </h2>

                        <span class="card-description">
                            Customer terdaftar
                        </span>
                    </div>

                    <div class="card-icon blue">
                        <i class="bi bi-people-fill"></i>
                    </div>

                </div>

            </div>

        </div>


        {{-- Invitation --}}
        <div class="col-xl-3 col-md-6">

            <div class="dashboard-card">

                <div class="card-content">

                    <div>
                        <p class="card-label">
                            Total Undangan
                        </p>

                        <h2 class="card-value">
                            {{ number_format($totalInvitation) }}
                        </h2>

                        <span class="card-description">
                            Undangan dibuat
                        </span>
                    </div>

                    <div class="card-icon purple">
                        <i class="bi bi-envelope-paper-fill"></i>
                    </div>

                </div>

            </div>

        </div>


        {{-- Template --}}
        <div class="col-xl-3 col-md-6">

            <div class="dashboard-card">

                <div class="card-content">

                    <div>
                        <p class="card-label">
                            Total Template
                        </p>

                        <h2 class="card-value">
                            {{ number_format($totalTemplate) }}
                        </h2>

                        <span class="card-description">
                            Template tersedia
                        </span>
                    </div>

                    <div class="card-icon orange">
                        <i class="bi bi-palette-fill"></i>
                    </div>

                </div>

            </div>

        </div>


        {{-- Orders --}}
        <div class="col-xl-3 col-md-6">

            <div class="dashboard-card">

                <div class="card-content">

                    <div>
                        <p class="card-label">
                            Total Pesanan
                        </p>

                        <h2 class="card-value">
                            {{ number_format($totalOrder) }}
                        </h2>

                        <span class="card-description">
                            Semua pesanan
                        </span>
                    </div>

                    <div class="card-icon green">
                        <i class="bi bi-cart-check-fill"></i>
                    </div>

                </div>

            </div>

        </div>

    </div>


    {{-- SECOND ROW --}}
    <div class="row g-4 mb-4">

        {{-- Revenue --}}
        <div class="col-xl-8">

            <div class="dashboard-card revenue-card">

                <div class="revenue-content">

                    <div>

                        <p class="card-label">
                            Total Pendapatan
                        </p>

                        <h2 class="revenue-value">
                            Rp {{ number_format($totalRevenue, 0, ',', '.') }}
                        </h2>

                        <span class="revenue-description">
                            Total pembayaran yang telah diterima
                        </span>

                    </div>

                    <div class="revenue-icon">
                        <i class="bi bi-wallet2"></i>
                    </div>

                </div>

            </div>

        </div>


        {{-- Pending --}}
        <div class="col-xl-4">

            <div class="dashboard-card pending-card">

                <div class="pending-header">

                    <div>
                        <p class="card-label">
                            Pesanan Pending
                        </p>

                        <h2 class="card-value">
                            {{ number_format($pendingOrder) }}
                        </h2>
                    </div>

                    <div class="pending-icon">
                        <i class="bi bi-clock-history"></i>
                    </div>

                </div>

                <a href="#" class="pending-link">
                    Lihat pesanan pending
                    <i class="bi bi-arrow-right"></i>
                </a>

            </div>

        </div>

    </div>


    {{-- LATEST ORDERS --}}
    <div class="dashboard-card">

        <div class="table-header">

            <div>

                <h5>
                    Pesanan Terbaru
                </h5>

                <p>
                    Lima pesanan terakhir yang masuk
                </p>

            </div>

            <a href="#" class="view-all">
                Lihat Semua
                <i class="bi bi-arrow-right"></i>
            </a>

        </div>


        <div class="table-responsive">

            <table class="table dashboard-table align-middle mb-0">

                <thead>

                    <tr>
                        <th>Invoice</th>
                        <th>Customer</th>
                        <th>Paket</th>
                        <th>Total</th>
                        <th>Status</th>
                        <th>Tanggal</th>
                    </tr>

                </thead>

                <tbody>

                    @forelse($latestOrders as $order)

                        <tr>

                            <td>

                                <span class="invoice-number">
                                    {{ $order->invoice_number }}
                                </span>

                            </td>

                            <td>

                                <div class="customer-info">

                                    <div class="customer-avatar">
                                        {{ strtoupper(substr($order->user->name ?? 'U', 0, 1)) }}
                                    </div>

                                    <span>
                                        {{ $order->user->name ?? '-' }}
                                    </span>

                                </div>

                            </td>

                            <td>
                                {{ $order->package->name ?? '-' }}
                            </td>

                            <td>

                                <strong>
                                    Rp {{ number_format($order->total, 0, ',', '.') }}
                                </strong>

                            </td>

                            <td>

                                @if($order->payment_status === 'paid')

                                    <span class="status-badge paid">
                                        <i class="bi bi-check-circle-fill"></i>
                                        Lunas
                                    </span>

                                @elseif($order->payment_status === 'pending')

                                    <span class="status-badge pending">
                                        <i class="bi bi-clock-fill"></i>
                                        Pending
                                    </span>

                                @else

                                    <span class="status-badge failed">
                                        <i class="bi bi-x-circle-fill"></i>
                                        {{ ucfirst($order->payment_status) }}
                                    </span>

                                @endif

                            </td>

                            <td>

                                <span class="order-date">
                                    {{ $order->created_at->format('d M Y') }}
                                </span>

                            </td>

                        </tr>

                    @empty

                        <tr>

                            <td colspan="6">

                                <div class="empty-table">

                                    <i class="bi bi-inbox"></i>

                                    <p>
                                        Belum ada pesanan
                                    </p>

                                </div>

                            </td>

                        </tr>

                    @endforelse

                </tbody>

            </table>

        </div>

    </div>


@endsection


@push('styles')

<style>

    /* ========================================
       DASHBOARD CARD
    ======================================== */

    .dashboard-card {

        background: #ffffff;

        border: 1px solid #e8edf3;

        border-radius: 12px;

        padding: 22px;

        height: 100%;

        box-shadow: 0 2px 8px rgba(15, 23, 42, 0.03);

    }


    .card-content {

        display: flex;

        align-items: center;

        justify-content: space-between;

        gap: 15px;

    }


    .card-label {

        color: #64748b;

        font-size: 13px;

        font-weight: 500;

        margin: 0 0 7px;

    }


    .card-value {

        color: #0f172a;

        font-size: 27px;

        font-weight: 700;

        margin: 0 0 5px;

    }


    .card-description {

        color: #94a3b8;

        font-size: 11px;

    }


    /* ========================================
       CARD ICON
    ======================================== */

    .card-icon {

        width: 50px;

        height: 50px;

        flex-shrink: 0;

        border-radius: 10px;

        display: flex;

        align-items: center;

        justify-content: center;

        font-size: 21px;

    }


    .card-icon.blue {

        background: #eff6ff;

        color: #2563eb;

    }


    .card-icon.purple {

        background: #f5f3ff;

        color: #7c3aed;

    }


    .card-icon.orange {

        background: #fff7ed;

        color: #ea580c;

    }


    .card-icon.green {

        background: #f0fdf4;

        color: #16a34a;

    }


    /* ========================================
       REVENUE
    ======================================== */

    .revenue-content {

        display: flex;

        align-items: center;

        justify-content: space-between;

    }


    .revenue-value {

        color: #0f172a;

        font-size: 30px;

        font-weight: 700;

        margin: 3px 0 5px;

    }


    .revenue-description {

        color: #94a3b8;

        font-size: 11px;

    }


    .revenue-icon {

        width: 55px;

        height: 55px;

        border-radius: 11px;

        display: flex;

        align-items: center;

        justify-content: center;

        background: #eff6ff;

        color: #1d4ed8;

        font-size: 23px;

    }


    /* ========================================
       PENDING
    ======================================== */

    .pending-card {

        display: flex;

        flex-direction: column;

        justify-content: space-between;

    }


    .pending-header {

        display: flex;

        align-items: center;

        justify-content: space-between;

    }


    .pending-icon {

        width: 48px;

        height: 48px;

        border-radius: 10px;

        background: #fff7ed;

        color: #ea580c;

        display: flex;

        align-items: center;

        justify-content: center;

        font-size: 21px;

    }


    .pending-link {

        display: inline-flex;

        align-items: center;

        gap: 6px;

        margin-top: 20px;

        color: #2563eb;

        text-decoration: none;

        font-size: 12px;

        font-weight: 600;

    }


    .pending-link:hover {

        color: #1d4ed8;

    }


    /* ========================================
       TABLE HEADER
    ======================================== */

    .table-header {

        display: flex;

        align-items: center;

        justify-content: space-between;

        margin-bottom: 18px;

    }


    .table-header h5 {

        color: #0f172a;

        font-size: 15px;

        font-weight: 700;

        margin: 0 0 4px;

    }


    .table-header p {

        color: #94a3b8;

        font-size: 11px;

        margin: 0;

    }


    .view-all {

        display: inline-flex;

        align-items: center;

        gap: 5px;

        color: #2563eb;

        text-decoration: none;

        font-size: 12px;

        font-weight: 600;

    }


    .view-all:hover {

        color: #1d4ed8;

    }


    /* ========================================
       TABLE
    ======================================== */

    .dashboard-table {

        border-collapse: separate;

        border-spacing: 0;

    }


    .dashboard-table thead th {

        background: #f8fafc;

        border-top: 1px solid #eef2f7;

        border-bottom: 1px solid #eef2f7;

        color: #64748b;

        font-size: 11px;

        font-weight: 600;

        padding: 12px 14px;

        white-space: nowrap;

    }


    .dashboard-table tbody td {

        padding: 14px;

        border-bottom: 1px solid #f1f5f9;

        color: #475569;

        font-size: 12px;

    }


    .dashboard-table tbody tr:last-child td {

        border-bottom: none;

    }


    .dashboard-table tbody tr:hover {

        background: #fafcff;

    }


    /* ========================================
       INVOICE
    ======================================== */

    .invoice-number {

        color: #1d4ed8;

        font-weight: 600;

        font-size: 12px;

    }


    /* ========================================
       CUSTOMER
    ======================================== */

    .customer-info {

        display: flex;

        align-items: center;

        gap: 9px;

        white-space: nowrap;

    }


    .customer-avatar {

        width: 30px;

        height: 30px;

        border-radius: 50%;

        background: #e0ecff;

        color: #1d4ed8;

        display: flex;

        align-items: center;

        justify-content: center;

        font-size: 11px;

        font-weight: 700;

    }


    /* ========================================
       STATUS
    ======================================== */

    .status-badge {

        display: inline-flex;

        align-items: center;

        gap: 5px;

        padding: 5px 9px;

        border-radius: 20px;

        font-size: 10px;

        font-weight: 600;

    }


    .status-badge.paid {

        background: #f0fdf4;

        color: #16a34a;

    }


    .status-badge.pending {

        background: #fff7ed;

        color: #ea580c;

    }


    .status-badge.failed {

        background: #fef2f2;

        color: #dc2626;

    }


    .order-date {

        color: #94a3b8;

        white-space: nowrap;

    }


    /* ========================================
       EMPTY TABLE
    ======================================== */

    .empty-table {

        text-align: center;

        padding: 40px 20px;

        color: #94a3b8;

    }


    .empty-table i {

        display: block;

        font-size: 35px;

        margin-bottom: 8px;

    }


    .empty-table p {

        margin: 0;

        font-size: 13px;

    }


    /* ========================================
       RESPONSIVE
    ======================================== */

    @media (max-width: 768px) {

        .content-wrapper {

            padding: 20px 15px;

        }


        .page-title {

            font-size: 21px;

        }


        .revenue-value {

            font-size: 24px;

        }


        .table-header {

            align-items: flex-start;

            gap: 10px;

        }

    }

</style>

@endpush
