@extends('admin.layouts.app')

@section('page-title', 'Tambah Undangan')

@section('content')

<div class="container-fluid py-4">

    {{-- Header --}}
    <div class="mb-4">

        <a href="{{ route('admin.invitations.index') }}"
           class="text-decoration-none">

            <i class="bi bi-arrow-left me-1"></i>
            Kembali

        </a>

        <h4 class="fw-bold mt-3 mb-1">
            Tambah Undangan
        </h4>

        <p class="text-muted mb-0">
            Buat undangan digital baru.
        </p>

    </div>


    <form action="{{ route('admin.invitations.store') }}"
          method="POST"
          enctype="multipart/form-data">

        @csrf


        <div class="row">


            {{-- LEFT --}}
            <div class="col-lg-8">


                {{-- Data Pengantin --}}
                <div class="card border-0 shadow-sm mb-4">

                    <div class="card-header bg-white py-3">

                        <h6 class="fw-bold mb-0">
                            <i class="bi bi-heart me-2"></i>
                            Data Pengantin
                        </h6>

                    </div>


                    <div class="card-body">

                        <div class="row">

                            {{-- Groom --}}
                            <div class="col-md-6 mb-3">

                                <label class="form-label">
                                    Nama Mempelai Pria
                                    <span class="text-danger">*</span>
                                </label>

                                <input type="text"
                                       name="groom_name"
                                       value="{{ old('groom_name') }}"
                                       class="form-control @error('groom_name') is-invalid @enderror"
                                       placeholder="Contoh: Ahmad">

                                @error('groom_name')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror

                            </div>


                            {{-- Bride --}}
                            <div class="col-md-6 mb-3">

                                <label class="form-label">
                                    Nama Mempelai Wanita
                                    <span class="text-danger">*</span>
                                </label>

                                <input type="text"
                                       name="bride_name"
                                       value="{{ old('bride_name') }}"
                                       class="form-control @error('bride_name') is-invalid @enderror"
                                       placeholder="Contoh: Siti">

                                @error('bride_name')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror

                            </div>


                            {{-- Slug --}}
                            <div class="col-12 mb-3">

                                <label class="form-label">
                                    Slug Undangan
                                </label>

                                <div class="input-group">

                                    <span class="input-group-text">
                                        /undangan/
                                    </span>

                                    <input type="text"
                                           name="slug"
                                           id="slug"
                                           value="{{ old('slug') }}"
                                           class="form-control @error('slug') is-invalid @enderror"
                                           placeholder="ahmad-dan-siti">

                                </div>

                                <small class="text-muted">
                                    Kosongkan untuk membuat otomatis dari nama pengantin.
                                </small>

                                @error('slug')
                                    <div class="text-danger small">
                                        {{ $message }}
                                    </div>
                                @enderror

                            </div>

                        </div>

                    </div>

                </div>


                {{-- Pernikahan --}}
                <div class="card border-0 shadow-sm mb-4">

                    <div class="card-header bg-white py-3">

                        <h6 class="fw-bold mb-0">
                            <i class="bi bi-calendar-heart me-2"></i>
                            Waktu Pernikahan
                        </h6>

                    </div>


                    <div class="card-body">

                        <div class="row">

                            <div class="col-md-4 mb-3">

                                <label class="form-label">
                                    Tanggal Pernikahan
                                    <span class="text-danger">*</span>
                                </label>

                                <input type="date"
                                       name="wedding_date"
                                       value="{{ old('wedding_date') }}"
                                       class="form-control">

                            </div>


                            <div class="col-md-4 mb-3">

                                <label class="form-label">
                                    Akad Nikah
                                </label>

                                <input type="datetime-local"
                                       name="akad_date"
                                       value="{{ old('akad_date') }}"
                                       class="form-control">

                            </div>


                            <div class="col-md-4 mb-3">

                                <label class="form-label">
                                    Resepsi
                                </label>

                                <input type="datetime-local"
                                       name="reception_date"
                                       value="{{ old('reception_date') }}"
                                       class="form-control">

                            </div>

                        </div>

                    </div>

                </div>


                {{-- Lokasi --}}
                <div class="card border-0 shadow-sm mb-4">

                    <div class="card-header bg-white py-3">

                        <h6 class="fw-bold mb-0">
                            <i class="bi bi-geo-alt me-2"></i>
                            Lokasi Pernikahan
                        </h6>

                    </div>


                    <div class="card-body">

                        <div class="mb-3">

                            <label class="form-label">
                                Nama Lokasi
                                <span class="text-danger">*</span>
                            </label>

                            <input type="text"
                                   name="location_name"
                                   value="{{ old('location_name') }}"
                                   class="form-control"
                                   placeholder="Contoh: Gedung Graha">

                        </div>


                        <div class="mb-3">

                            <label class="form-label">
                                Alamat
                            </label>

                            <textarea name="address"
                                      rows="3"
                                      class="form-control"
                                      placeholder="Alamat lengkap lokasi">{{ old('address') }}</textarea>

                        </div>


                        <div class="mb-0">

                            <label class="form-label">
                                Google Maps
                            </label>

                            <input type="text"
                                   name="google_maps"
                                   value="{{ old('google_maps') }}"
                                   class="form-control"
                                   placeholder="https://maps.google.com/...">

                        </div>

                    </div>

                </div>


                {{-- Media --}}
                <div class="card border-0 shadow-sm mb-4">

                    <div class="card-header bg-white py-3">

                        <h6 class="fw-bold mb-0">
                            <i class="bi bi-images me-2"></i>
                            Media
                        </h6>

                    </div>


                    <div class="card-body">

                        <div class="mb-3">

                            <label class="form-label">
                                Cover Undangan
                            </label>

                            <input type="file"
                                   name="cover_image"
                                   id="cover_image"
                                   accept="image/*"
                                   class="form-control">

                            <div class="mt-3">

                                <img id="coverPreview"
                                     src=""
                                     class="img-fluid rounded d-none"
                                     style="max-height: 250px;">

                            </div>

                        </div>


                        <div class="mb-0">

                            <label class="form-label">
                                Musik
                            </label>

                            <input type="file"
                                   name="music"
                                   accept=".mp3,.wav,.ogg"
                                   class="form-control">

                            <small class="text-muted">
                                Format MP3, WAV, atau OGG.
                            </small>

                        </div>

                    </div>

                </div>

            </div>


            {{-- RIGHT --}}
            <div class="col-lg-4">


                {{-- Customer --}}
                <div class="card border-0 shadow-sm mb-4">

                    <div class="card-header bg-white py-3">

                        <h6 class="fw-bold mb-0">
                            <i class="bi bi-person me-2"></i>
                            Customer
                        </h6>

                    </div>


                    <div class="card-body">

                        <label class="form-label">
                            Pemilik Undangan
                            <span class="text-danger">*</span>
                        </label>

                        <select name="user_id"
                                class="form-select @error('user_id') is-invalid @enderror">

                            <option value="">
                                -- Pilih Customer --
                            </option>

                            @foreach($customers as $customer)

                                <option value="{{ $customer->id }}"
                                    {{ old('user_id') == $customer->id ? 'selected' : '' }}>

                                    {{ $customer->name }}
                                    - {{ $customer->email }}

                                </option>

                            @endforeach

                        </select>

                        @error('user_id')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror

                    </div>

                </div>


                {{-- Template --}}
                <div class="card border-0 shadow-sm mb-4">

                    <div class="card-header bg-white py-3">

                        <h6 class="fw-bold mb-0">
                            <i class="bi bi-palette me-2"></i>
                            Template
                        </h6>

                    </div>


                    <div class="card-body">

                        <label class="form-label">
                            Pilih Template
                            <span class="text-danger">*</span>
                        </label>

                        <select name="template_id"
                                class="form-select @error('template_id') is-invalid @enderror">

                            <option value="">
                                -- Pilih Template --
                            </option>

                            @foreach($templates as $template)

                                <option value="{{ $template->id }}"
                                    {{ old('template_id') == $template->id ? 'selected' : '' }}>

                                    {{ $template->name }}

                                </option>

                            @endforeach

                        </select>

                        @error('template_id')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror

                    </div>

                </div>


                {{-- Status --}}
                <div class="card border-0 shadow-sm mb-4">

                    <div class="card-header bg-white py-3">

                        <h6 class="fw-bold mb-0">
                            <i class="bi bi-toggle-on me-2"></i>
                            Pengaturan
                        </h6>

                    </div>


                    <div class="card-body">

                        <div class="mb-3">

                            <label class="form-label">
                                Status
                            </label>

                            <select name="status"
                                    class="form-select">

                                <option value="active"
                                    {{ old('status', 'active') === 'active' ? 'selected' : '' }}>
                                    Aktif
                                </option>

                                <option value="inactive"
                                    {{ old('status') === 'inactive' ? 'selected' : '' }}>
                                    Nonaktif
                                </option>

                            </select>

                        </div>


                        <div>

                            <label class="form-label">
                                Expired
                            </label>

                            <input type="datetime-local"
                                   name="expired_at"
                                   value="{{ old('expired_at') }}"
                                   class="form-control">

                            <small class="text-muted">
                                Kosongkan jika tidak memiliki batas waktu.
                            </small>

                        </div>

                    </div>

                </div>


                {{-- Submit --}}
                <div class="card border-0 shadow-sm">

                    <div class="card-body">

                        <button type="submit"
                                class="btn btn-primary w-100">

                            <i class="bi bi-check-lg me-1"></i>
                            Simpan Undangan

                        </button>

                    </div>

                </div>

            </div>

        </div>

    </form>

