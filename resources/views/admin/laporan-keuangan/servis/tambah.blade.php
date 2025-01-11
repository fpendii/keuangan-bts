@extends('components.template-admin.template')

@php
    $page = 'jas';
@endphp

@section('title')
    Tambah Order {{ Str::of($page)->replace('-', ' ')->title() }}
@endsection

@section('content')
    <div class="card mb-4">
        <div class="card-header pb-0">
            <h6>Tambah Order {{ Str::of($page)->replace('-', ' ')->title() }}</h6>
        </div>
        <div class="card-body">

            <!-- Form -->
            <form action="{{ url('admin/order/'. $page .'/simpan') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <!-- Bagian Tambah Order -->
                <div id="order-fields" style="display: block;">

                    <div class="mb-3">
                        <label for="nama_pelanggan" class="form-label">Nama Pelanggan</label>
                        <input type="text" class="form-control @error('nama_pelanggan') is-invalid @enderror"
                            id="nama_pelanggan" name="nama_pelanggan" placeholder="Masukkan nama pelanggan"
                            value="{{ old('nama_pelanggan') }}">
                        @error('nama_pelanggan')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                </div>

                <div class="mb-3">
                    <label for="jenis_servis" class="form-label">Jenis Servis</label>
                    <input type="text" class="form-control @error('jenis_servis') is-invalid @enderror" id="jenis_servis"
                        name="jenis_servis" placeholder="Masukkan Jenis Servis" value="{{ old('jenis_servis') }}" required>
                    @error('jenis_servis')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="harga_modal" class="form-label">Harga Modal</label>
                    <input type="number" class="form-control @error('harga_modal') is-invalid @enderror" id="harga_modal"
                        name="harga_modal" placeholder="Masukkan Harga Modal" value="{{ old('harga_modal') }}" required>
                    @error('harga_modal')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="harga_jual" class="form-label">Harga Jual</label>
                    <input type="number" class="form-control @error('harga_jual') is-invalid @enderror" id="harga_jual"
                        name="harga_jual" placeholder="Masukkan Harga Jual" value="{{ old('harga_jual') }}" required>
                    @error('harga_jual')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="laba" class="form-label">Laba</label>
                    <input type="number" class="form-control @error('laba') is-invalid @enderror" id="laba"
                        name="laba" placeholder="Masukkan Laba" value="{{ old('laba') }}" required>
                    @error('laba')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="d-flex justify-content-between">
                    <a href="{{ url('admin/laporan-keuangan/'.$page) }}" class="btn btn-secondary">
                        <i class="fa fa-arrow-left"></i> Kembali
                    </a>
                    <button type="submit" class="btn btn-primary">
                        <i class="fa fa-save"></i> Simpan
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection
