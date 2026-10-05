@extends('admin.layouts.app')

@section('title', 'Edit Template')
@section('page-title', 'Edit Template')

@section('content')

<div class="container-fluid">

    {{-- Header --}}
    <div class="d-flex justify-content-between align-items-center mb-4">

        <div>
            <h4 class="fw-bold mb-1">Edit Template</h4>
            <p class="text-muted mb-0">
                Perbarui informasi template undangan
            </p>
        </div>

        <a href="{{ route('admin.templates.index') }}"
           class="btn btn-outline-secondary">
            <i class="bi bi-arrow-left me-1"></i>
            Kembali
        </a>

    </div>


    {{-- Validation Error --}}
    @if ($errors->any())

        <div class="alert alert-danger">
            <div class="fw-semibold mb-2">
                <i class="bi bi-exclamation-circle me-1"></i>
                Terdapat kesalahan:
            </div>

            <ul class="mb-0 ps-3">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>

    @endif


    <div class="card border-0 shadow-sm template-form-card">

        <div class="card-body p-4">

            <form action="{{ route('admin.templates.update', $template) }}"
                  method="POST"
                  enctype="multipart/form-data">

                @csrf
                @method('PUT')


                {{-- Nama Template --}}
                <div class="mb-4">

                    <label for="name" class="form-label fw-semibold">
                        Nama Template
                        <span class="text-danger">*</span>
                    </label>

                    <input
                        type="text"
                        name="name"
                        id="name"
                        class="form-control @error('name') is-invalid @enderror"
                        value="{{ old('name', $template->name) }}"
                        required
                    >

                    @error('name')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror

                </div>


                {{-- Slug --}}
                <div class="mb-4">

                    <label for="slug" class="form-label fw-semibold">
                        Slug
                    </label>

                    <input
                        type="text"
                        name="slug"
                        id="slug"
                        class="form-control @error('slug') is-invalid @enderror"
                        value="{{ old('slug', $template->slug) }}"
                    >

                    @error('slug')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror

                </div>


                {{-- Thumbnail Saat Ini --}}
                @if($template->thumbnail)

                    <div class="mb-4">

                        <label class="form-label fw-semibold">
                            Thumbnail Saat Ini
                        </label>

                        <div>
                            <img
                                src="{{ asset('storage/' . $template->thumbnail) }}"
                                alt="{{ $template->name }}"
                                class="current-thumbnail"
                            >
                        </div>

                    </div>

                @endif


                {{-- Thumbnail Baru --}}
                <div class="mb-4">

                    <label for="thumbnail" class="form-label fw-semibold">
                        Ganti Thumbnail
                    </label>

                    <input
                        type="file"
                        name="thumbnail"
                        id="thumbnail"
                        class="form-control @error('thumbnail') is-invalid @enderror"
                        accept=".jpg,.jpeg,.png,.webp"
                    >

                    <small class="text-muted">
                        Kosongkan jika tidak ingin mengganti thumbnail.
                        Maksimal 2 MB.
                    </small>

                    @error('thumbnail')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror


                    {{-- Preview Thumbnail Baru --}}
                    <div class="mt-3 d-none" id="preview-container">

                        <p class="small fw-semibold mb-2">
                            Preview Thumbnail Baru:
                        </p>

                        <img
                            id="thumbnail-preview"
                            src="#"
                            alt="Preview"
                            class="thumbnail-preview"
                        >

                    </div>

                </div>


                {{-- Path --}}
                <div class="mb-4">

                    <label for="path" class="form-label fw-semibold">
                        Path Template
                        <span class="text-danger">*</span>
                    </label>

                    <input
                        type="text"
                        name="path"
                        id="path"
                        class="form-control @error('path') is-invalid @enderror"
                        value="{{ old('path', $template->path) }}"
                        required
                    >

                    <small class="text-muted">
                        Contoh:
                        <code>templates.elegant</code>
                    </small>

                    @error('path')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror

                </div>


                {{-- Status --}}
                <div class="mb-4">

                    <label for="status" class="form-label fw-semibold">
                        Status
                        <span class="text-danger">*</span>
                    </label>

                    <select
                        name="status"
                        id="status"
                        class="form-select @error('status') is-invalid @enderror"
                        required
                    >

                        <option value="active"
                            {{ old('status', $template->status) === 'active' ? 'selected' : '' }}>
                            Aktif
                        </option>

                        <option value="inactive"
                            {{ old('status', $template->status) === 'inactive' ? 'selected' : '' }}>
                            Nonaktif
                        </option>

                    </select>

                    @error('status')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror

                </div>


                {{-- Buttons --}}
                <div class="d-flex justify-content-end gap-2 pt-3 border-top">

                    <a href="{{ route('admin.templates.index') }}"
                       class="btn btn-light">
                        Batal
                    </a>

                    <button type="submit"
                            class="btn btn-primary">
                        <i class="bi bi-save me-1"></i>
                        Simpan Perubahan
                    </button>

                </div>

            </form>

        </div>

    </div>

</div>

@endsection


@push('styles')

<style>

    .template-form-card {
        border-radius: 14px;
        max-width: 900px;
    }

    .form-label {
        color: #1e293b;
    }

    .form-control,
    .form-select {
        border-radius: 8px;
        padding: 10px 13px;
        border-color: #dbe2ea;
    }

    .form-control:focus,
    .form-select:focus {
        border-color: #2563eb;
        box-shadow: 0 0 0 .2rem rgba(37, 99, 235, .10);
    }

    .current-thumbnail,
    .thumbnail-preview {
        width: 220px;
        height: 280px;
        object-fit: cover;
        border-radius: 10px;
        border: 1px solid #e2e8f0;
    }

</style>

@endpush


@push('scripts')

<script>

    document.getElementById('thumbnail').addEventListener('change', function(event) {

        const file = event.target.files[0];

        const previewContainer = document.getElementById('preview-container');
        const preview = document.getElementById('thumbnail-preview');

        if (file) {

            preview.src = URL.createObjectURL(file);

            previewContainer.classList.remove('d-none');

        } else {

            preview.src = '#';

            previewContainer.classList.add('d-none');

        }

    });


    // Slug otomatis
    document.getElementById('name').addEventListener('input', function() {

        const slugInput = document.getElementById('slug');

        slugInput.value = this.value
            .toLowerCase()
            .trim()
            .replace(/[^a-z0-9\s-]/g, '')
            .replace(/\s+/g, '-')
            .replace(/-+/g, '-');

    });

</script>

@endpush