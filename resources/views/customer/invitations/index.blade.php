
@extends('customer.layouts.app')

@section('title', 'Undangan Saya')
@section('page-heading', 'Undangan Saya')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/customer/invitation.css') }}">
@endpush

@section('content')

<div class="invitation-page">

    {{-- Page Header --}}
    <div class="invitation-hero">
        <div class="hero-content">
            <span class="hero-label">
                <i class="fas fa-heart"></i>
                WEDDING INVITATION
            </span>

            <h2>Undangan Saya</h2>

            <p>
                Kelola undangan pernikahan Anda dan bagikan
                momen bahagia kepada orang-orang tersayang.
            </p>
        </div>

        <div class="hero-decoration">
            <i class="fas fa-envelope-open-text"></i>
        </div>
    </div>

    {{-- Invitation Summary --}}
    <div class="invitation-summary">

        <div class="summary-card">
            <div class="summary-icon">
                <i class="fas fa-envelope"></i>
            </div>

            <div class="summary-info">
                <span>Total Undangan</span>
                <h3>{{ $invitations->count() }}</h3>
                <p>Undangan yang Anda miliki</p>
            </div>
        </div>

        <div class="summary-card">
            <div class="summary-icon active-icon">
                <i class="fas fa-check-circle"></i>
            </div>

            <div class="summary-info">
                <span>Undangan Aktif</span>
                <h3>
                    {{ $invitations->where('status', 'active')->count() }}
                </h3>
                <p>Siap dibagikan kepada tamu</p>
            </div>
        </div>

        <div class="summary-card">
            <div class="summary-icon draft-icon">
                <i class="fas fa-clock"></i>
            </div>

            <div class="summary-info">
                <span>Belum Aktif</span>
                <h3>
                    {{ $invitations->where('status', '!=', 'active')->count() }}
                </h3>
                <p>Undangan yang belum aktif</p>
            </div>
        </div>

    </div>

    {{-- Invitation List --}}
    <div class="invitation-panel">

        <div class="panel-header">
            <div>
                <h4>Daftar Undangan</h4>
                <p>Semua undangan pernikahan Anda</p>
            </div>

            <a href="{{ route('customer.invitations.create') }}"
               class="btn-create-invitation">
                <i class="fas fa-plus"></i>
                <span>Buat Undangan</span>
            </a>
        </div>


{{-- Invitation List --}}
<div class="invitation-panel">

    <div class="panel-header">
        <div>
            <h4>Undangan Saya</h4>
            <p>Pilih undangan untuk melihat tampilannya.</p>
        </div>

        <a href="{{ route('customer.invitations.create') }}"
           class="btn-create-invitation">
            <i class="fas fa-plus"></i>
            Buat Undangan
        </a>
    </div>

    <div class="invitation-grid">

        @forelse ($invitations as $invitation)

            <div class="invitation-card">

                {{-- Preview Cover --}}
                <a href="{{ route('invitation.show', ['invitation' => $invitation->slug]) }}"
                   target="_blank"
                   rel="noopener noreferrer"
                   class="invitation-preview">

                    @if ($invitation->cover_image)
                        <img
                            src="{{ asset('storage/' . $invitation->cover_image) }}"
                            alt="Cover {{ $invitation->groom_name }} dan {{ $invitation->bride_name }}"
                        >
                    @else
                        <div class="preview-placeholder">
                            <i class="fas fa-heart"></i>
                            <span>THE WEDDING OF</span>
                            <h3>
                                {{ $invitation->groom_name }}
                                <br>&amp;<br>
                                {{ $invitation->bride_name }}
                            </h3>
                        </div>
                    @endif

                    <span class="preview-label">
                        <i class="fas fa-eye"></i> Preview
                    </span>

                </a>

                {{-- Informasi Undangan --}}
                <div class="invitation-card-body">

                    <div class="invitation-card-heading">
                        <h5>
                            {{ $invitation->groom_name }}
                            &amp;
                            {{ $invitation->bride_name }}
                        </h5>

                        <span class="status-badge
                            {{ $invitation->status === 'active'
                                ? 'status-active'
                                : 'status-inactive' }}">
                            {{ ucfirst($invitation->status) }}
                        </span>
                    </div>

                    <p class="invitation-date">
                        <i class="far fa-calendar-alt"></i>
                        {{ $invitation->wedding_date
                            ? \Carbon\Carbon::parse($invitation->wedding_date)->format('d M Y')
                            : 'Tanggal belum ditentukan' }}
                    </p>

                    <a href="{{ route('invitation.show', ['invitation' => $invitation->slug]) }}"
                       target="_blank"
                       rel="noopener noreferrer"
                       class="btn-view-invitation">
                        <i class="fas fa-external-link-alt"></i>
                        Lihat Undangan
                    </a>

                </div>

            </div>

        @empty

            <div class="empty-state">
                <div class="empty-illustration">
                    <i class="fas fa-envelope-open-text"></i>
                </div>

                <h4>Belum Ada Undangan</h4>

                <p>Buat undangan pertama dan mulai persiapkan hari bahagia Anda.</p>

                <a href="{{ route('customer.invitations.create') }}"
                   class="btn-create-invitation">
                    <i class="fas fa-plus"></i>
                    Buat Undangan
                </a>
            </div>

        @endforelse

    </div>

</div>


    </div>

</div>

@endsection