</div>

@endsection


@push('scripts')

<script>

document.getElementById('cover_image')
    .addEventListener('change', function(event) {

        const file = event.target.files[0];

        const preview =
            document.getElementById('coverPreview');

        if (file) {

            preview.src =
                URL.createObjectURL(file);

            preview.classList.remove('d-none');

        } else {

            preview.src = '';

            preview.classList.add('d-none');

        }

    });


/*
|--------------------------------------------------------------------------
| Auto Slug
|--------------------------------------------------------------------------
*/

const groom =
    document.querySelector('[name="groom_name"]');

const bride =
    document.querySelector('[name="bride_name"]');

const slug =
    document.getElementById('slug');

function generateSlug() {

    if (slug.dataset.manual === 'true') {
        return;
    }

    const groomName =
        groom.value.trim();

    const brideName =
        bride.value.trim();

    if (!groomName && !brideName) {
        return;
    }

    slug.value =
        (groomName + '-dan-' + brideName)
        .toLowerCase()
        .replace(/[^a-z0-9]+/g, '-')
        .replace(/^-+|-+$/g, '');
}

groom.addEventListener(
    'input',
    generateSlug
);

bride.addEventListener(
    'input',
    generateSlug
);

slug.addEventListener(
    'input',
    function() {
        this.dataset.manual = 'true';
    }
);

</script>

@endpush