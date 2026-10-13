@extends('customer.layouts.app')

@section('title', 'Tambah Tamu')
@section('page-heading', 'Tambah Tamu')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/customer/guest-form.css') }}">
@endpush

@section('content')

<div class="welcome-section">
    <h2>Tambah Tamu</h2>
    <p>Masukkan nama tamu dan pilih undangan yang akan dibagikan.</p>
</div>

<div class="section-card">
    <div class="section-card-header">
        <h5>Formulir Tamu</h5>
    </div>

    <div class="section-card-body">

        @if ($invitations->isEmpty())
            <div class="alert alert-warning">
                Anda belum memiliki undangan. Pastikan undangan sudah dibuat
                sebelum menambahkan tamu.
            </div>

            <a href="{{ route('customer.guests') }}" class="btn btn-secondary">
                Kembali
            </a>
        @else
            <form action="{{ route('customer.guests.store') }}" method="POST">
                @csrf

                <div class="form-group">
                    <label for="invitation_id">Pilih Undangan</label>

                    <select
                        name="invitation_id"
                        id="invitation_id"
                        class="form-control @error('invitation_id') is-invalid @enderror"
                        required
                    >
                        <option value="">-- Pilih Undangan --</option>

                        @foreach ($invitations as $invitation)
                            <option
                                value="{{ $invitation->id }}"
                                {{ old('invitation_id') == $invitation->id ? 'selected' : '' }}
                            >
                                {{ $invitation->groom_name }}
                                &amp;
                                {{ $invitation->bride_name }}
                            </option>
                        @endforeach
                    </select>

                    @error('invitation_id')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="guest_name">Nama Tamu</label>

                    <input
                        type="text"
                        name="guest_name"
                        id="guest_name"
                        class="form-control @error('guest_name') is-invalid @enderror"
                        value="{{ old('guest_name') }}"
                        placeholder="Contoh: Bapak Andi dan Keluarga"
                        maxlength="255"
                        required
                    >

                    @error('guest_name')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-actions">
                    <a href="{{ route('customer.guests') }}" class="btn btn-cancel">
                        Batal
                    </a>

                    <button type="submit" class="btn btn-save">
                        <i class="fas fa-save mr-1"></i>
                        Simpan Tamu
                    </button>
                </div>
            </form>
        @endif

    </div>
</div>

@endsection
