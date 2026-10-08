@extends('admin.layouts.app')

@section('page-title', 'Tambah Undangan')

@section('content')

<div class="container-fluid">

    <div class="card border-0 shadow-sm">

        <div class="card-header bg-white py-3">

            <h5 class="mb-0">
                <i class="bi bi-envelope-heart me-2"></i>
                Tambah Undangan
            </h5>

        </div>


        <form
            action="{{ route('admin.invitations.store') }}"
            method="POST"
            enctype="multipart/form-data"
        >

            @csrf


            <div class="card-body">

                {{-- ERROR --}}
                @if($errors->any())

                    <div class="alert alert-danger">

                        <strong>
                            Terdapat kesalahan:
                        </strong>

                        <ul class="mb-0 mt-2">

                            @foreach($errors->all() as $error)

                                <li>
                                    {{ $error }}
                                </li>

                            @endforeach

                        </ul>

                    </div>

                @endif


                {{-- CUSTOMER & TEMPLATE --}}
                <div class="row">

                    <div class="col-md-6 mb-3">

                        <label class="form-label">
                            Customer
                            <span class="text-danger">*</span>
                        </label>

                        <select
                            name="user_id"
                            class="form-select"
                            required
                        >

                            <option value="">
                                -- Pilih Customer --
                            </option>

                            @foreach($customers as $customer)

                                <option
                                    value="{{ $customer->id }}"
                                    {{ old('user_id') == $customer->id ? 'selected' : '' }}
                                >
                                    {{ $customer->name }}
                                    -
                                    {{ $customer->email }}
                                </option>

                            @endforeach

                        </select>

                    </div>


                    <div class="col-md-6 mb-3">

                        <label class="form-label">
                            Template
                            <span class="text-danger">*</span>
                        </label>

                        <select
                            name="template_id"
                            class="form-select"
                            required
                        >

                            <option value="">
                                -- Pilih Template --
                            </option>

                            @foreach($templates as $template)

                                <option
                                    value="{{ $template->id }}"
                                    {{ old('template_id') == $template->id ? 'selected' : '' }}
                                >
                                    {{ $template->name }}
                                </option>

                            @endforeach

                        </select>

                    </div>

                </div>


                {{-- NAMA MEMPELAI --}}
                <div class="row">

                    <div class="col-md-6 mb-3">

                        <label class="form-label">
                            Nama Mempelai Pria
                            <span class="text-danger">*</span>
                        </label>

                        <input
                            type="text"
                            name="groom_name"
                            class="form-control"
                            value="{{ old('groom_name') }}"
                            placeholder="Contoh: Ahmad"
                            required
                        >

                    </div>


                    <div class="col-md-6 mb-3">

                        <label class="form-label">
                            Nama Mempelai Wanita
                            <span class="text-danger">*</span>
                        </label>

                        <input
                            type="text"
                            name="bride_name"
                            class="form-control"
                            value="{{ old('bride_name') }}"
                            placeholder="Contoh: Siti"
                            required
                        >

                    </div>

                </div>
                


                {{-- SLUG --}}
                <div class="mb-3">

                    <label class="form-label">
                        Slug Undangan
                    </label>

                    <input
                        type="text"
                        name="slug"
                        id="slug"
                        class="form-control"
                        value="{{ old('slug') }}"
                        placeholder="Contoh: ahmad-siti"
                    >

                    <small class="text-muted">
                        Kosongkan untuk dibuat otomatis.
                    </small>

                </div>


                {{-- TANGGAL --}}
                <div class="row">

                    <div class="col-md-4 mb-3">

                        <label class="form-label">
                            Tanggal Pernikahan
                            <span class="text-danger">*</span>
                        </label>

                        <input
                            type="date"
                            name="wedding_date"
                            class="form-control"
                            value="{{ old('wedding_date') }}"
                            required
                        >

                    </div>


                    <div class="col-md-4 mb-3">

                        <label class="form-label">
                            Akad Nikah
                        </label>

                        <input
                            type="datetime-local"
                            name="akad_date"
                            class="form-control"
                            value="{{ old('akad_date') }}"
                        >

                    </div>


                    <div class="col-md-4 mb-3">

                        <label class="form-label">
                            Resepsi
                        </label>

                        <input
                            type="datetime-local"
                            name="reception_date"
                            class="form-control"
                            value="{{ old('reception_date') }}"
                        >

                    </div>

                </div>

                {{-- Love Story --}}

                <div class="card border-0 shadow-sm mt-4">
                    <div class="card-header bg-white">
                        <h5 class="mb-0">
                            <i class="bi bi-heart me-2"></i>
                            Profil Mempelai
                        </h5>
                    </div>

                    <div class="card-body">

                        <div class="row">

                            {{-- Mempelai Pria --}}
                            <div class="col-md-6 mb-4">

                                <h6 class="fw-bold mb-3">
                                    Mempelai Pria
                                </h6>

                                <div class="mb-3">
                                    <label class="form-label">
                                        Foto Mempelai Pria
                                    </label>

                                    <input
                                        type="file"
                                        name="groom_photo"
                                        id="groom_photo"
                                        class="form-control"
                                        accept="image/*"
                                    >

                                    <div class="mt-3">
                                        <img
                                            id="groomPhotoPreview"
                                            src=""
                                            class="img-fluid rounded"
                                            style="
                                                max-height:250px;
                                                display:none;
                                            "
                                        >
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label">
                                        Profil Mempelai Pria
                                    </label>

                                    <textarea
                                        name="groom_profile"
                                        class="form-control"
                                        rows="5"
                                        placeholder="Contoh: Putra pertama dari Bapak ... dan Ibu ..."
                                    ></textarea>
                                </div>

                            </div>

                            {{-- Mempelai Wanita --}}
                            <div class="col-md-6 mb-4">

                                <h6 class="fw-bold mb-3">
                                    Mempelai Wanita
                                </h6>

                                <div class="mb-3">
                                    <label class="form-label">
                                        Foto Mempelai Wanita
                                    </label>

                                    <input
                                        type="file"
                                        name="bride_photo"
                                        id="bride_photo"
                                        class="form-control"
                                        accept="image/*"
                                    >

                                    <div class="mt-3">
                                        <img
                                            id="bridePhotoPreview"
                                            src=""
                                            class="img-fluid rounded"
                                            style="
                                                max-height:250px;
                                                display:none;
                                            "
                                        >
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label">
                                        Profil Mempelai Wanita
                                    </label>

                                    <textarea
                                        name="bride_profile"
                                        class="form-control"
                                        rows="5"
                                        placeholder="Contoh: Putri pertama dari Bapak ... dan Ibu ..."
                                    ></textarea>
                                </div>

                            </div>

                        </div>

                        <hr>

                        <div class="mb-3">
                            <label class="form-label">
                                Love Story
                            </label>

                            <textarea
                                name="love_story"
                                class="form-control"
                                rows="7"
                                placeholder="Ceritakan perjalanan kisah cinta kedua mempelai..."
                            ></textarea>
                        </div>

                    </div>
                </div>


                {{-- =====================================================
                     LOKASI
                ====================================================== --}}

                <hr class="my-4">

                <h5 class="mb-3">
                    <i class="bi bi-geo-alt me-2"></i>
                    Lokasi Acara
                </h5>


                <div class="row">

                    {{-- NAMA LOKASI --}}
                    <div class="col-md-6 mb-3">

                        <label class="form-label">
                            Nama Lokasi
                            <span class="text-danger">*</span>
                        </label>

                        <input
                            type="text"
                            name="location_name"
                            id="location_name"
                            class="form-control"
                            value="{{ old('location_name') }}"
                            placeholder="Contoh: Gedung Graha"
                            required
                        >

                    </div>


                    {{-- ALAMAT --}}
                    <div class="col-md-6 mb-3">

                        <label class="form-label">
                            Alamat Lengkap
                        </label>

                        <textarea
                            name="address"
                            id="address"
                            class="form-control"
                            rows="2"
                            placeholder="Contoh: Jl. Raya Surabaya No. 10"
                        >{{ old('address') }}</textarea>

                    </div>

                </div>


                {{-- GOOGLE MAPS --}}
                <div class="mb-3">

                    <label class="form-label">

                        Link Google Maps

                    </label>

                    <input
                        type="url"
                        name="google_maps"
                        id="google_maps"
                        class="form-control"
                        value="{{ old('google_maps') }}"
                        placeholder="https://maps.google.com/..."
                    >

                    <div class="form-text">

                        Buka Google Maps → pilih lokasi →
                        <strong>Bagikan</strong> →
                        <strong>Salin link</strong>.

                    </div>

                </div>


                {{-- MAP PREVIEW --}}
                <div class="mb-4">

                    <label class="form-label">
                        Preview Lokasi
                    </label>

                    <div
                        id="mapPreview"
                        class="map-preview"
                    >

                        <div class="map-empty">

                            <i class="bi bi-geo-alt"></i>

                            <p>
                                Masukkan nama lokasi dan alamat
                                untuk melihat preview Maps.
                            </p>

                        </div>

                    </div>

                </div>


                {{-- COVER --}}
                <hr class="my-4">

                <h5 class="mb-3">
                    <i class="bi bi-image me-2"></i>
                    Media Undangan
                </h5>


                <div class="row">

                    <div class="col-md-6 mb-3">

                        <label class="form-label">
                            Cover Image
                        </label>

                        <input
                            type="file"
                            name="cover_image"
                            id="cover_image"
                            class="form-control"
                            accept=".jpg,.jpeg,.png,.webp"
                        >

                        <div class="mt-3">

                            <img
                                id="coverPreview"
                                src=""
                                class="img-fluid rounded d-none"
                                style="max-height:250px;"
                            >

                        </div>

                    </div>


                    <div class="col-md-6 mb-3">

                        <label class="form-label">
                            Musik
                        </label>

                        <input
                            type="file"
                            name="music"
                            class="form-control"
                            accept=".mp3,.wav,.ogg"
                        >

                    </div>

                </div>


                {{-- STATUS & EXPIRED --}}
                <div class="row">

                    <div class="col-md-6 mb-3">

                        <label class="form-label">
                            Status
                            <span class="text-danger">*</span>
                        </label>

                        <select
                            name="status"
                            class="form-select"
                            required
                        >

                            <option
                                value="active"
                                {{ old('status', 'active') == 'active' ? 'selected' : '' }}
                            >
                                Active
                            </option>

                            <option
                                value="inactive"
                                {{ old('status') == 'inactive' ? 'selected' : '' }}
                            >
                                Inactive
                            </option>

                        </select>

                    </div>


                    <div class="col-md-6 mb-3">

                        <label class="form-label">
                            Expired
                        </label>

                        <input
                            type="datetime-local"
                            name="expired_at"
                            class="form-control"
                            value="{{ old('expired_at') }}"
                        >

                    </div>

                </div>

            </div>


            {{-- FOOTER --}}
            <div class="card-footer bg-white d-flex justify-content-end gap-2">

                <a
                    href="{{ route('admin.invitations.index') }}"
                    class="btn btn-secondary"
                >
                    Batal
                </a>

                <button
                    type="submit"
                    class="btn btn-primary"
                >
                    <i class="bi bi-save me-1"></i>
                    Simpan Undangan
                </button>

            </div>

        </form>

    </div>

