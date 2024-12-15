@extends('components.template-admin.template')

@php
    $page = 'Beranda';
@endphp

@section('title')
    {{ $page }}
@endsection

@section('content')
    <div class="row">
        <div class="col-lg-6 col-md-6 col-12">
            <a href="{{ url('admin/bimbel') }}">
                <div class="card">
                    <span class="mask bg-primary opacity-10 border-radius-lg"></span>
                    <div class="card-body p-3 position-relative">
                        <div class="row">
                            <div class="col-8 text-start">
                                <div class="bg-white shadow text-center border-radius-2xl h-30 w-10">
                                    <i class="fa-solid fa-print"></i>
                                </div>
                                <h5 class="text-white font-weight-bolder mb-0 mt-3">
                                    Rp 1.500.000
                                </h5>
                                <span class="text-white text-sm">Printing</span>
                            </div>
                            <div class="col-4">

                                <p class="text-white text-sm text-end font-weight-bolder mt-auto mb-0">+55%</p>
                            </div>
                        </div>
                    </div>
                </div>
            </a>
        </div>
        <div class="col-lg-6 col-md-6 col-12 mt-4 mt-md-0">
            <a href="{{ url('admin/jilid') }}">
            <div class="card">
                <span class="mask bg-dark opacity-10 border-radius-lg"></span>
                <div class="card-body p-3 position-relative">
                    <div class="row">
                        <div class="col-8 text-start">
                            <div class="bg-white shadow text-center border-radius-2xl h-30 w-10">
                                <i class="fa-solid fa-book"></i>
                            </div>
                            <h5 class="text-white font-weight-bolder mb-0 mt-3">
                                Rp 2.000.000
                            </h5>
                            <span class="text-white text-sm">Jilid</span>
                        </div>
                        <div class="col-4">

                            <p class="text-white text-sm text-end font-weight-bolder mt-auto mb-0">+124%</p>
                        </div>
                    </div>
                </div>
            </div>
            </a>
        </div>
    </div>
    <div class="row mt-4">
        <div class="col-lg-6 col-md-6 col-12">
            <a href="{{ url('admin/bimbel') }}">
            <div class="card">
                <span class="mask bg-dark opacity-10 border-radius-lg"></span>
                <div class="card-body p-3 position-relative">
                    <div class="row">
                        <div class="col-8 text-start">
                            <div class="bg-white shadow text-center border-radius-2xl h-30 w-10">
                                <i class="fa-solid fa-school"></i>
                            </div>
                            <h5 class="text-white font-weight-bolder mb-0 mt-3">
                                Rp 3.000.000
                            </h5>
                            <span class="text-white text-sm">Bimbel</span>
                        </div>
                        <div class="col-4">

                            <p class="text-white text-sm text-end font-weight-bolder mt-auto mb-0">+15%</p>
                        </div>
                    </div>
                </div>
            </div>
            </a>
        </div>
        <div class="col-lg-6 col-md-6 col-12 mt-4 mt-md-0">
            <a href="{{ url('admin/jas') }}">
            <div class="card">
                <span class="mask bg-dark opacity-10 border-radius-lg"></span>
                <div class="card-body p-3 position-relative">
                    <div class="row">
                        <div class="col-8 text-start">
                            <div class="bg-white shadow text-center border-radius-2xl h-30 w-10">
                                <i class="fa-solid fa-person-dress"></i>
                            </div>
                            <h5 class="text-white font-weight-bolder mb-0 mt-3">
                                Rp 4.000.000
                            </h5>
                            <span class="text-white text-sm">Jas</span>
                        </div>
                        <div class="col-4">

                            <p class="text-white text-sm text-end font-weight-bolder mt-auto mb-0">+90%</p>
                        </div>
                    </div>
                </div>
            </div>
        </a>
        </div>
    </div>
@endsection
