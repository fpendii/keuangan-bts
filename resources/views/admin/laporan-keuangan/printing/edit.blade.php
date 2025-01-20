@extends('components.template-admin.template')

@php
    $page = 'printing';
@endphp

@section('title')
    Edit Order Printing
@endsection

@section('content')
    <div class="card mb-4">
        <div class="card-header pb-0">
            <h6>Edit Order Printing</h6>
        </div>
        <div class="card-body">
            <form action="{{ url('admin/order/printing/update/' . $transaksi->id_pesanan_printing) }}" method="POST"
                enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <!-- Input Nama Pelanggan -->
                <div class="mb-3">
                    <label for="nama_pelanggan" class="form-label">Nama Pelanggan</label>
                    <input type="text" class="form-control @error('nama_pelanggan') is-invalid @enderror"
                        id="nama_pelanggan" name="nama_pelanggan"
                        value="{{ old('nama_pelanggan', $transaksi->nama_pelanggan) }}"
                        placeholder="Masukkan nama pelanggan" required>
                    @error('nama_pelanggan')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <!-- Input Unggah Dokumen -->
                <div class="mb-3">
                    <label for="nama_dokument" class="form-label">Unggah Dokumen</label>
                    <input type="file" class="form-control @error('nama_dokument') is-invalid @enderror"
                        id="nama_dokument" name="nama_dokument" accept=".pdf,.doc,.docx,.xls,.xlsx,.ppt,.pptx">
                    <small class="text-muted">Nama File : {{ $transaksi->dokumen }}</small>
                    @error('nama_dokument')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <input type="text" name="nama_dokument_lama" value="{{ $transaksi->dokumen }}" hidden
                    class="form-control">

                <div class="mb-3">
                    <label class="form-label" for="warna">Warna</label>
                    <select class="form-select @error('warna') is-invalid @enderror" name="warna" id="warna" required>
                        <option value="" disabled {{ old('warna') ? '' : 'selected' }}>Pilih Warna</option>
                        <option value="Color"
                            {{ old('warna') == 'Color' || $transaksi->warna == 'Color' ? 'selected' : '' }}>Color</option>
                        <option value="Grayscale"
                            {{ old('warna') == 'Grayscale' || $transaksi->warna == 'Grayscale' ? 'selected' : '' }}>
                            Grayscale</option>
                    </select>
                    @error('warna')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>


                <!-- Pilihan Kertas -->
                <div class="mb-3">
                    <label class="form-label" for="kertas">Kertas Sendiri?</label>
                    <select class="form-select @error('kertas') is-invalid @enderror" name="kertas" id="kertas"
                        required>
                        <option value="" disabled {{ old('kertas') ? '' : 'selected' }}>Pilih Opsi</option>
                        <option value="Tidak"
                            {{ old('kertas') == 'Tidak' || $transaksi->kertas == 'Tidak' ? 'selected' : '' }}>Tidak
                        </option>
                        <option value="Ya" {{ old('kertas') == 'Ya' || $transaksi->kertas == 'Ya' ? 'selected' : '' }}>
                            Ya</option>
                    </select>
                    @error('kertas')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>


                <!-- Jumlah Lembar -->
                <div class="mb-3">
                    <label for="jumlah" class="form-label">Jumlah Lembar</label>
                    <input type="number" class="form-control @error('jumlah') is-invalid @enderror" id="jumlah"
                        name="jumlah" placeholder="Masukkan jumlah lembar dokumen"
                        value="{{ old('jumlah', $transaksi->jumlah) }}" required>
                    @error('jumlah')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Input Total Harga -->
                <div class="mb-3">
                    <label for="total_harga" class="form-label">Total Harga</label>
                    <input type="text" class="form-control @error('total_harga') is-invalid @enderror" id="total_harga"
                        name="total_harga" value="{{ old('total_harga', $total_harga) }}"
                        placeholder="Masukkan total harga" required>
                    @error('total_harga')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>


                <div class="d-flex justify-content-between">
                    <a href="{{ url('admin/laporan-keuangan/printing') }}" class="btn btn-secondary">
                        <i class="fa fa-arrow-left"></i> Kembali
                    </a>
                    <button type="submit" class="btn btn-primary">
                        <i class="fa fa-save"></i> Simpan Perubahan
                    </button>
                </div>
            </form>
        </div>
    </div>

    <script>
        // Format input value ketika pengguna mengetik
        const input = document.getElementById('total_harga');

        input.addEventListener('input', function(e) {
            let value = e.target.value;

            // Hapus karakter selain angka dan tanda koma
            value = value.replace(/[^0-9,]/g, '');

            // Pisahkan angka dan tambahkan pemisah ribuan
            if (value.indexOf(',') !== -1) {
                let [integer, decimal] = value.split(',');
                integer = integer.replace(/\B(?=(\d{3})+(?!\d))/g, '.');
                e.target.value = `${integer},${decimal}`;
            } else {
                value = value.replace(/\B(?=(\d{3})+(?!\d))/g, '.');
                e.target.value = value;
            }
        });

        // Menghapus format saat form disubmit
        document.querySelector('form').addEventListener('submit', function() {
            let value = input.value;
            value = value.replace(/\./g, '').replace('.', ','); // Menghapus titik dan mengganti koma jadi titik
            input.value = value;
        });
    </script>
@endsection
