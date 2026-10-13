@extends('customer.layouts.app')

@section('title', 'Undangan Saya')
@section('page-heading', 'Undangan Saya')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/customer/invitations.css') }}">
@endpush

@section('content')

<div class="welcome-section">
    <h2>Undangan Saya</h2>
    <p>
        Kelola dan lihat undangan pernikahan yang Anda miliki.
    </p>
</div>

<div class="section-card">

    <div class="section-card-header">
        <h5>Daftar Undangan</h5>

        <span class="invitation-total">
            {{ $invitations->count() }} Undangan
        </span>
    </div>

    <div class="section-card-body">

        @forelse ($invitations as $invitation)

            <div class="invitation-item">

                <div class="invitation-info">

                    <div class="invitation-icon">
                        <i class="fas fa-envelope-open-text"></i>
                    </div>

                    <div class="invitation-detail">
                        <h6>
                            {{ $invitation->groom_name }}
                            &amp;
                            {{ $invitation->bride_name }}
                        </h6>

                        <p>
                            <i class="far fa-calendar-alt"></i>

                            {{ $invitation->wedding_date
                                ? \Carbon\Carbon::parse($invitation->wedding_date)->format('d M Y')
                                : 'Tanggal belum ditentukan' }}
                        </p>

                        <span class="status-badge">
                            {{ ucfirst($invitation->status) }}
                        </span>
                    </div>

                </div>

                <div class="invitation-actions">

                    @if ($invitation->status === 'active')

                        <a
                            href="{{ route('invitation.show', ['invitation' => $invitation->slug]) }}"
                            target="_blank"
                            rel="noopener noreferrer"
                            class="btn-view-invitation"
                        >
                            <i class="fas fa-external-link-alt"></i>
                            Lihat Undangan
                        </a>

                    @else

                        <span class="text-muted small">
                            Undangan belum aktif
                        </span>

                    @endif

                </div>

            </div>

        @empty

            <div class="empty-state">
                <div class="empty-state-icon">
                    <i class="fas fa-envelope-open-text"></i>
                </div>

                <h5>Belum Ada Undangan</h5>

                <p>
                    Anda belum memiliki undangan pernikahan.
                    Undangan Anda akan muncul di halaman ini.
                </p>
            </div>

        @endforelse

    </div>

</div>

@endsection