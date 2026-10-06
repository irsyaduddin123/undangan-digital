@extends('admin.layouts.app')

@section('page-title', 'Undangan')

@section('content')

<div class="container-fluid py-4">

    {{-- Header --}}
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h4 class="fw-bold mb-1">Daftar Undangan</h4>
            <p class="text-muted mb-0">
                Kelola seluruh undangan digital.
            </p>
        </div>

        <a href="{{ route('admin.invitations.create') }}"
           class="btn btn-primary">
            <i class="bi bi-plus-lg me-1"></i>
            Tambah Undangan
        </a>
    </div>


    {{-- Success --}}
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show">
            <i class="bi bi-check-circle me-2"></i>
            {{ session('success') }}

            <button type="button"
                    class="btn-close"
                    data-bs-dismiss="alert"></button>
        </div>
    @endif


    {{-- Card --}}
    <div class="card border-0 shadow-sm">

        <div class="card-body">

            <div class="table-responsive">

                <table class="table table-hover align-middle">

                    <thead>
                        <tr>
                            <th width="60">#</th>
                            <th>Undangan</th>
                            <th>Customer</th>
                            <th>Template</th>
                            <th>Tanggal</th>
                            <th>Status</th>
                            <th width="150">Aksi</th>
                        </tr>
                    </thead>

                    <tbody>

                    @forelse($invitations as $invitation)

                        <tr>

                            {{-- No --}}
                            <td>
                                {{ $invitations->firstItem() + $loop->index }}
                            </td>


                            {{-- Pengantin --}}
                            <td>

                                <div class="fw-semibold">
                                    {{ $invitation->groom_name }}
                                    <span class="text-muted">&</span>
                                    {{ $invitation->bride_name }}
                                </div>

                                <small class="text-muted">
                                    /undangan/{{ $invitation->slug }}
                                </small>

                            </td>


                            {{-- Customer --}}
                            <td>

                                @if($invitation->user)
                                    <div class="fw-semibold">
                                        {{ $invitation->user->name }}
                                    </div>

                                    <small class="text-muted">
                                        {{ $invitation->user->email }}
                                    </small>
                                @else
                                    <span class="text-muted">
                                        -
                                    </span>
                                @endif

                            </td>


                            {{-- Template --}}
                            <td>

                                @if($invitation->template)

                                    <span class="badge bg-light text-dark border">
                                        <i class="bi bi-palette me-1"></i>
                                        {{ $invitation->template->name }}
                                    </span>

                                @else

                                    <span class="text-muted">
                                        -
                                    </span>

                                @endif

                            </td>


                            {{-- Date --}}
                            <td>

                                @if($invitation->wedding_date)

                                    {{ $invitation->wedding_date->format('d M Y') }}

                                @else
                                    -
                                @endif

                            </td>


                            {{-- Status --}}
                            <td>

                                @if($invitation->status === 'active')

                                    <span class="badge bg-success">
                                        Aktif
                                    </span>

                                @else

                                    <span class="badge bg-secondary">
                                        Nonaktif
                                    </span>

                                @endif

                            </td>


                            {{-- Action --}}
                            <td>

                                <div class="d-flex gap-1">

                                    {{-- Edit --}}
                                    <a href="{{ route(
                                        'admin.invitations.edit',
                                        $invitation
                                    ) }}"
                                       class="btn btn-outline-primary btn-sm"
                                       title="Edit">

                                        <i class="bi bi-pencil"></i>

                                    </a>


                                    {{-- Preview --}}
                                    <a href="{{ route(
                                            'invitation.show',
                                            $invitation->slug
                                        ) }}"
                                    target="_blank"
                                    class="btn btn-outline-success btn-sm"
                                    title="Preview">

                                        <i class="bi bi-eye"></i>

                                    </a>


                                    {{-- Delete --}}
                                    <form action="{{ route(
                                        'admin.invitations.destroy',
                                        $invitation
                                    ) }}"
                                          method="POST"
                                          class="delete-form"
                                          data-id="{{ $invitation->id }}"
                                          data-name="{{ $invitation->groom_name }} & {{ $invitation->bride_name }}">

                                        @csrf
                                        @method('DELETE')

                                        <button type="submit"
                                                class="btn btn-outline-danger btn-sm"
                                                title="Hapus">

                                            <i class="bi bi-trash"></i>

                                        </button>

                                    </form>

                                </div>

                            </td>

                        </tr>

                    @empty

                        <tr>

                            <td colspan="7"
                                class="text-center py-5">

                                <div class="text-muted">

                                    <i class="bi bi-envelope-open fs-1 d-block mb-3"></i>

                                    <h6>
                                        Belum ada undangan
                                    </h6>

                                    <p class="mb-3">
                                        Silakan tambahkan undangan baru.
                                    </p>

                                    <a href="{{ route(
                                        'admin.invitations.create'
                                    ) }}"
                                       class="btn btn-primary">

                                        <i class="bi bi-plus-lg me-1"></i>
                                        Tambah Undangan

                                    </a>

                                </div>

                            </td>

                        </tr>

                    @endforelse

                    </tbody>

                </table>

            </div>


            {{-- Pagination --}}
            @if($invitations->hasPages())

                <div class="mt-3">

                    {{ $invitations->links() }}

                </div>

            @endif

        </div>

    </div>

</div>

@endsection


@push('scripts')

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>

document.querySelectorAll('.delete-form')
    .forEach(function(form) {

        form.addEventListener('submit', function(event) {

            event.preventDefault();

            const id = form.dataset.id;
            const name = form.dataset.name;

            Swal.fire({

                title: 'Hapus Undangan?',

                html: `
                    Apakah kamu yakin ingin menghapus
                    <strong>${name}</strong>?

                    <br>

                    <small class="text-muted">
                        ID Undangan: ${id}
                    </small>
                `,

                icon: 'warning',

                showCancelButton: true,

                confirmButtonText: 'Ya, Hapus',

                cancelButtonText: 'Batal',

                reverseButtons: true,

                confirmButtonColor: '#dc3545',

                cancelButtonColor: '#6c757d'

            }).then((result) => {

                if (result.isConfirmed) {

                    form.submit();

                }

            });

        });

    });

</script>

@endpush