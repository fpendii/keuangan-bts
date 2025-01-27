<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Invoice Print</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            margin: 0;
            padding: 20px;
        }
        .invoice {
            border: 1px solid #ddd;
            padding: 20px;
            border-radius: 10px;
        }
        .header {
            text-align: center;
            margin-bottom: 20px;
        }
        .header h1 {
            margin: 0;
        }
        .details, .summary {
            margin-bottom: 20px;
        }
        .details table, .summary table {
            width: 100%;
            border-collapse: collapse;
        }
        table th, table td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }
    </style>
</head>
<body>
    <div class="invoice">
        <div class="header">
            <h1>Struk Transaksi</h1>
            <p>{{ now()->format('d-m-Y H:i:s') }}</p>
        </div>
        <div class="details">
            <h3>Detail Pelanggan</h3>
            <table>
                <tr>
                    <th>Nama Pelanggan</th>
                    <td>{{ $nama_pelanggan }}</td>
                </tr>
                <tr>
                    <th>Warna</th>
                    <td>{{ $warna }}</td>
                </tr>
                <tr>
                    <th>Jenis Kertas</th>
                    <td>{{ $kertas }}</td>
                </tr>
            </table>
        </div>
        <div class="summary">
            <h3>Ringkasan Transaksi</h3>
            <table>
                <tr>
                    <th>Jumlah Lembar</th>
                    <td>{{ $jumlah }}</td>
                </tr>
                <tr>
                    <th>Total Harga</th>
                    <td>Rp {{ number_format($total_harga, 0, ',', '.') }}</td>
                </tr>
                <tr>
                    <th>Dokumen</th>
                    <td>{{ $dokumen }}</td>
                </tr>
            </table>
        </div>
    </div>
</body>
</html>
