
@extends('customer.layouts.app')

@section('title', 'Buat Undangan')

@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h3 class="font-weight-bold mb-1">Buat Undangan Digital</h3>
            <p class="text-muted mb-0">
                Isi data mempelai untuk membuat undangan digital.
            </p>
        </div>

        <a href="{{ route('customer.invitations') }}"
           class="btn btn-secondary">
            <i class="fas fa-arrow-left mr-1"></i> Kembali
        </a>
    </div>

    @if ($errors->any())
        <div class="alert alert-danger">
            <strong>Periksa kembali data berikut:</strong>
            <ul class="mb-0 mt-2">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('customer.invitations.store') }}"
          method="POST"
          enctype="multipart/form-data">
        @csrf

        {{-- PILIH TEMPLATE --}}
        <div class="card shadow-sm mb-4">
            <div class="card-header bg-white">
                <h5 class="mb-0 font-weight-bold">1. Pilih Template</h5>
            </div>

            <div class="card-body">
                @if ($templates->isEmpty())
                    <div class="alert alert-warning mb-0">
                        Belum ada template aktif. Silakan hubungi admin.
                    </div>
                @else
                    <div class="form-group">
                        <label for="template_id">Template Undangan <span class="text-danger">*</span></label>
                        <select name="template_id"
                                id="template_id"
                                class="form-control"
                                required>
                            <option value="">-- Pilih Template --</option>
                            @foreach ($templates as $template)
                                <option value="{{ $template->id }}"
                                    {{ old('template_id') == $template->id ? 'selected' : '' }}>
                                    {{ $template->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                @endif
            </div>
        </div>

        {{-- DATA MEMPELAI --}}
        <div class="card shadow-sm mb-4">
            <div class="card-header bg-white">
                <h5 class="mb-0 font-weight-bold">2. Data Mempelai</h5>
            </div>

            <div class="card-body">
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="groom_name">Nama Mempelai Pria <span class="text-danger">*</span></label>
                        <input type="text"
                               name="groom_name"
                               id="groom_name"
                               class="form-control"
                               value="{{ old('groom_name') }}"
                               required>
                    </div>

                    <div class="form-group col-md-6">
                        <label for="bride_name">Nama Mempelai Wanita <span class="text-danger">*</span></label>
                        <input type="text"
                               name="bride_name"
                               id="bride_name"
                               class="form-control"
                               value="{{ old('bride_name') }}"
                               required>
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="groom_photo">Foto Mempelai Pria</label>
                        <input type="file"
                               name="groom_photo"
                               id="groom_photo"
                               class="form-control-file"
                               accept=".jpg,.jpeg,.png,.webp">
                    </div>

                    <div class="form-group col-md-6">
                        <label for="bride_photo">Foto Mempelai Wanita</label>
                        <input type="file"
                               name="bride_photo"
                               id="bride_photo"
                               class="form-control-file"
                               accept=".jpg,.jpeg,.png,.webp">
                    </div>
                </div>

                <div class="form-group">
                    <label for="groom_profile">Profil Mempelai Pria</label>
                    <textarea name="groom_profile"
                              id="groom_profile"
                              class="form-control"
                              rows="3">{{ old('groom_profile') }}</textarea>
                </div>

                <div class="form-group">
                    <label for="bride_profile">Profil Mempelai Wanita</label>
                    <textarea name="bride_profile"
                              id="bride_profile"
                              class="form-control"
                              rows="3">{{ old('bride_profile') }}</textarea>
                </div>

                <div class="form-group mb-0">
                    <label for="love_story">Cerita Cinta</label>
                    <textarea name="love_story"
                              id="love_story"
                              class="form-control"
                              rows="4">{{ old('love_story') }}</textarea>
                </div>
            </div>
        </div>

        {{-- TANGGAL DAN LOKASI --}}
        <div class="card shadow-sm mb-4">
            <div class="card-header bg-white">
                <h5 class="mb-0 font-weight-bold">3. Tanggal dan Lokasi</h5>
            </div>

            <div class="card-body">
                <div class="form-group">
                    <label for="wedding_date">Tanggal Pernikahan <span class="text-danger">*</span></label>
                    <input type="date"
                           name="wedding_date"
                           id="wedding_date"
                           class="form-control"
                           value="{{ old('wedding_date') }}"
                           required>
                </div>

                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="akad_date">Tanggal Akad</label>
                        <input type="date"
                               name="akad_date"
                               id="akad_date"
                               class="form-control"
                               value="{{ old('akad_date') }}">
                    </div>

                    <div class="form-group col-md-6">
                        <label for="reception_date">Tanggal Resepsi</label>
                        <input type="date"
                               name="reception_date"
                               id="reception_date"
                               class="form-control"
                               value="{{ old('reception_date') }}">
                    </div>
                </div>

                <div class="form-group">
                    <label for="location_name">Nama Tempat <span class="text-danger">*</span></label>
                    <input type="text"
                           name="location_name"
                           id="location_name"
                           class="form-control"
                           value="{{ old('location_name') }}"
                           placeholder="Contoh: Gedung Graha ..."
                           required>
                </div>

                <div class="form-group">
                    <label for="address">Alamat Lengkap</label>
                    <textarea name="address"
                              id="address"
                              class="form-control"
                              rows="3">{{ old('address') }}</textarea>
                </div>

                <div class="form-group mb-0">
                    <label for="google_maps">Link Google Maps</label>
                    <input type="url"
                           name="google_maps"
                           id="google_maps"
                           class="form-control"
                           value="{{ old('google_maps') }}"
                           placeholder="https://maps.google.com/...">
                    <small class="form-text text-muted">
                        Masukkan link Google Maps lokasi acara jika tersedia.
                    </small>
                </div>
            </div>
        </div>

        {{-- COVER DAN MUSIK --}}
        <div class="card shadow-sm mb-4">
            <div class="card-header bg-white">
                <h5 class="mb-0 font-weight-bold">4. Cover dan Musik</h5>
            </div>

            <div class="card-body">
                <div class="form-group">
                    <label for="cover_image">Foto Cover Undangan</label>
                    <input type="file"
                           name="cover_image"
                           id="cover_image"
                           class="form-control-file"
                           accept=".jpg,.jpeg,.png,.webp">
                </div>

                <div class="form-group mb-0">
                    <label for="music">Musik Undangan</label>
                    <input type="file"
                           name="music"
                           id="music"
                           class="form-control-file"
                           accept=".mp3,.wav,.ogg">
                </div>
            </div>
        </div>

        <div class="d-flex justify-content-end mb-4">
            <button type="submit"
                    class="btn btn-primary px-4">
                <i class="fas fa-save mr-1"></i> Simpan Undangan
            </button>
        </div>
    </form>
</div>
@endsection
