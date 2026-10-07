@extends('admin.layouts.app')

@section('title', 'Customer')

@section('content')

<div class="container-fluid">

    {{-- Header --}}
    <div class="mb-4">

        <h1 class="h3 mb-1">
            Customer
        </h1>

        <p class="text-muted mb-0">
            Kelola customer dan undangan yang mereka buat.
        </p>

    </div>


    {{-- Card --}}
    <div class="card shadow-sm border-0">

        <div class="card-header bg-white">

            <div class="d-flex justify-content-between align-items-center">

                <h5 class="mb-0">

                    <i class="fas fa-users mr-2"></i>

                    Daftar Customer

                </h5>

                <span class="badge badge-primary">
                    {{ $customers->total() }} Customer
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
                                Customer
                            </th>

                            <th>
                                Email
                            </th>

                            <th class="text-center">
                                Undangan
                            </th>

                            <th>
                                Terdaftar
                            </th>

                            <th width="100">
                                Aksi
                            </th>

                        </tr>

                    </thead>


                    <tbody>

                        @forelse($customers as $customer)

                            <tr>

                                <td>
                                    {{ $customers->firstItem() + $loop->index }}
                                </td>


                                {{-- CUSTOMER --}}
                                <td>

                                    <div class="d-flex align-items-center">

                                        <div
                                            class="rounded-circle bg-primary text-white d-flex align-items-center justify-content-center mr-2"
                                            style="width: 38px; height: 38px;">

                                            <i class="bi bi-person-circle"></i>

                                        </div>

                                        <div>

                                            <strong>
                                                {{ $customer->name }}
                                            </strong>

                                        </div>

                                    </div>

                                </td>


                                {{-- EMAIL --}}
                                <td>

                                    {{ $customer->email }}

                                </td>


                                {{-- JUMLAH UNDANGAN --}}
                                <td class="text-center">

                                    @if($customer->invitations_count > 0)

                                        <span class="badge bg-success">
                                            

                                            {{ $customer->invitations_count }}

                                            Undangan

                                        </span>

                                    @else

                                        <span class="badge badge-secondary">

                                            Belum ada

                                        </span>

                                    @endif

                                </td>


                                {{-- TANGGAL --}}
                                <td>

                                    {{ $customer->created_at->format('d M Y') }}

                                </td>


                                {{-- AKSI --}}
                                <td>

                                    <a href="{{ route('admin.customers.show', $customer->id) }}"
                                       class="btn btn-sm btn-primary"
                                       title="Lihat Detail">

                                        <i class="bi bi-eye"></i>

                                    </a>

                                </td>

                            </tr>

                        @empty

                            <tr>

                                <td colspan="6"
                                    class="text-center py-5">

                                    <div class="text-muted">

                                        <i class="bi bi-users fa-3x mb-3"></i>

                                        <h5>
                                            Belum ada customer
                                        </h5>

                                        <p class="mb-0">
                                            Customer yang melakukan registrasi
                                            akan muncul di sini.
                                        </p>

                                    </div>

                                </td>

                            </tr>

                        @endforelse

                    </tbody>

                </table>

            </div>

        </div>


        {{-- PAGINATION --}}
        @if($customers->hasPages())

            <div class="card-footer bg-white">

                {{ $customers->links() }}

            </div>

        @endif

    </div>

</div>

@endsection