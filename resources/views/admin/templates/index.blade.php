@extends('admin.layouts.app')

@section('title', 'Template')
@section('page-title', 'Template')

@section('content')

<div class="container-fluid">

    {{-- Header --}}
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h4 class="fw-bold mb-1">Template Undangan</h4>
            <p class="text-muted mb-0">
                Kelola template undangan digital
            </p>
        </div>

        <a href="{{ route('admin.templates.create') }}"
           class="btn btn-primary">
            <i class="bi bi-plus-lg me-1"></i>
            Tambah Template
        </a>
    </div>


    {{-- Alert Success --}}
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="bi bi-check-circle me-2"></i>
            {{ session('success') }}

            <button type="button"
                    class="btn-close"
                    data-bs-dismiss="alert">
            </button>
        </div>
    @endif


    {{-- Alert Error --}}
    @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <i class="bi bi-exclamation-circle me-2"></i>
            {{ session('error') }}

            <button type="button"
                    class="btn-close"
                    data-bs-dismiss="alert">
            </button>
        </div>
    @endif


    {{-- Template --}}
    <div class="row g-4">

        @forelse($templates as $template)

            <div class="col-xl-3 col-lg-4 col-md-6">

                <div class="card template-card h-100 border-0 shadow-sm">

                    {{-- Thumbnail --}}
                    <div class="template-thumbnail">

                        @if($template->thumbnail)
                            <img
                                src="{{ asset('storage/' . $template->thumbnail) }}"
                                alt="{{ $template->name }}"
                            >
                        @else
                            <div class="no-thumbnail">
                                <i class="bi bi-image"></i>
                                <span>Belum ada gambar</span>
                            </div>
                        @endif

                    </div>


                    {{-- Content --}}
                    <div class="card-body">

                        <div class="d-flex justify-content-between align-items-start mb-2">

                            <h5 class="fw-bold mb-0">
                                {{ $template->name }}
                            </h5>

                            @if($template->status === 'active')

                                <span class="badge bg-success-subtle text-success">
                                    Aktif
                                </span>

                            @else

                                <span class="badge bg-secondary-subtle text-secondary">
                                    Nonaktif
                                </span>

                            @endif

                        </div>


                        <div class="text-muted small mb-3">
                            <i class="bi bi-link-45deg me-1"></i>
                            {{ $template->slug }}
                        </div>


                        <div class="d-flex gap-2">

                            {{-- Edit --}}
                            <a href="{{ route('admin.templates.edit', $template) }}"
                               class="btn btn-outline-primary btn-sm flex-grow-1">
                                <i class="bi bi-pencil me-1"></i>
                                Edit
                            </a>


                            {{-- Delete --}}
                            <form action="{{ route('admin.templates.destroy', $template) }}"
                                  method="POST"
                                  class="delete-form"
                                  data-id="{{ $template->id }}"
                                  data-name="{{ $template->name }}">

                                @csrf
                                @method('DELETE')

                                <button type="submit"
                                        class="btn btn-outline-danger btn-sm"
                                        title="Hapus">
                                    <i class="bi bi-trash"></i>
                                </button>

                            </form>

                        </div>

                    </div>

                </div>

            </div>

        @empty

            <div class="col-12">

                <div class="card border-0 shadow-sm">

                    <div class="card-body text-center py-5">

                        <div class="empty-icon mb-3">
                            <i class="bi bi-layout-text-window-reverse"></i>
                        </div>

                        <h5 class="fw-bold">
                            Belum Ada Template
                        </h5>

                        <p class="text-muted mb-4">
                            Belum ada template undangan yang ditambahkan.
                        </p>

                        <a href="{{ route('admin.templates.create') }}"
                           class="btn btn-primary">
                            <i class="bi bi-plus-lg me-1"></i>
                            Tambah Template
                        </a>

                    </div>

                </div>

            </div>

        @endforelse

    </div>


    {{-- Pagination --}}
    @if($templates->hasPages())

        <div class="d-flex justify-content-center mt-4">
            {{ $templates->links() }}
        </div>

    @endif

</div>

@endsection


@push('styles')

<style>

    .template-card {
        border-radius: 14px;
        overflow: hidden;
        transition: all .2s ease;
    }

    .template-card:hover {
        transform: translateY(-3px);
        box-shadow: 0 10px 25px rgba(15, 23, 42, .10) !important;
    }

    .template-thumbnail {
        height: 260px;
        background: #f1f5f9;
        overflow: hidden;
    }

    .template-thumbnail img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        display: block;
    }

    .no-thumbnail {
        height: 100%;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        color: #94a3b8;
        gap: 8px;
    }

    .no-thumbnail i {
        font-size: 42px;
    }

    .no-thumbnail span {
        font-size: 13px;
    }

    .template-card .card-body {
        padding: 18px;
    }

    .template-card h5 {
        font-size: 16px;
        color: #0f172a;
    }

    .badge {
        font-weight: 500;
        padding: 6px 9px;
        border-radius: 7px;
    }

    .empty-icon {
        width: 70px;
        height: 70px;
        margin: auto;
        border-radius: 50%;
        background: #eff6ff;
        color: #2563eb;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 30px;
    }

</style>

@endpush


@push('scripts')

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>

    document.querySelectorAll('.delete-form').forEach(function(form) {

        form.addEventListener('submit', function(event) {

            event.preventDefault();

            const id = form.dataset.id;
            const name = form.dataset.name;

            Swal.fire({
                title: 'Hapus Template?',
                html: `
                    Apakah kamu yakin ingin menghapus
                    <strong>${name}</strong>?
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