<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Struk Penjualan</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 12px;
            max-width: 300px;
            margin: auto;
            text-align: center;
        }

        h2 {
            margin-bottom: 5px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }

        th,
        td {
            padding: 8px 5px;
            text-align: left;
        }

        .total {
            font-weight: bold;
            font-size: 14px;
            margin-top: 10px;
        }
    </style>
</head>

<body>
    <h2>MyMart</h2>
    <p>No Faktur: {{ $penjualan->no_faktur }}</p>
    <p>Tanggal: {{ $penjualan->tanggal }}</p>
    <hr>
    <table>
        <tbody>
            @foreach ($penjualan->detail_penjualan as $detail)
                <tr>
                    <td colspan="2" style="padding-bottom: 3px;"><strong>{{ $detail->barang->nama }}</strong></td>
                </tr>
                <tr>
                    <td style="padding-bottom: 5px;">{{ $detail->qty }} x
                        Rp{{ number_format($detail->harga, 0, ',', '.') }}</td>
                    <td style="text-align: right; padding-bottom: 5px;">
                        Rp{{ number_format($detail->subtotal, 0, ',', '.') }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <hr>
    <p class="total">Total: Rp{{ number_format($penjualan->total, 0, ',', '.') }}</p>
    <p>Terima kasih telah berbelanja!</p>
    <p>Barang yang sudah dibeli tidak dapat dikembalikan.</p>
</body>

</html>
