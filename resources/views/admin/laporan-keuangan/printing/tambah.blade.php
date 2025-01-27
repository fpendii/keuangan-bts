@extends('components.template-admin.template')

@php
    $page = 'printing';
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
                            value="{{ old('nama_pelanggan') }}" required>
                        @error('nama_pelanggan')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="dokumen" class="form-label">Unggah Dokumen</label>
                        <input type="file" class="form-control @error('dokumen') is-invalid @enderror"
                            id="dokumen" name="dokumen[]" multiple accept=".pdf,.doc,.docx,.xls,.xlsx,.ppt,.pptx" required>
                        <small class="text-muted">Format yang diperbolehkan: PDF, Word, Excel, PowerPoint</small>
                        @error('dokumen')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="mb-3">
                    <label class="form-label" for="warna">Warna</label>
                    <select class="form-select @error('warna') is-invalid @enderror" name="warna" id="warna" required>
                        <option value="" disabled {{ old('warna') ? '' : 'selected' }}>Pilih Warna</option>
                        <option value="Color" {{ old('warna') == 'Color' ? 'selected' : '' }}>Color</option>
                        <option value="Grayscale" {{ old('warna') == 'Grayscale' ? 'selected' : '' }}>Grayscale</option>
                    </select>
                    @error('warna')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>


                <!-- Pilihan Kertas -->
                <div class="mb-3">
                    <label class="form-label" for="kertas">Kertas Sendiri?</label>
                    <select class="form-select @error('kertas') is-invalid @enderror" name="kertas" id="kertas" required>
                        <option value="" disabled {{ old('kertas') ? '' : 'selected' }}>Pilih Opsi</option>
                        <option value="Tidak" {{ old('kertas') == 'Tidak' ? 'selected' : '' }}>Tidak</option>
                        <option value="Ya" {{ old('kertas') == 'Ya' ? 'selected' : '' }}>Ya</option>
                    </select>
                    @error('kertas')
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
