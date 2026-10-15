 @extends('customer.layouts.app')

@section('title', 'Rekap RSVP')
@section('page-heading', 'Rekap RSVP')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/customer/rsvp.css') }}">
@endpush

@section('content')

@php
    $totalTamu = $guests->count();
    $hadir = 0;
    $tidakHadir = 0;
    $ragu = 0;
    $belumKonfirmasi = 0;

    foreach ($guests as $guest) {
        $response = $guest->GuestBook->sortByDesc('id')->first();

        if (!$response) {
            $belumKonfirmasi++;
        } elseif ($response->attendance === 'hadir') {
            $hadir++;
        } elseif ($response->attendance === 'tidak_hadir') {
            $tidakHadir++;
        } elseif ($response->attendance === 'ragu') {
            $ragu++;
        } else {
            $belumKonfirmasi++;
        }
    }
@endphp

<div class="welcome-section">
    <h2>Rekap RSVP</h2>
    <p>Pantau konfirmasi kehadiran tamu undangan Anda.</p>
</div>

<div class="rsvp-stats">

    <div class="rsvp-stat-card">
        <div class="rsvp-stat-icon total">
            <i class="fas fa-users"></i>
        </div>
        <div>
            <p>Total Tamu</p>
            <h3>{{ $totalTamu }}</h3>
        </div>
    </div>

    <div class="rsvp-stat-card">
        <div class="rsvp-stat-icon hadir">
            <i class="fas fa-check-circle"></i>
        </div>
        <div>
            <p>Hadir</p>
            <h3>{{ $hadir }}</h3>
        </div>
    </div>

    <div class="rsvp-stat-card">
        <div class="rsvp-stat-icon tidak-hadir">
            <i class="fas fa-times-circle"></i>
        </div>
        <div>
            <p>Tidak Hadir</p>
            <h3>{{ $tidakHadir }}</h3>
        </div>
    </div>

    <div class="rsvp-stat-card">
        <div class="rsvp-stat-icon ragu">
            <i class="fas fa-question-circle"></i>
        </div>
        <div>
            <p>Masih Ragu</p>
            <h3>{{ $ragu }}</h3>
        </div>
    </div>

    <div class="rsvp-stat-card">
        <div class="rsvp-stat-icon belum">
            <i class="fas fa-clock"></i>
        </div>
        <div>
            <p>Belum Konfirmasi</p>
            <h3>{{ $belumKonfirmasi }}</h3>
        </div>
    </div>

</div>

<div class="section-card">
    <div class="section-card-header">
        <h5>Detail Konfirmasi Tamu</h5>
    </div>

    <div class="section-card-body">
        @if ($guests->isEmpty())
            <div class="empty-state">
                <i class="fas fa-users"></i>
                <h5>Belum Ada Tamu</h5>
                <p>Tambahkan tamu terlebih dahulu untuk melihat rekap RSVP.</p>
            </div>
        @else
            <div class="table-responsive">
                <table class="table rsvp-table">
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>Nama Tamu</th>
                            <th>Undangan</th>
                            <th>Status RSVP</th>
                            <th>Ucapan</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($guests as $guest)
                            @php
                                $response = $guest->GuestBook->sortByDesc('id')->first();
                                $attendance = $response->attendance ?? null;
                            @endphp

                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $guest->guest_name }}</td>
                                <td>
                                    {{ $guest->invitation->groom_name ?? '-' }}
                                    &amp;
                                    {{ $guest->invitation->bride_name ?? '-' }}
                                </td>
                                <td>
                                    @if ($attendance === 'hadir')
                                        <span class="attendance-badge hadir">Hadir</span>
                                    @elseif ($attendance === 'tidak_hadir')
                                        <span class="attendance-badge tidak-hadir">Tidak Hadir</span>
                                    @elseif ($attendance === 'ragu')
                                        <span class="attendance-badge ragu">Masih Ragu</span>
                                    @else
                                        <span class="attendance-badge belum">Belum Konfirmasi</span>
                                    @endif
                                </td>
                                <td>{{ $response->message ?? '-' }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif
    </div>
</div>

@endsection