@extends('customer.layouts.app')

@section('title', 'Daftar Tamu')
@section('page-heading', 'Daftar Tamu')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/customer/guests.css') }}">
@endpush

@section('content')

<div class="guest-page-heading">
    <div class="welcome-section">
        <h2>Daftar Tamu</h2>
        <p>Kelola daftar tamu dan bagikan link undangan personal Anda.</p>
    </div>

    <a href="{{ route('customer.guests.create') }}"
       class="btn btn-add-guest">
        <i class="fas fa-plus mr-1"></i>
        Tambah Tamu
    </a>
</div>

<div class="section-card">

    <div class="section-card-header">
        <h5>Semua Tamu</h5>
        <span class="guest-total">{{ $guests->count() }} Tamu</span>
    </div>

    <div class="section-card-body">

        @if ($guests->isEmpty())

            <div class="empty-state">
                <div class="empty-state-icon">
                    <i class="fas fa-users"></i>
                </div>

                <h5>Belum Ada Tamu</h5>

                <p>
                    Daftar tamu akan muncul setelah tamu ditambahkan
                    ke undangan Anda.
                </p>
            </div>

        @else

            <div class="table-responsive">
                <table class="table guest-table">

                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>Nama Tamu</th>
                            <th>Undangan</th>
                            <th>Konfirmasi</th>
                            <th>Link Personal</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach ($guests as $guest)
                            @php
                                $response = $guest->GuestBook->first();

                                $attendance = $response
                                    ? $response->attendance
                                    : null;

                                $guestUrl = route('invitation.guest.show', [
                                    'invitation' => $guest->invitation->slug,
                                    'invitationGuest' => $guest->slug,
                                ]);
                            @endphp

                            <tr>
                                <td>{{ $loop->iteration }}</td>

                                <td>
                                    <span class="guest-name">
                                        {{ $guest->guest_name }}
                                    </span>
                                </td>

                                <td>
                                    {{ $guest->invitation->groom_name }}
                                    &amp;
                                    {{ $guest->invitation->bride_name }}
                                </td>

                                <td>
                                    @if ($attendance === 'hadir')
                                        <span class="attendance-badge hadir">
                                            Hadir
                                        </span>
                                    @elseif ($attendance === 'tidak_hadir')
                                        <span class="attendance-badge tidak-hadir">
                                            Tidak Hadir
                                        </span>
                                    @elseif ($attendance === 'ragu')
                                        <span class="attendance-badge ragu">
                                            Masih Ragu
                                        </span>
                                    @else
                                        <span class="attendance-badge belum">
                                            Belum Konfirmasi
                                        </span>
                                    @endif
                                </td>

                                <td>
                                    <button
                                        type="button"
                                        class="btn-copy-link"
                                        data-url="{{ $guestUrl }}"
                                    >
                                        <i class="fas fa-copy"></i>
                                        Salin Link
                                    </button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>

                </table>
            </div>

            <div id="copyMessage" class="copy-message" role="status"></div>

        @endif

    </div>
</div>

@endsection

@push('scripts')
<script>
    document.querySelectorAll('.btn-copy-link').forEach(function (button) {
        button.addEventListener('click', async function () {
            const url = this.dataset.url;
            const message = document.getElementById('copyMessage');

            try {
                await navigator.clipboard.writeText(url);
                message.textContent = 'Link undangan berhasil disalin.';
                message.classList.add('show');
            } catch (error) {
                message.textContent = 'Gagal menyalin link. Silakan salin URL secara manual.';
                message.classList.add('show');
            }

            setTimeout(function () {
                message.classList.remove('show');
            }, 3000);
        });
    });
</script>
@endpush
