@extends('components.template-admin.template')

@php
    $page = 'Beranda';
@endphp

@section('title')
    {{ $page }}
@endsection

@section('content')
<div class="row">
    <div class="col-lg-6 col-12">
      <div class="row">
        <div class="col">
          <div class="card">
            <span class="mask bg-primary opacity-10 border-radius-lg"></span>
            <div class="card-body p-3 position-relative">
              <div class="row">
                <div class="col-8 text-start">
                  {{-- <div class="icon icon-shape bg-white shadow text-center border-radius-2xl">
                    <i class="fa-solid fa-money-bill"></i>
                  </div> --}}
                  <h5 class="text-white font-weight-bolder mb-0 mt-3">
                    {{$total_uang}}
                  </h5>
                  <span class="text-white text-sm">Uang Kas</span>
                </div>
                <div class="col-4">
                  <div class="dropdown text-end mb-6">
                    <a href="javascript:;" class="cursor-pointer" id="dropdownUsers1" data-bs-toggle="dropdown" aria-expanded="false">
                      <i class="fa fa-ellipsis-h text-white"></i>
                    </a>
                    <ul class="dropdown-menu px-2 py-3" aria-labelledby="dropdownUsers1">
                      <li><a class="dropdown-item border-radius-md" href="javascript:;">Action</a></li>
                      <li><a class="dropdown-item border-radius-md" href="javascript:;">Another action</a></li>
                      <li><a class="dropdown-item border-radius-md" href="javascript:;">Something else here</a></li>
                    </ul>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>

      </div>
    </div>
    <div class="col-lg-6 col-12 mt-4 mt-lg-0">
      <div class="card shadow h-100">
        <div class="card-header pb-0 p-3">
          <h6 class="mb-0">Reviews</h6>
        </div>
        <div class="card-body pb-0 p-3">
          <ul class="list-group">
            <li class="list-group-item border-0 d-flex align-items-center px-0 mb-0">
              <div class="w-100">
                <div class="d-flex mb-2">
                  <span class="me-2 text-sm font-weight-bold text-dark">Positive Reviews</span>
                  <span class="ms-auto text-sm font-weight-bold">80%</span>
                </div>
                <div>
                  <div class="progress progress-md">
                    <div class="progress-bar bg-primary w-80" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100"></div>
                  </div>
                </div>
              </div>
            </li>
            <li class="list-group-item border-0 d-flex align-items-center px-0 mb-2">
              <div class="w-100">
                <div class="d-flex mb-2">
                  <span class="me-2 text-sm font-weight-bold text-dark">Neutral Reviews</span>
                  <span class="ms-auto text-sm font-weight-bold">17%</span>
                </div>
                <div>
                  <div class="progress progress-md">
                    <div class="progress-bar bg-primary w-10" role="progressbar" aria-valuenow="10" aria-valuemin="0" aria-valuemax="100"></div>
                  </div>
                </div>
              </div>
            </li>
            <li class="list-group-item border-0 d-flex align-items-center px-0 mb-2">
              <div class="w-100">
                <div class="d-flex mb-2">
                  <span class="me-2 text-sm font-weight-bold text-dark">Negative Reviews</span>
                  <span class="ms-auto text-sm font-weight-bold">3%</span>
                </div>
                <div>
                  <div class="progress progress-md">
                    <div class="progress-bar bg-primary w-5" role="progressbar" aria-valuenow="5" aria-valuemin="0" aria-valuemax="100"></div>
                  </div>
                </div>
              </div>
            </li>
          </ul>
        </div>
        <div class="card-footer pt-0 p-3 d-flex align-items-center">
          <div class="w-60">
            <p class="text-sm">
              More than <b>1,500,000</b> developers used Creative Tim's products and over <b>700,000</b> projects were created.
            </p>
          </div>
          <div class="w-40 text-end">
            <a class="btn btn-dark mb-0 text-end" href="javascript:;">View all reviews</a>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection
