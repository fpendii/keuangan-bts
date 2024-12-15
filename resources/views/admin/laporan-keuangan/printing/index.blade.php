@extends('components.template-admin.template')

@php
    $page = 'printing';
@endphp

@section('title')
    {{ $page }}
@endsection

@section('content')
    <div class="card mb-2">
        <div class="card-body">
            <ul class="nav nav-tabs" id="myTab" role="tablist">
                <li class="nav-item" role="presentation">
                    <a class="nav-link {{ Request::is('admin/laporan-keuangan/printing') ? 'active' : '' }}" id="home-tab"
                        href="{{ url('admin/laporan-keuangan/printing') }}" role="tab" aria-controls="home"
                        aria-selected="true"><i class="fa-solid fa-print"></i> Printing</a>
                </li>
                <li class="nav-item" role="presentation">
                    <a class="nav-link {{ Request::is('admin/laporan-keuangan/jilid') ? 'active' : '' }}" id="home-tab"
                        href="{{ url('admin/laporan-keuangan/jilid') }}" role="tab" aria-controls="home"
                        aria-selected="true"><i class="fa-solid fa-book"></i> Jilid</a>
                </li>
                <li class="nav-item" role="presentation">
                    <a class="nav-link {{ Request::is('admin/laporan-keuangan/bimbel') ? 'active' : '' }}" id="home-tab"
                        href="{{ url('admin/laporan-keuangan/bimbel') }}" role="tab" aria-controls="home"
                        aria-selected="true"><i class="fa-solid fa-school"></i> Bimbel</a>
                </li>
                <li class="nav-item" role="presentation">
                    <a class="nav-link {{ Request::is('admin/laporan-keuangan/jas') ? 'active' : '' }}" id="home-tab"
                        href="{{ url('admin/laporan-keuangan/jas') }}" role="tab" aria-controls="home"
                        aria-selected="true"><i class="fa-solid fa-user-tie"></i> Jas</a>
                </li>
            </ul>
        </div>
    </div>
    <div class="card">

        <div class="row my-4">
            <div class="col-lg-8 col-md-6 mb-md-0 mb-4">
                <div class="card">
                    <div class="card-header pb-0">
                        <div class="row">
                            <div class="col-lg-6 col-7">
                                <h6>Printing Orders</h6>
                                <p class="text-sm mb-0">
                                    Data Orders Printing Perbulan
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
                                <thead>
                                    <tr>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            Nama</th>
                                        <th
                                            class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                            Dokument</th>
                                        <th
                                            class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            Total</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @for ($i = 0; $i < 10; $i++)
                                        <tr>
                                            <td>
                                                <div class="d-flex px-2 py-1">
                                                    <div class="d-flex flex-column justify-content-center">
                                                        <h6 class="mb-0 text-sm">Hendy</h6>
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="w-30 text-wrap">
                                                <div class="avatar-group mt-2">
                                                    <small>Laporan Tugas Akhir Hendy, Laporan 2 Tugas Akhir Hendy, Laporan 3
                                                        Tugas Akhir Hendy</small>
                                                </div>
                                            </td>
                                            <td class="align-middle text-center text-sm">
                                                <span class="text-xs font-weight-bold"> Rp. 100.000 </span>
                                            </td>
                                        </tr>
                                    @endfor
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-6">
                <div class="card h-100">
                    <div class="card-header pb-0">
                        <h6>Orders overview</h6>
                        <p class="text-sm">
                            <i class="fa fa-arrow-up text-success" aria-hidden="true"></i>
                            <span class="font-weight-bold">24%</span> this month
                        </p>
                    </div>
                    <div class="card-body p-3">
                        <div class="timeline timeline-one-side">
                            <div class="timeline-block mb-3">
                                <span class="timeline-step">
                                    <i class="ni ni-bell-55 text-success text-gradient"></i>
                                </span>
                                <div class="timeline-content">
                                    <h6 class="text-dark text-sm font-weight-bold mb-0">$2400, Design changes</h6>
                                    <p class="text-secondary font-weight-bold text-xs mt-1 mb-0">22 DEC 7:20 PM</p>
                                </div>
                            </div>
                            <div class="timeline-block mb-3">
                                <span class="timeline-step">
                                    <i class="ni ni-html5 text-danger text-gradient"></i>
                                </span>
                                <div class="timeline-content">
                                    <h6 class="text-dark text-sm font-weight-bold mb-0">New order #1832412</h6>
                                    <p class="text-secondary font-weight-bold text-xs mt-1 mb-0">21 DEC 11 PM</p>
                                </div>
                            </div>
                            <div class="timeline-block mb-3">
                                <span class="timeline-step">
                                    <i class="ni ni-cart text-info text-gradient"></i>
                                </span>
                                <div class="timeline-content">
                                    <h6 class="text-dark text-sm font-weight-bold mb-0">Server payments for April</h6>
                                    <p class="text-secondary font-weight-bold text-xs mt-1 mb-0">21 DEC 9:34 PM</p>
                                </div>
                            </div>
                            <div class="timeline-block mb-3">
                                <span class="timeline-step">
                                    <i class="ni ni-credit-card text-warning text-gradient"></i>
                                </span>
                                <div class="timeline-content">
                                    <h6 class="text-dark text-sm font-weight-bold mb-0">New card added for order
                                        #4395133</h6>
                                    <p class="text-secondary font-weight-bold text-xs mt-1 mb-0">20 DEC 2:20 AM</p>
                                </div>
                            </div>
                            <div class="timeline-block mb-3">
                                <span class="timeline-step">
                                    <i class="ni ni-key-25 text-primary text-gradient"></i>
                                </span>
                                <div class="timeline-content">
                                    <h6 class="text-dark text-sm font-weight-bold mb-0">Unlock packages for development
                                    </h6>
                                    <p class="text-secondary font-weight-bold text-xs mt-1 mb-0">18 DEC 4:54 AM</p>
                                </div>
                            </div>
                            <div class="timeline-block">
                                <span class="timeline-step">
                                    <i class="ni ni-money-coins text-dark text-gradient"></i>
                                </span>
                                <div class="timeline-content">
                                    <h6 class="text-dark text-sm font-weight-bold mb-0">New order #9583120</h6>
                                    <p class="text-secondary font-weight-bold text-xs mt-1 mb-0">17 DEC</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