</div>


<style>

.map-preview {
    width: 100%;
    height: 400px;
    background: #f1f1f1;
    border-radius: 8px;
    overflow: hidden;
    border: 1px solid #dee2e6;
}

.map-preview iframe {
    width: 100%;
    height: 100%;
    border: 0;
}

.map-empty {
    height: 100%;

    display: flex;
    flex-direction: column;

    align-items: center;
    justify-content: center;

    text-align: center;

    color: #6c757d;
}

.map-empty i {
    font-size: 45px;
    margin-bottom: 10px;
}

</style>

@endsection


@push('scripts')

<script>

document.addEventListener('DOMContentLoaded', function () {

    /*
    |--------------------------------------------------------------------------
    | AUTO SLUG
    |--------------------------------------------------------------------------
    */

    const groomInput = document.querySelector('[name="groom_name"]');
    const brideInput = document.querySelector('[name="bride_name"]');
    const slugInput = document.getElementById('slug');

    let slugManual = false;

    function generateSlug(text) {

        return text
            .toLowerCase()
            .trim()
            .replace(/[^a-z0-9\s-]/g, '')
            .replace(/\s+/g, '-')
            .replace(/-+/g, '-');

    }

    function updateSlug() {

        // Kalau slug pernah diedit manual, jangan otomatis ubah
        if (slugManual) {
            return;
        }

        const groom = groomInput.value.trim();
        const bride = brideInput.value.trim();

        // Kalau kedua nama kosong
        if (!groom && !bride) {
            slugInput.value = '';
            return;
        }

        let names = '';

        if (groom) {
            names += groom;
        }

        if (bride) {
            names += (names ? ' ' : '') + bride;
        }

        slugInput.value = generateSlug(names);
    }

    /*
    | Deteksi jika admin mengubah slug secara manual
    */

    slugInput.addEventListener('input', function () {

        const groom = groomInput.value.trim();
        const bride = brideInput.value.trim();

        const automaticSlug = generateSlug(
            [groom, bride].filter(Boolean).join(' ')
        );

        // Jika slug berbeda dari hasil otomatis,
        // berarti admin mengubahnya secara manual
        if (slugInput.value !== automaticSlug) {
            slugManual = true;
        }

        // Jika dikosongkan lagi, aktifkan auto slug
        if (slugInput.value.trim() === '') {
            slugManual = false;
            updateSlug();
        }

    });

    groomInput.addEventListener('input', updateSlug);
    brideInput.addEventListener('input', updateSlug);


    /*
    |--------------------------------------------------------------------------
    | MAP PREVIEW
    |--------------------------------------------------------------------------
    */

    const locationInput =
        document.getElementById('location_name');

    const addressInput =
        document.getElementById('address');

    const mapPreview =
        document.getElementById('mapPreview');


    function updateMap() {

        const location =
            locationInput.value.trim();

        const address =
            addressInput.value.trim();


        if (!location && !address) {

            mapPreview.innerHTML = `
                <div class="map-empty">

                    <i class="bi bi-geo-alt"></i>

                    <p>
                        Masukkan nama lokasi dan alamat
                        untuk melihat preview Maps.
                    </p>

                </div>
            `;

            return;
        }


        let query = location;


        if (address) {
            query += ', ' + address;
        }


        const embedUrl =
            'https://www.google.com/maps?q=' +
            encodeURIComponent(query) +
            '&output=embed';


        mapPreview.innerHTML = `

            <iframe
                src="${embedUrl}"
                loading="lazy"
                allowfullscreen
                referrerpolicy="no-referrer-when-downgrade">
            </iframe>

        `;

    }


    locationInput.addEventListener(
        'input',
        updateMap
    );

    addressInput.addEventListener(
        'input',
        updateMap
    );


    /*
    |--------------------------------------------------------------------------
    | COVER PREVIEW
    |--------------------------------------------------------------------------
    */

    const coverInput =
        document.getElementById('cover_image');

    const coverPreview =
        document.getElementById('coverPreview');


    coverInput.addEventListener(
        'change',
        function (event) {

            const file =
                event.target.files[0];

            if (!file) {

                coverPreview.classList.add(
                    'd-none'
                );

                return;
            }


            const reader =
                new FileReader();


            reader.onload =
                function (e) {

                    coverPreview.src =
                        e.target.result;

                    coverPreview.classList.remove(
                        'd-none'
                    );

                };


            reader.readAsDataURL(file);

        }
    );

});

function previewImage(input, previewId) {
    const preview = document.getElementById(previewId);

    if (input.files && input.files[0]) {
        const reader = new FileReader();

        reader.onload = function (e) {
            preview.src = e.target.result;
            preview.style.display = 'block';
        };

        reader.readAsDataURL(input.files[0]);
    }
}

document
    .getElementById('groom_photo')
    .addEventListener('change', function () {
        previewImage(
            this,
            'groomPhotoPreview'
        );
    });

document
    .getElementById('bride_photo')
    .addEventListener('change', function () {
        previewImage(
            this,
            'bridePhotoPreview'
        );
    });

</script>

@endpush