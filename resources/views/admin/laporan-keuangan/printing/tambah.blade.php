@extends('components.template-admin.template')

@php
    $page = 'printing';
@endphp

@section('title')
    Tambah Order Printing
@endsection

@section('content')
    <div class="card mb-4">
        <div class="card-header pb-0">
            <h6>Tambah Order Printing</h6>
        </div>
        <div class="card-body">
            <form action="{{ url('admin/orders/printing/store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="mb-3">
                    <label for="customer_name" class="form-label">Nama Pelanggan</label>
                    <input type="text" class="form-control" id="customer_name" name="customer_name" placeholder="Masukkan nama pelanggan" required>
                </div>

                <div class="mb-3">
                    <label for="document_name" class="form-label">Nama Dokumen</label>
                    <textarea class="form-control" id="document_name" name="document_name" placeholder="Masukkan nama dokumen" rows="3" required></textarea>
                </div>

                <div class="mb-3">
                    <label for="document_file" class="form-label">Unggah Dokumen</label>
                    <input type="file" class="form-control" id="document_file" name="document_file" accept=".pdf,.doc,.docx,.xls,.xlsx,.ppt,.pptx" required>
                    <small class="text-muted">Format yang diperbolehkan: PDF, Word, Excel, PowerPoint</small>
                </div>

                <div class="mb-3">
                    <label for="total_price" class="form-label">Total Harga</label>
                    <input type="number" class="form-control" id="total_price" name="total_price" placeholder="Masukkan total harga" required>
                </div>

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
