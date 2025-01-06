@extends('components.template-admin.template')

@php
    $page = 'printing';
@endphp

@section('title')
    Tambah Order / Pengeluaran Printing
@endsection

@section('content')
    <div class="card mb-4">
        <div class="card-header pb-0">
            <h6>Tambah Order / Pengeluaran Printing</h6>
        </div>
        <div class="card-body">

            <!-- Form -->
            <form action="{{ url('admin/order/printing/simpan') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <!-- Bagian Tambah Order -->
                <div id="order-fields" style="display: block;">
                    <input type="hidden" name="mode" value="order" id="mode-input">
                    <div class="mb-3">
                        <label for="nama_pelanggan" class="form-label">Nama Pelanggan</label>
                        <input type="text" class="form-control @error('nama_pelanggan') is-invalid @enderror"
                            id="nama_pelanggan" name="nama_pelanggan" placeholder="Masukkan nama pelanggan"
                            value="{{ old('nama_pelanggan') }}">
                        @error('nama_pelanggan')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="nama_dokument" class="form-label">Unggah Dokumen</label>
                        <input type="file" class="form-control @error('nama_dokument') is-invalid @enderror"
                            id="nama_dokument" name="nama_dokument" accept=".pdf,.doc,.docx,.xls,.xlsx,.ppt,.pptx">
                        <small class="text-muted">Format yang diperbolehkan: PDF, Word, Excel, PowerPoint</small>
                        @error('nama_dokument')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <!-- Pilihan Warna -->
                <div class="mb-3">
                    <label for="warna" class="form-label">Warna</label>
                    <select class="form-control @error('warna') is-invalid @enderror" id="warna" name="warna" required>
                        <option value="Color" {{ old('warna') == 'Color' ? 'selected' : '' }}>Color</option>
                        <option value="Grayscale" {{ old('warna') == 'Grayscale' ? 'selected' : '' }}>Grayscale</option>
                    </select>
                    @error('warna')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Jumlah Lembar -->
                <div class="mb-3">
                    <label for="jumlah" class="form-label">Jumlah Lembar</label>
                    <input type="number" class="form-control @error('jumlah') is-invalid @enderror" id="jumlah"
                        name="jumlah" placeholder="Masukkan jumlah lembar dokumen" value="{{ old('jumlah') }}" required>
                    @error('jumlah')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Total Harga -->
                <div class="mb-3">
                    <label for="total_harga" class="form-label">Total Harga</label>
                    <input type="number" class="form-control @error('total_harga') is-invalid @enderror" id="total_harga"
                        name="total_harga" placeholder="Masukkan total harga" value="{{ old('total_harga') }}" required>
                    @error('total_harga')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>



                <!-- Tombol Simpan -->
                <div class="d-flex justify-content-between">
                    <a href="{{ url('admin/laporan-keuangan/printing') }}" class="btn btn-secondary">
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
