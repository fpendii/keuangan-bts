@extends('components.template-admin.template')

@php
    $page = 'bimbel';
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
            <form action="{{ url('admin/order/bimbel/update/' . $transaksi->id_pesanan_bimbel) }}" method="POST" enctype="multipart/form-data">
                @method('PUT')
                @csrf

                <!-- Bagian Tambah Order -->
                <div id="order-fields" style="display: block;">
                    <div class="mb-3">
                        <label for="nama_pelanggan" class="form-label">Nama Pelanggan</label>
                        <input type="text" class="form-control @error('nama_pelanggan') is-invalid @enderror"
                            id="nama_pelanggan" name="nama_pelanggan" placeholder="Masukkan nama pelanggan"
                            value="{{ $transaksi->nama_pelanggan ,old('nama_pelanggan') }}">
                        @error('nama_pelanggan')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                </div>

                <!-- Pilihan Warna -->
                <div class="mb-3">
                    <label class="form-label">Jenis Bimbel</label>
                    <div class="form-check">
                        <input class="form-check-input @error('jenis_bimbel') is-invalid @enderror" type="radio" name="jenis_bimbel" id="jenis_bimbel_harian" value="Bimbel Harian" {{ $transaksi->jenis_bimbel == 'Bimbel Harian' || old('jenis_bimbel') == 'Soft Cover' ? 'checked' : '' }} required>
                        <label class="form-check-label" for="jenis_bimbel_harian">
                            Bimbel Harian
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input @error('jenis_bimbel') is-invalid @enderror" type="radio" name="jenis_bimbel" id="jenis_bimbel_paket" value="Bimbel Paket" {{ $transaksi->jenis_bimbel == 'Bimbel Paket' || old('jenis_bimbel') == 'Soft Cover' ? 'checked' : '' }} required>
                        <label class="form-check-label" for="jenis_bimbel_paket">
                            Bimbel Paket
                        </label>
                    </div>

                    @error('jenis_bimbel')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Judul Projek -->
                <div class="mb-3">
                    <label for="judul_projek" class="form-label">Judul Projek</label>
                    <input type="text" class="form-control @error('judul_projek') is-invalid @enderror" id="judul_projek"
                        name="judul_projek" placeholder="Masukkan judul projek" value="{{ $transaksi->judul_projek , old('judul_projek') }}" required>
                    @error('judul_projek')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Total Harga -->
                <div class="mb-3">
                    <label for="total_harga" class="form-label">Total Harga</label>
                    <input type="number" class="form-control @error('total_harga') is-invalid @enderror" id="total_harga"
                        name="total_harga" placeholder="Masukkan total harga" value="{{ old('total_harga', $total_harga) }}" required>
                    @error('total_harga')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>



                <!-- Tombol Simpan -->
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
