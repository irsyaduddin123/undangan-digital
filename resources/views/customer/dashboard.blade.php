@extends('customer.layouts.app')

@section('title', 'Dashboard')
@section('page-heading', 'Dashboard')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/customer/dashboard.css') }}">
@endpush

@section('content')

<div class="welcome-section">
    <h2>Dashboard Customer</h2>
    <p>
        Selamat datang, {{ auth()->user()->name }}!
        Berikut ringkasan undangan pernikahan Anda.
    </p>
</div>

{{-- STATISTIK --}}
<div class="row">

    <div class="col-xl-3 col-md-6 col-6 mb-3">
        <div class="stat-card">
            <div class="stat-card-top">
                <div class="stat-icon icon-blue">
                    <i class="fas fa-envelope-open-text"></i>
                </div>
            </div>

            <div class="stat-label">Total Undangan</div>
            <div class="stat-number">{{ $invitations->count() }}</div>
        </div>
    </div>

    <div class="col-xl-3 col-md-6 col-6 mb-3">
        <div class="stat-card">
            <div class="stat-card-top">
                <div class="stat-icon icon-blue">
                    <i class="fas fa-users"></i>
                </div>
            </div>

            <div class="stat-label">Total Tamu</div>
            <div class="stat-number">{{ $totalGuests }}</div>
        </div>
    </div>

    <div class="col-xl-3 col-md-6 col-6 mb-3">
        <div class="stat-card">
            <div class="stat-card-top">
                <div class="stat-icon icon-green">
                    <i class="fas fa-check-circle"></i>
                </div>
            </div>

            <div class="stat-label">Hadir</div>
            <div class="stat-number">{{ $hadir }}</div>
        </div>
    </div>

    <div class="col-xl-3 col-md-6 col-6 mb-3">
        <div class="stat-card">
            <div class="stat-card-top">
                <div class="stat-icon icon-red">
                    <i class="fas fa-times-circle"></i>
                </div>
            </div>

            <div class="stat-label">Tidak Hadir</div>
            <div class="stat-number">{{ $tidakHadir }}</div>
        </div>
    </div>

</div>

{{-- RINGKASAN KONFIRMASI --}}
<div class="row">

    <div class="col-md-6 mb-3">
        <div class="stat-card">
            <div class="stat-card-top">
                <div>
                    <div class="stat-label">Masih Ragu</div>
                    <div class="stat-number">{{ $ragu }}</div>
                </div>

                <div class="stat-icon icon-orange">
                    <i class="fas fa-clock"></i>
                </div>
            </div>

            <p class="text-muted small mb-0">
                Tamu yang belum memastikan kehadirannya.
            </p>
        </div>
    </div>

    <div class="col-md-6 mb-3">
        <div class="stat-card">
            <div class="stat-card-top">
                <div>
                    <div class="stat-label">Belum Konfirmasi</div>
                    <div class="stat-number">{{ $belumKonfirmasi }}</div>
                </div>

                <div class="stat-icon icon-blue">
                    <i class="fas fa-hourglass-half"></i>
                </div>
            </div>

            <p class="text-muted small mb-0">
                Tamu yang belum mengirimkan RSVP.
            </p>
        </div>
    </div>

</div>

{{-- DAFTAR UNDANGAN --}}
<div class="section-card">

    <div class="section-card-header">
        <h5>Undangan Saya</h5>
    </div>

    <div class="section-card-body">

        @if ($invitations->isEmpty())

            <div class="empty-state">
                <div class="empty-state-icon">
                    <i class="fas fa-envelope-open-text"></i>
                </div>

                <h5>Belum Ada Undangan</h5>

                <p>
                    Anda belum memiliki undangan pernikahan.
                </p>
            </div>

        @else

            <div class="table-responsive">
                <table class="table customer-table">

                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>Nama Mempelai</th>
                            <th>Tanggal Pernikahan</th>
                            <th>Status</th>
                            <th>Link Undangan</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach ($invitations as $invitation)
                            <tr>
                                <td>{{ $loop->iteration }}</td>

                                <td>
                                    <span class="couple-name">
                                        {{ $invitation->groom_name }}
                                        &amp;
                                        {{ $invitation->bride_name }}
                                    </span>
                                </td>

                                <td>
                                    {{ $invitation->wedding_date
                                        ? \Carbon\Carbon::parse($invitation->wedding_date)->format('d-m-Y')
                                        : '-' }}
                                </td>

                                <td>
                                    <span class="status-badge">
                                        {{ ucfirst($invitation->status) }}
                                    </span>
                                </td>

                                <td>
                                    @if ($invitation->status === 'active')
                                        <a
                                            href="{{ route('invitation.show', ['invitation' => $invitation->slug]) }}"
                                            target="_blank"
                                            rel="noopener noreferrer"
                                            class="btn btn-view-invitation"
                                        >
                                            <i class="fas fa-external-link-alt mr-1"></i>
                                            Lihat Undangan
                                        </a>
                                    @else
                                        <span class="text-muted small">
                                            Belum aktif
                                        </span>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>

                </table>
            </div>

        @endif

    </div>
</div>

@endsection