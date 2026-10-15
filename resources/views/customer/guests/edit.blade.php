
@extends('customer.layouts.app')

@section('title', 'Edit Tamu')
@section('page-heading', 'Edit Tamu')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/customer/guest-form.css') }}">
@endpush

@section('content')

<div class="welcome-section">
    <h2>Edit Tamu</h2>
    <p>Perbarui nama tamu undangan Anda.</p>
</div>

<div class="section-card">
    <div class="section-card-header">
        <h5>Formulir Edit Tamu</h5>
    </div>

    <div class="section-card-body">
        <form action="{{ route('customer.guests.update', $guest->id) }}"
              method="POST">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label for="invitation_name">Undangan</label>

                <input
                    type="text"
                    id="invitation_name"
                    class="form-control"
                    value="{{ $guest->invitation->groom_name }} & {{ $guest->invitation->bride_name }}"
                    readonly
                >
            </div>

            <div class="form-group">
                <label for="guest_name">Nama Tamu</label>

                <input
                    type="text"
                    name="guest_name"
                    id="guest_name"
                    class="form-control @error('guest_name') is-invalid @enderror"
                    value="{{ old('guest_name', $guest->guest_name) }}"
                    maxlength="255"
                    required
                >

                @error('guest_name')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-actions">
                <a href="{{ route('customer.guests') }}"
                   class="btn btn-cancel">
                    Batal
                </a>

                <button type="submit" class="btn btn-save">
                    <i class="fas fa-save mr-1"></i>
                    Simpan Perubahan
                </button>
            </div>
        </form>
    </div>
</div>

@endsection
