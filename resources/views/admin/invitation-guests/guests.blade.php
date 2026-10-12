
@extends('admin.layouts.app')

@section('content')
<div class="container-fluid">

    <div class="d-flex justify-content-between align-items-center mb-3">
        <div>
            <h1 class="h3 mb-1">Kelola Tamu Undangan</h1>
            <p class="text-muted mb-0">
                {{ $invitation->groom_name }} &amp; {{ $invitation->bride_name }}
            </p>
        </div>

        <a href="{{ route('admin.invitation-guests.index') }}"
           class="btn btn-secondary">
            <i class="fas fa-arrow-left"></i> Kembali
        </a>
    </div>

    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    {{-- Form tambah tamu --}}
    <div class="card shadow-sm mb-4">
        <div class="card-header">
            <h3 class="card-title">Tambah Tamu</h3>
        </div>

        <form action="{{ route('admin.invitation-guests.store', $invitation->id) }}"
              method="POST">
            @csrf

            <div class="card-body">
                <div class="form-group">
                    <label for="guest_name">Nama Tamu</label>
                    <input type="text"
                           name="guest_name"
                           id="guest_name"
                           class="form-control @error('guest_name') is-invalid @enderror"
                           value="{{ old('guest_name') }}"
                           placeholder="Contoh: Budi Santoso"
                           required
                           maxlength="255">

                    @error('guest_name')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="card-footer">
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-plus"></i> Tambah Tamu
                </button>
            </div>
        </form>
    </div>

    {{-- Tabel tamu --}}
    <div class="card shadow-sm">
        <div class="card-header">
            <h3 class="card-title">Daftar Tamu</h3>
        </div>

        <div class="card-body table-responsive p-0">
            <table class="table table-hover table-striped mb-0">
                <thead>
                    <tr>
                        <th style="width: 60px;">No.</th>
                        <th>Nama Tamu</th>
                        <th>Slug Undangan</th>
                        <th>Link Undangan</th>
                        <th style="width: 100px;">Aksi</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse ($guests as $guest)
                        <tr>
                            <td>{{ $guests->firstItem() + $loop->index }}</td>

                            <td>{{ $guest->guest_name }}</td>

                            <td>
                                <code>{{ $guest->slug }}</code>
                            </td>

                            <td>
                                <button
                                    type="button"
                                    class="btn btn-success btn-sm btn-salin-link"
                                    data-url="{{ route('invitation.guest.show', [
                                        'invitation' => $invitation->slug,
                                        'invitationGuest' => $guest->slug
                                    ]) }}"
                                >
                                    <i class="fas fa-copy"></i> Salin Link
                                </button>
                            </td>

                            <td>

                                <form action="{{ route('admin.invitation-guests.destroy', [
                                            'invitation' => $invitation->id,
                                            'invitationGuest' => $guest->id
                                        ]) }}"
                                    method="POST"
                                    class="form-hapus-tamu d-inline"
                                    data-name="{{ $guest->guest_name }}">
                                    @csrf
                                    @method('DELETE')

                                    <button type="submit" class="btn btn-danger btn-sm">
                                        <i class="fas fa-trash"></i> Hapus
                                    </button>
                                </form>

                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="text-center py-4">
                                Belum ada tamu untuk undangan ini.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if ($guests->hasPages())
            <div class="card-footer">
                {{ $guests->links() }}
            </div>
        @endif
    </div>

</div>
@endsection

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        document.querySelectorAll('.form-hapus-tamu').forEach(function (form) {
            form.addEventListener('submit', function (event) {
                event.preventDefault();

                const guestName = form.getAttribute('data-name');

                Swal.fire({
                    title: `Hapus ${guestName} Sebagai Tamu? ` ,
                    text: 'Data tamu yang dihapus tidak dapat dikembalikan.',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#dc3545',
                    cancelButtonColor: '#6c757d',
                    confirmButtonText: 'Ya, Hapus!',
                    cancelButtonText: 'Batal',
                    reverseButtons: true
                }).then(function (result) {
                    if (result.isConfirmed) {
                        form.submit();
                    }
                });
            });
        });
    });
</script>


<script>
    document.addEventListener('DOMContentLoaded', function () {
        document.querySelectorAll('.btn-salin-link').forEach(function (button) {
            button.addEventListener('click', async function () {
                const url = button.dataset.url;

                try {
                    await navigator.clipboard.writeText(url);

                    Swal.fire({
                        icon: 'success',
                        title: 'Link Berhasil Disalin!',
                        text: 'Link undangan siap dibagikan.',
                        timer: 1800,
                        showConfirmButton: false
                    });
                } catch (error) {
                    Swal.fire({
                        icon: 'info',
                        title: 'Salin Link Undangan',
                        input: 'text',
                        inputValue: url,
                        showCancelButton: true,
                        confirmButtonText: 'Tutup',
                        cancelButtonText: 'Batal'
                    });
                }
            });
        });
    });
</script>


