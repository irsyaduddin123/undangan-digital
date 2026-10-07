@extends('admin.layouts.app')

@section('title', 'Detail Customer')

@section('content')

<div class="container-fluid">

    {{-- HEADER --}}
    <div class="d-flex justify-content-between align-items-center mb-4">

        <div>

            <h1 class="h3 mb-1">
                Detail Customer
            </h1>

            <p class="text-muted mb-0">
                Informasi customer dan undangan yang dibuat.
            </p>

        </div>


        <a href="{{ route('admin.customers.index') }}"
           class="btn btn-secondary">

            <i class="fas fa-arrow-left mr-1"></i>

            Kembali

        </a>

    </div>


    {{-- DATA CUSTOMER --}}
    <div class="card shadow-sm border-0 mb-4">

        <div class="card-header bg-white">

            <h5 class="mb-0">

                <i class="fas fa-user mr-2"></i>

                Informasi Customer

            </h5>

        </div>


        <div class="card-body">

            <div class="row">

                <div class="col-md-4">

                    <small class="text-muted">
                        Nama
                    </small>

                    <h6>
                        {{ $user->name }}
                    </h6>

                </div>


                <div class="col-md-4">

                    <small class="text-muted">
                        Email
                    </small>

                    <h6>
                        {{ $user->email }}
                    </h6>

                </div>


                <div class="col-md-4">

                    <small class="text-muted">
                        Terdaftar
                    </small>

                    <h6>
                        {{ $user->created_at->format('d M Y H:i') }}
                    </h6>

                </div>

            </div>

        </div>

    </div>


    {{-- UNDANGAN --}}
    <div class="card shadow-sm border-0">

        <div class="card-header bg-white">

            <div class="d-flex justify-content-between align-items-center">

                <h5 class="mb-0">

                    <i class="fas fa-envelope-open-text mr-2"></i>

                    Undangan Customer

                </h5>

                <span class="badge badge-primary">

                    {{ $user->invitations->count() }}

                    Undangan

                </span>

            </div>

        </div>


        <div class="card-body p-0">

            <div class="table-responsive">

                <table class="table table-hover mb-0">

                    <thead>

                        <tr>

                            <th width="60">
                                No
                            </th>

                            <th>
                                Mempelai
                            </th>

                            <th>
                                Template
                            </th>

                            <th>
                                Tanggal Pernikahan
                            </th>

                            <th>
                                Status
                            </th>

                        </tr>

                    </thead>


                    <tbody>

                        @forelse($user->invitations as $invitation)

                            <tr>

                                <td>
                                    {{ $loop->iteration }}
                                </td>


                                <td>

                                    <strong>

                                        {{ $invitation->groom_name }}

                                        &

                                        {{ $invitation->bride_name }}

                                    </strong>

                                    <br>

                                    <small class="text-muted">

                                        /{{ $invitation->slug }}

                                    </small>

                                </td>


                                <td>

                                    {{ $invitation->template->name ?? '-' }}

                                </td>


                                <td>

                                    @if($invitation->wedding_date)

                                        {{ \Carbon\Carbon::parse($invitation->wedding_date)->format('d M Y') }}

                                    @else

                                        -

                                    @endif

                                </td>


                                <td>

                                    @if($invitation->status === 'active')

                                        <span class="badge bg-success">

                                            Aktif

                                        </span>

                                    @elseif($invitation->status === 'draft')

                                        <span class="badge bg-secondary">

                                            Draft

                                        </span>

                                    @else

                                        <span class="badge bg-warning">

                                            {{ ucfirst($invitation->status) }}

                                        </span>

                                    @endif

                                </td>

                            </tr>

                        @empty

                            <tr>

                                <td colspan="5"
                                    class="text-center py-5">

                                    <div class="text-muted">

                                        <i class="fas fa-envelope-open-text fa-3x mb-3"></i>

                                        <h5>
                                            Belum ada undangan
                                        </h5>

                                        <p class="mb-0">
                                            Customer ini belum membuat undangan.
                                        </p>

                                    </div>

                                </td>

                            </tr>

                        @endforelse

                    </tbody>

                </table>

            </div>

        </div>

    </div>

</div>

@endsection