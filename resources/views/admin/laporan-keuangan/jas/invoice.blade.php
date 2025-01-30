<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Invoice Print</title>
    <style>
        body {
            font-family: 'Courier New', Courier, monospace;
            margin: 0;
            padding: 0;
            width: 280px;
            position: relative;
        }

        .invoice {
            width: 100%;
            border: none;
            padding: 10px;
            position: relative;
            z-index: 1;
            /* Ensure invoice content is above the logo */
        }

        .header {
            text-align: center;
            font-size: 16px;
            font-weight: bold;
            margin-bottom: 10px;
        }

        .header p {
            font-size: 12px;
            margin: 0;
        }

        .details,
        .summary {
            font-size: 12px;
            line-height: 1.6;
        }

        .details table,
        .summary table {
            width: 100%;
            border-spacing: 0;
            margin-top: 5px;
        }

        table td {
            padding: 5px 0;
        }

        table td:nth-child(1) {
            width: 120px;
            font-weight: bold;
        }

        .footer {
            text-align: center;
            margin-top: 20px;
        }

        .footer p {
            font-size: 10px;
            margin: 0;
        }

        .bold {
            font-weight: bold;
        }

        .line {
            border-top: 1px solid #000;
            margin: 10px 0;
        }

        /* Logo Styling */

    </style>
</head>

<body>

    <div class="invoice">
        <div class="header">
            <p>Batuah Talenta Semesta</p>
            <p>{{ $created_at }}</p>
        </div>
        <div class="details">
            <table>
                <tr>
                    <td>Nama Pelanggan</td>
                    <td>: {{ $nama_pelanggan }}</td>
                </tr>
                <tr>
                    <td>Ukuran Jas</td>
                    <td>: {{ $ukuran_jas }}</td>
                </tr>
            </table>
        </div>
        <div class="line"></div>
        <div class="summary">
            <table>
                <tr>
                    <td>Jumlah</td>
                    <td>: {{ $jumlah }}</td>
                </tr>
                <tr>
                    <td>Total Harga</td>
                    <td>: Rp {{ number_format($total_harga, 0, ',', '.') }}</td>
                </tr>

            </table>
        </div>
        <div class="line"></div>
        <div class="footer">
            <p class="bold">TERIMA KASIH</p>
            <p>Silakan simpan struk ini sebagai bukti transaksi.</p>
        </div>
    </div>
</body>

</html>
