@extends('admin.layouts.app')

@section('page-title', 'Galeri Undangan')

@section('content')

<div class="container-fluid">

    <div class="card border-0 shadow-sm">

        <div class="card-header bg-white py-3">

            <div class="d-flex justify-content-between align-items-center">

                <div>

                    <h5 class="mb-1">
                        <i class="bi bi-images me-2"></i>
                        Galeri Foto
                    </h5>

                    <small class="text-muted">
                        {{ $invitation->groom_name }}
                        &
                        {{ $invitation->bride_name }}
                    </small>

                </div>

                <a
                    href="{{ route('admin.invitations.index') }}"
                    class="btn btn-secondary btn-sm"
                >
                    <i class="bi bi-arrow-left me-1"></i>
                    Kembali
                </a>

            </div>

        </div>


        <div class="card-body">

            @if(session('success'))

                <div class="alert alert-success">
                    {{ session('success') }}
                </div>

            @endif


            @if($errors->any())

                <div class="alert alert-danger">

                    @foreach($errors->all() as $error)

                        <div>
                            {{ $error }}
                        </div>

                    @endforeach

                </div>

            @endif


            {{-- UPLOAD --}}
            <form
                action="{{ route(
                    'admin.invitations.galleries.store',
                    $invitation
                ) }}"
                method="POST"
                enctype="multipart/form-data"
                class="mb-5"
            >

                @csrf

                <div class="mb-3">

                    <label class="form-label fw-semibold">
                        Upload Foto
                    </label>

                    <input
                        type="file"
                        name="images[]"
                        id="images"
                        class="form-control"
                        accept=".jpg,.jpeg,.png,.webp"
                        multiple
                        required
                    >

                    <small class="text-muted">
                        Bisa memilih beberapa foto sekaligus.
                        Maksimal 5 MB per foto.
                    </small>

                </div>


                <div
                    id="previewContainer"
                    class="row g-3 mb-3"
                ></div>


                <button
                    type="submit"
                    class="btn btn-primary"
                >
                    <i class="bi bi-upload me-1"></i>
                    Upload Foto
                </button>

            </form>


            <hr>


            {{-- GALLERY --}}
            <div class="row g-4 mt-2">

                @forelse($invitation->galleries as $gallery)

                    <div class="col-md-3 col-sm-6">

                        <div class="card border-0 shadow-sm h-100">

                            <div
                                style="
                                    height:220px;
                                    overflow:hidden;
                                    background:#f1f1f1;
                                "
                            >

                                <img
                                    src="{{ asset(
                                        'storage/' .
                                        $gallery->image
                                    ) }}"
                                    alt="Gallery"
                                    style="
                                        width:100%;
                                        height:100%;
                                        object-fit:cover;
                                    "
                                >

                            </div>


                            <div class="card-body text-center">

                                <form
                                    action="{{ route(
                                        'admin.galleries.destroy',
                                        $gallery
                                    ) }}"
                                    method="POST"
                                    class="delete-gallery-form"
                                >

                                    @csrf

                                    @method('DELETE')

                                    <button
                                        type="submit"
                                        class="btn btn-outline-danger btn-sm"
                                    >
                                        <i class="bi bi-trash me-1"></i>
                                        Hapus
                                    </button>

                                </form>

                            </div>

                        </div>

                    </div>

                @empty

                    <div class="col-12">

                        <div class="text-center py-5 text-muted">

                            <i
                                class="bi bi-images"
                                style="font-size:50px;"
                            ></i>

                            <p class="mt-3 mb-0">
                                Belum ada foto galeri.
                            </p>

                        </div>

                    </div>

                @endforelse

            </div>

        </div>

    </div>

</div>

@endsection


@push('scripts')

<script>

document.addEventListener(
    'DOMContentLoaded',
    function () {

        const input =
            document.getElementById('images');

        const preview =
            document.getElementById(
                'previewContainer'
            );


        input.addEventListener(
            'change',
            function () {

                preview.innerHTML = '';


                Array.from(
                    input.files
                ).forEach(function (file) {

                    const reader =
                        new FileReader();


                    reader.onload =
                        function (event) {

                            preview.innerHTML += `

                                <div class="col-md-3 col-sm-6">

                                    <div class="card border">

                                        <img
                                            src="${event.target.result}"
                                            style="
                                                width:100%;
                                                height:180px;
                                                object-fit:cover;
                                            "
                                        >

                                        <div class="card-body p-2">

                                            <small class="text-muted">
                                                ${file.name}
                                            </small>

                                        </div>

                                    </div>

                                </div>

                            `;

                        };


                    reader.readAsDataURL(file);

                });

            }
        );


        /*
        |--------------------------------------------------------------------------
        | DELETE CONFIRMATION
        |--------------------------------------------------------------------------
        */

        document
            .querySelectorAll(
                '.delete-gallery-form'
            )
            .forEach(function (form) {

                form.addEventListener(
                    'submit',
                    function (event) {

                        event.preventDefault();


                        if (
                            confirm(
                                'Apakah Anda yakin ingin menghapus foto ini?'
                            )
                        ) {

                            form.submit();

                        }

                    }
                );

            });

    }
);

</script>

@endpush