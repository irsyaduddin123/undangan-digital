
@extends('admin.layouts.app')

@section('content')
<div class="container-fluid">

    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h1 class="h3 mb-1">Invitation Guest</h1>
            <p class="text-muted mb-0">
                Pilih undangan untuk mengelola daftar tamunya.
            </p>
        </div>
    </div>

    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <div class="card shadow-sm">
        <div class="card-header">
            <h3 class="card-title">Daftar Undangan</h3>
        </div>

        <div class="card-body table-responsive p-0">
            <table class="table table-hover table-striped mb-0">
                <thead>
                    <tr>
                        <th style="width: 60px;">No.</th>
                        <th>Nama Mempelai</th>
                        <th>Tanggal Pernikahan</th>
                        <th>Jumlah Tamu</th>
                        <th style="width: 150px;">Aksi</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse ($invitations as $invitation)
                        <tr>
                            <td>
                                {{ $invitations->firstItem() + $loop->index }}
                            </td>

                            <td>
                                <strong>
                                    {{ $invitation->groom_name }}
                                    &amp;
                                    {{ $invitation->bride_name }}
                                </strong>
                            </td>

                            <td>
                                {{ $invitation->wedding_date
                                    ? \Carbon\Carbon::parse($invitation->wedding_date)->format('d-m-Y')
                                    : '-' }}
                            </td>

                            <td>
                                <span class="badge badge-info">
                                    {{ $invitation->invitation_guests_count }} tamu
                                </span>
                            </td>

                            <td>
                                <a
                                    href="{{ route('admin.invitation-guests.guests', $invitation->id) }}"
                                    class="btn btn-primary btn-sm"
                                >
                                    <i class="fas fa-users"></i>
                                    Kelola Tamu
                                </a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center py-4">
                                Belum ada data undangan.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if ($invitations->hasPages())
            <div class="card-footer">
                {{ $invitations->links() }}
            </div>
        @endif
    </div>

</div>
@endsection
