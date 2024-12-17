@extends('components.template-admin.template')

@php
    $page = 'jilid';
@endphp

@section('title')
    {{ $page }}
@endsection

@section('content')
    @include('components.template-admin.navbar-laporan-keuangan')
    <div class="card">

        <div class="row my-4">
            <!-- Orders Overview -->
            <div class="col-lg-4 col-md-6 order-1 order-lg-2">
                <div class="card h-100">
                    <div class="card-header pb-0">
                        <h6>Orders Overview</h6>
                        <p class="text-sm">
                            <i class="fa fa-arrow-up text-success" aria-hidden="true"></i>
                            <span class="font-weight-bold">Rp. 250.000</span> bulan ini
                        </p>
                    </div>
                    <div class="card-body p-3">
                        <div class="d-flex justify-content-between align-items-center">

                            <a href="{{ url('admin/order/printing/tambah') }}" class="btn btn-primary btn-sm">
                                <i class="fa fa-plus"></i> Tambah Order
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Printing Orders Table -->
            <div class="col-lg-8 col-md-6 order-2 order-lg-1">
                <div class="card">
                    <div class="card-header pb-0">
                        <div class="row">
                            <div class="col-lg-6 col-7">
                                <h6>Printing Orders</h6>
                                <p class="text-sm mb-0">
                                    Data Orders Jilid Perbulan
                                </p>
                            </div>
                            <div class="col-lg-6 col-5 my-auto text-end">
                                <div class="dropdown float-lg-end pe-4">
                                    <a class="cursor-pointer" id="dropdownTable" data-bs-toggle="dropdown"
                                        aria-expanded="false">
                                        <i class="fa fa-ellipsis-v text-secondary"></i>
                                    </a>
                                    <ul class="dropdown-menu px-2 py-3 ms-sm-n4 ms-n5" aria-labelledby="dropdownTable">
                                        <li><a class="dropdown-item border-radius-md"
                                                href="{{ url('admin/laporan-keuangan/printing/all') }}">Lihat semua</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-body px-0 pb-2">
                        <div class="table-responsive">
                            <table class="table align-items-center mb-0">
                                <!-- Table -->
                                <thead>
                                    <tr>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Nama
                                        </th>
                                        <th
                                            class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                            Dokument</th>
                                        <th
                                            class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            Total</th>
                                        <th
                                            class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach (['Andi', 'Budi', 'Citra', 'Dewi', 'Eko'] as $index => $name)
                                        <tr>
                                            <td>
                                                <div class="d-flex px-2 py-1">
                                                    <div class="d-flex flex-column justify-content-center">
                                                        <h6 class="mb-0 text-sm">{{ $name }}</h6>
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="w-30 text-wrap">
                                                <div class="avatar-group mt-2">
                                                    <small>Laporan {{ $name }} 1, Laporan {{ $name }} 2, Laporan {{ $name }} 3</small>
                                                </div>
                                            </td>
                                            <td class="align-middle text-center text-sm">
                                                <span class="text-xs font-weight-bold"> Rp. {{ number_format(50000 * ($index + 1), 0, ',', '.') }} </span>
                                            </td>
                                            <td class="align-middle text-center">
                                                <!-- Tombol Edit -->
                                                <a href="{{ url('admin/order/printing/edit/' . $index) }}"
                                                    class="btn btn-warning btn-sm">
                                                    <i class="fa fa-pencil-alt"> Edit</i>
                                                </a>
                                                <!-- Tombol Hapus -->
                                                <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal"
                                                    data-bs-target="#deleteModal{{ $index }}">
                                                    <i class="fa fa-trash"></i> Hapus
                                                </button>

                                                <!-- Modal -->
                                                <div class="modal fade" id="deleteModal{{ $index }}" tabindex="-1"
                                                    aria-labelledby="deleteModalLabel{{ $index }}"
                                                    aria-hidden="true">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title"
                                                                    id="deleteModalLabel{{ $index }}">Konfirmasi
                                                                    Hapus</h5>
                                                                <button type="button" class="btn-close"
                                                                    data-bs-dismiss="modal" aria-label="Close"></button>
                                                            </div>
                                                            <div class="modal-body">
                                                                Apakah Anda yakin ingin menghapus data ini?
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary"
                                                                    data-bs-dismiss="modal">Batal</button>
                                                                <form action="{{ url('admin/order/jilid/hapus/' . $index) }}"
                                                                    method="POST" class="d-inline">
                                                                    @csrf
                                                                    @method('DELETE')
                                                                    <button type="submit"
                                                                        class="btn btn-danger">Hapus</button>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>

                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection