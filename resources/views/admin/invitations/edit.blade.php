@extends('admin.layouts.app')

@section('page-title', 'Edit Undangan')

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
            Edit Undangan
        </h4>

        <p class="text-muted mb-0">
            Perbarui data undangan digital.
        </p>

    </div>


    <form action="{{ route('admin.invitations.update', $invitation) }}"
          method="POST"
          enctype="multipart/form-data">

        @csrf
        @method('PUT')


        <div class="row">

            {{-- ================================================= --}}
            {{-- LEFT --}}
            {{-- ================================================= --}}

            <div class="col-lg-8">


                {{-- DATA PENGANTIN --}}
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
                                       value="{{ old(
                                           'groom_name',
                                           $invitation->groom_name
                                       ) }}"
                                       class="form-control @error('groom_name') is-invalid @enderror">

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
                                       value="{{ old(
                                           'bride_name',
                                           $invitation->bride_name
                                       ) }}"
                                       class="form-control @error('bride_name') is-invalid @enderror">

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
                                           value="{{ old(
                                               'slug',
                                               $invitation->slug
                                           ) }}"
                                           class="form-control @error('slug') is-invalid @enderror">

                                </div>

                                @error('slug')

                                    <div class="text-danger small">
                                        {{ $message }}
                                    </div>

                                @enderror

                            </div>

                        </div>

                    </div>

                </div>


                {{-- WAKTU --}}
                <div class="card border-0 shadow-sm mb-4">

                    <div class="card-header bg-white py-3">

                        <h6 class="fw-bold mb-0">

                            <i class="bi bi-calendar-heart me-2"></i>

                            Waktu Pernikahan

                        </h6>

                    </div>


                    <div class="card-body">

                        <div class="row">


                            {{-- Wedding --}}
                            <div class="col-md-4 mb-3">

                                <label class="form-label">
                                    Tanggal Pernikahan
                                    <span class="text-danger">*</span>
                                </label>

                                <input type="date"
                                       name="wedding_date"
                                       value="{{ old(
                                           'wedding_date',
                                           optional($invitation->wedding_date)
                                               ->format('Y-m-d')
                                       ) }}"
                                       class="form-control">

                            </div>


                            {{-- Akad --}}
                            <div class="col-md-4 mb-3">

                                <label class="form-label">
                                    Akad Nikah
                                </label>

                                <input type="datetime-local"
                                       name="akad_date"
                                       value="{{ old(
                                           'akad_date',
                                           optional($invitation->akad_date)
                                               ->format('Y-m-d\TH:i')
                                       ) }}"
                                       class="form-control">

                            </div>


                            {{-- Reception --}}
                            <div class="col-md-4 mb-3">

                                <label class="form-label">
                                    Resepsi
                                </label>

                                <input type="datetime-local"
                                       name="reception_date"
                                       value="{{ old(
                                           'reception_date',
                                           optional($invitation->reception_date)
                                               ->format('Y-m-d\TH:i')
                                       ) }}"
                                       class="form-control">

                            </div>

                        </div>

                    </div>

                </div>


                {{-- LOKASI --}}
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
                                   value="{{ old(
                                       'location_name',
                                       $invitation->location_name
                                   ) }}"
                                   class="form-control">

                        </div>


                        <div class="mb-3">

                            <label class="form-label">
                                Alamat
                            </label>

                            <textarea name="address"
                                      rows="3"
                                      class="form-control">{{ old(
                                          'address',
                                          $invitation->address
                                      ) }}</textarea>

                        </div>


                        <div>

                            <label class="form-label">
                                Google Maps
                            </label>

                            <input type="text"
                                   name="google_maps"
                                   value="{{ old(
                                       'google_maps',
                                       $invitation->google_maps
                                   ) }}"
                                   class="form-control">

                        </div>

                    </div>

                </div>


                {{-- MEDIA --}}
                <div class="card border-0 shadow-sm mb-4">

                    <div class="card-header bg-white py-3">

                        <h6 class="fw-bold mb-0">

                            <i class="bi bi-images me-2"></i>

                            Media

                        </h6>

                    </div>


                    <div class="card-body">


                        {{-- Cover --}}
                        <div class="mb-4">

                            <label class="form-label">
                                Cover Undangan
                            </label>

                            @if($invitation->cover_image)

                                <div class="mb-3">

                                    <img src="{{ asset(
                                        'storage/' .
                                        $invitation->cover_image
                                    ) }}"
                                         class="img-fluid rounded"
                                         style="max-height:250px;">

                                </div>

                            @endif


                            <input type="file"
                                   name="cover_image"
                                   accept="image/*"
                                   class="form-control">

                            <small class="text-muted">
                                Kosongkan jika tidak ingin mengganti cover.
                            </small>

                        </div>


                        {{-- Music --}}
                        <div>

                            <label class="form-label">
                                Musik
                            </label>

                            @if($invitation->music)

                                <audio controls class="d-block mb-3">

                                    <source src="{{ asset(
                                        'storage/' .
                                        $invitation->music
                                    ) }}">

                                </audio>

                            @endif


                            <input type="file"
                                   name="music"
                                   accept=".mp3,.wav,.ogg"
                                   class="form-control">

                            <small class="text-muted">
                                Kosongkan jika tidak ingin mengganti musik.
                            </small>

                        </div>

                    </div>

                </div>

            </div>


            {{-- ================================================= --}}
            {{-- RIGHT --}}
            {{-- ================================================= --}}

            <div class="col-lg-4">


                {{-- CUSTOMER --}}
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
                                class="form-select">

                            @foreach($customers as $customer)

                                <option value="{{ $customer->id }}"
                                    {{ old(
                                        'user_id',
                                        $invitation->user_id
                                    ) == $customer->id
                                        ? 'selected'
                                        : '' }}>

                                    {{ $customer->name }}
                                    -
                                    {{ $customer->email }}

                                </option>

                            @endforeach

                        </select>

                    </div>

                </div>


                {{-- TEMPLATE --}}
                <div class="card border-0 shadow-sm mb-4">

                    <div class="card-header bg-white py-3">

                        <h6 class="fw-bold mb-0">

                            <i class="bi bi-palette me-2"></i>

                            Template

                        </h6>

                    </div>


                    <div class="card-body">

                        <label class="form-label">
                            Template
                            <span class="text-danger">*</span>
                        </label>

                        <select name="template_id"
                                class="form-select">

                            @foreach($templates as $template)

                                <option value="{{ $template->id }}"
                                    {{ old(
                                        'template_id',
                                        $invitation->template_id
                                    ) == $template->id
                                        ? 'selected'
                                        : '' }}>

                                    {{ $template->name }}

                                </option>

                            @endforeach

                        </select>

                    </div>

                </div>


                {{-- PENGATURAN --}}
                <div class="card border-0 shadow-sm mb-4">

                    <div class="card-header bg-white py-3">

                        <h6 class="fw-bold mb-0">

                            <i class="bi bi-gear me-2"></i>

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
                                    {{ old(
                                        'status',
                                        $invitation->status
                                    ) === 'active'
                                        ? 'selected'
                                        : '' }}>

                                    Aktif

                                </option>

                                <option value="inactive"
                                    {{ old(
                                        'status',
                                        $invitation->status
                                    ) === 'inactive'
                                        ? 'selected'
                                        : '' }}>

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
                                   value="{{ old(
                                       'expired_at',
                                       optional($invitation->expired_at)
                                           ->format('Y-m-d\TH:i')
                                   ) }}"
                                   class="form-control">

                        </div>

                    </div>

                </div>


                {{-- SAVE --}}
                <div class="card border-0 shadow-sm">

                    <div class="card-body">

                        <button type="submit"
                                class="btn btn-primary w-100">

                            <i class="bi bi-check-lg me-1"></i>

                            Simpan Perubahan

                        </button>

                    </div>

                </div>

            </div>

        </div>

    </form>

</div>

@endsection