@extends('admin.layouts.app')

@section('page-title', 'Edit Undangan')

@section('content')

<div class="container-fluid">

    <div class="card border-0 shadow-sm">

        <div class="card-header bg-white py-3">

            <h5 class="mb-0">

                <i class="bi bi-pencil-square me-2"></i>

                Edit Undangan

            </h5>

        </div>


        <form
            action="{{ route('admin.invitations.update', $invitation) }}"
            method="POST"
            enctype="multipart/form-data"
        >

            @csrf

            @method('PUT')


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
                                    {{ old('user_id', $invitation->user_id) == $customer->id ? 'selected' : '' }}
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
                                    {{ old('template_id', $invitation->template_id) == $template->id ? 'selected' : '' }}
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
                            value="{{ old('groom_name', $invitation->groom_name) }}"
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
                            value="{{ old('bride_name', $invitation->bride_name) }}"
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
                        value="{{ old('slug', $invitation->slug) }}"
                    >

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
                            value="{{ old(
                                'wedding_date',
                                $invitation->wedding_date?->format('Y-m-d')
                            ) }}"
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
                            value="{{ old(
                                'akad_date',
                                $invitation->akad_date?->format('Y-m-d\TH:i')
                            ) }}"
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
                            value="{{ old(
                                'reception_date',
                                $invitation->reception_date?->format('Y-m-d\TH:i')
                            ) }}"
                        >

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
                            value="{{ old(
                                'location_name',
                                $invitation->location_name
                            ) }}"
                            required
                        >

                    </div>


                    <div class="col-md-6 mb-3">

                        <label class="form-label">
                            Alamat Lengkap
                        </label>

                        <textarea
                            name="address"
                            id="address"
                            class="form-control"
                            rows="2"
                        >{{ old(
                            'address',
                            $invitation->address
                        ) }}</textarea>

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
                        value="{{ old(
                            'google_maps',
                            $invitation->google_maps
                        ) }}"
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
                    ></div>

                </div>


                {{-- MEDIA --}}
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


                        @if($invitation->cover_image)

                            <div class="mt-3">

                                <p class="text-muted mb-2">
                                    Cover saat ini:
                                </p>

                                <img
                                    src="{{ asset(
                                        'storage/' .
                                        $invitation->cover_image
                                    ) }}"
                                    class="img-fluid rounded"
                                    style="max-height:250px;"
                                >

                            </div>

                        @endif


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


                        @if($invitation->music)

                            <div class="mt-3">

                                <audio
                                    controls
                                    class="w-100"
                                >

                                    <source
                                        src="{{ asset(
                                            'storage/' .
                                            $invitation->music
                                        ) }}"
                                    >

                                </audio>

                            </div>

                        @endif

                    </div>

                </div>


                {{-- STATUS --}}
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
                                {{ old(
                                    'status',
                                    $invitation->status
                                ) == 'active' ? 'selected' : '' }}
                            >
                                Active
                            </option>

                            <option
                                value="inactive"
                                {{ old(
                                    'status',
                                    $invitation->status
                                ) == 'inactive' ? 'selected' : '' }}
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
                            value="{{ old(
                                'expired_at',
                                $invitation->expired_at?->format('Y-m-d\TH:i')
                            ) }}"
                        >

                    </div>

                </div>

            </div>


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
                    Update Undangan
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

    const groomInput =
        document.querySelector('[name="groom_name"]');

    const brideInput =
        document.querySelector('[name="bride_name"]');

    const slugInput =
        document.getElementById('slug');

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

        // Jika slug sudah diedit manual,
        // jangan ubah otomatis
        if (slugManual) {
            return;
        }


        const groom =
            groomInput.value.trim();

        const bride =
            brideInput.value.trim();


        if (!groom && !bride) {

            slugInput.value = '';

            return;

        }


        const names =
            [groom, bride]
                .filter(Boolean)
                .join(' ');


        slugInput.value =
            generateSlug(names);

    }


    /*
    |--------------------------------------------------------------------------
    | NAMA MEMPELAI
    |--------------------------------------------------------------------------
    */

    groomInput.addEventListener(
        'input',
        updateSlug
    );

    brideInput.addEventListener(
        'input',
        updateSlug
    );


    /*
    |--------------------------------------------------------------------------
    | SLUG MANUAL
    |--------------------------------------------------------------------------
    */

    slugInput.addEventListener(
        'input',
        function () {

            const groom =
                groomInput.value.trim();

            const bride =
                brideInput.value.trim();


            const automaticSlug =
                generateSlug(
                    [groom, bride]
                        .filter(Boolean)
                        .join(' ')
                );


            /*
            | Jika berbeda dari slug otomatis,
            | berarti user mengubah manual
            */

            if (
                slugInput.value !== automaticSlug
            ) {

                slugManual = true;

            }


            /*
            | Jika dikosongkan,
            | aktifkan kembali auto slug
            */

            if (
                slugInput.value.trim() === ''
            ) {

                slugManual = false;

                updateSlug();

            }

        }
    );
    
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
    | LOAD EXISTING MAP
    |--------------------------------------------------------------------------
    */

    updateMap();


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

</script>

@endpush