@extends('components.template-admin.template')

@php
    $page = 'jilid';
@endphp

@section('title')
    Tambah Order / Pengeluaran {{ ucfirst($page) }}
@endsection

@section('content')
    <div class="card mb-4">
        <div class="card-header pb-0">
            <h6>Tambah Order / Pengeluaran {{ ucfirst($page) }}</h6>
        </div>
        <div class="card-body">
            <!-- Tombol Pilih Mode -->
            <div class="d-flex">
                <button type="button" class="btn btn-primary me-2 mode-btn" data-mode="order">Tambah Order</button>
                <button type="button" class="btn btn-secondary mode-btn" data-mode="pengeluaran">Tambah Pengeluaran</button>
            </div>

            <!-- Form -->
            <form action="{{ url('admin/order/printing/simpan') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <!-- Bagian Tambah Order -->
                <div id="order-fields" style="display: block;">
                    <input type="hidden" name="mode" value="order" id="mode-input">
                    <!-- Nama Pelanggan -->
                    <div class="mb-3">
                        <label for="nama_pelanggan" class="form-label">Nama Pelanggan</label>
                        <input type="text" class="form-control @error('nama_pelanggan') is-invalid @enderror"
                            id="nama_pelanggan" name="nama_pelanggan" placeholder="Masukkan nama pelanggan"
                            value="{{ old('nama_pelanggan') }}">
                        @error('nama_pelanggan')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Unggah Dokumen -->
                    <div class="mb-3">
                        <label for="nama_dokument" class="form-label">Unggah Dokumen</label>
                        <input type="file" class="form-control @error('nama_dokument') is-invalid @enderror"
                            id="nama_dokument" name="nama_dokument" accept=".pdf,.doc,.docx,.xls,.xlsx,.ppt,.pptx">
                        <small class="text-muted">Format yang diperbolehkan: PDF, Word, Excel, PowerPoint</small>
                        @error('nama_dokument')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Tipe Jilid -->
                    <div class="mb-3">
                        <label for="tipe_jilid" class="form-label">Tipe Jilid</label>
                        <select class="form-select @error('tipe_jilid') is-invalid @enderror" id="tipe_jilid"
                            name="tipe_jilid">
                            <option value="soft">Soft Jilid - Rp 25,000</option>
                            <option value="hard">Hard Jilid - Rp 35,000</option>
                        </select>
                        @error('tipe_jilid')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Jumlah -->
                    <div class="mb-3">
                        <label for="jumlah" class="form-label">Jumlah</label>
                        <input type="number" class="form-control @error('jumlah') is-invalid @enderror" id="jumlah"
                            name="jumlah" placeholder="Masukkan jumlah jilid" value="{{ old('jumlah') }}">
                        @error('jumlah')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>


                <!-- Bagian Tambah Pengeluaran -->
                <div id="pengeluaran-fields" style="display: none;">
                    <input type="hidden" name="mode" value="pengeluaran" id="mode-input">
                    <div class="mb-3">
                        <label for="deskripsi_pengeluaran" class="form-label">Deskripsi Pengeluaran</label>
                        <input type="text" class="form-control @error('deskripsi_pengeluaran') is-invalid @enderror"
                            id="deskripsi_pengeluaran" name="deskripsi_pengeluaran"
                            placeholder="Masukkan deskripsi pengeluaran" value="{{ old('deskripsi_pengeluaran') }}">
                        @error('deskripsi_pengeluaran')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <!-- Total Harga -->
                <div class="mb-3">
                    <label for="total_harga" class="form-label">Total Harga</label>
                    <input type="number" class="form-control @error('total_harga') is-invalid @enderror" id="total_harga"
                        name="total_harga" placeholder="Total harga akan dihitung otomatis" readonly>
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

    <!-- Script -->
    <script>
        const modeButtons = document.querySelectorAll('.mode-btn');
        const orderFields = document.getElementById('order-fields');
        const pengeluaranFields = document.getElementById('pengeluaran-fields');
        const modeInput = document.getElementById('mode-input');

        modeButtons.forEach(button => {
            button.addEventListener('click', () => {
                const mode = button.getAttribute('data-mode');
                if (mode === 'order') {
                    orderFields.style.display = 'block';
                    pengeluaranFields.style.display = 'none';
                    modeInput.value = 'order';
                } else {
                    orderFields.style.display = 'none';
                    pengeluaranFields.style.display = 'block';
                    modeInput.value = 'pengeluaran';
                }

                modeButtons.forEach(btn => btn.classList.remove('btn-primary', 'btn-secondary'));
                button.classList.add('btn-primary');
                button.classList.remove('btn-secondary');
            });
        });

        const jumlahInput = document.getElementById('jumlah');
        const tipeJilidInput = document.getElementById('tipe_jilid');
        const totalHargaInput = document.getElementById('total_harga');

        const calculateTotalHarga = () => {
            const jumlah = parseInt(jumlahInput.value) || 0;
            const tipeJilid = tipeJilidInput.value;
            let hargaPerUnit = 0;

            if (tipeJilid === 'soft') {
                hargaPerUnit = 25000;
            } else if (tipeJilid === 'hard') {
                hargaPerUnit = 35000;
            }

            totalHargaInput.value = jumlah * hargaPerUnit;
        };

        jumlahInput.addEventListener('input', calculateTotalHarga);
        tipeJilidInput.addEventListener('change', calculateTotalHarga);
    </script>
@endsection
