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
            <form action="{{ url('admin/order/' . $page . '/update/' . $transaksi->id_pesanan_jas) }}" method="POST"
                enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <!-- Bagian Tambah Order -->
                <div id="order-fields" style="display: block;">
                    <div class="mb-3">
                        <label for="nama_pelanggan" class="form-label">Nama Pelanggan</label>
                        <input type="text" class="form-control @error('nama_pelanggan') is-invalid @enderror"
                            id="nama_pelanggan" name="nama_pelanggan" placeholder="Masukkan nama pelanggan"
                            value="{{ $transaksi->nama_pelanggan, old('nama_pelanggan') }}">
                        @error('nama_pelanggan')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                </div>

                <!-- Pilihan Warna -->
                <div class="mb-3">
                    <label class="form-label">Ukuran Jas</label>
                    <div class="form-check">
                        <input class="form-check-input @error('ukuran_jas') is-invalid @enderror" type="radio"
                            name="ukuran_jas" id="ukuran_jas_s" value="S"
                            {{ old('ukuran_jas') == 'S' || $transaksi->ukuran_jas == 'S' ? 'checked' : '' }} required>
                        <label class="form-check-label" for="ukuran_jas_s">
                            S
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input @error('ukuran_jas') is-invalid @enderror" type="radio"
                            name="ukuran_jas" id="ukuran_jas_m" value="M"
                            {{ old('ukuran_jas') == 'M' || $transaksi->ukuran_jas == 'M' ? 'checked' : '' }} required>
                        <label class="form-check-label" for="ukuran_jas_m">
                            M
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input @error('ukuran_jas') is-invalid @enderror" type="radio"
                            name="ukuran_jas" id="ukuran_jas_l" value="L"
                            {{ old('ukuran_jas') == 'L' || $transaksi->ukuran_jas == 'L' ? 'checked' : '' }} required>
                        <label class="form-check-label" for="ukuran_jas_l">
                            L
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input @error('ukuran_jas') is-invalid @enderror" type="radio"
                            name="ukuran_jas" id="ukuran_jas_xl" value="XL"
                            {{ old('ukuran_jas') == 'XL' || $transaksi->ukuran_jas == 'XL' ? 'checked' : '' }} required>
                        <label class="form-check-label" for="ukuran_jas_xl">
                            XL
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input @error('ukuran_jas') is-invalid @enderror" type="radio"
                            name="ukuran_jas" id="ukuran_jas_xxl" value="XXL"
                            {{ old('ukuran_jas') == 'XXL' || $transaksi->ukuran_jas == 'XXL' ? 'checked' : '' }} required>
                        <label class="form-check-label" for="ukuran_jas_xxl">
                            XXL
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input @error('ukuran_jas') is-invalid @enderror" type="radio"
                            name="ukuran_jas" id="ukuran_jas_xxxl" value="XXXL"
                            {{ old('ukuran_jas') == 'XXXl' || $transaksi->ukuran_jas == 'XXXL' ? 'checked' : '' }}
                            required>
                        <label class="form-check-label" for="ukuran_jas_xxxl">
                            XXXL
                        </label>
                    </div>

                    @error('jenis_jilid')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Jumlah Lembar -->
                <div class="mb-3">
                    <label for="jumlah" class="form-label">Jumlah</label>
                    <input type="number" class="form-control @error('jumlah') is-invalid @enderror" id="jumlah"
                        name="jumlah" placeholder="Masukkan jumlah jas" value="{{ $transaksi->jumlah, old('jumlah') }}"
                        required>
                    @error('jumlah')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Total Harga -->
                <div class="mb-3">
                    <label for="total_harga" class="form-label">Total Harga</label>
                    <input type="number" class="form-control @error('total_harga') is-invalid @enderror" id="total_harga"
                        name="total_harga" placeholder="Masukkan total harga"
                        value="{{ old('total_harga', $transaksi->total_harga) }}" required>

                    @error('total_harga')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Tombol Simpan -->
                <div class="d-flex justify-content-between">
                    <a href="{{ url('admin/laporan-keuangan/' . $page) }}" class="btn btn-secondary">
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
