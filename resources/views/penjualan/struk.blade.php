<style>
    body {
        font-family: 'Courier New', Courier, monospace;
        font-size: 12px;
        margin: 0;
        width: 58mm;
        height: 297mm;
        page-break-after: always;
    }

    h2 {
        text-align: center;
        font-size: 16px;
        margin: 0;
        padding: 2;
    }

    p {
        margin: 0;
        width: 100%;
        padding: 2;
        text-align: center;
    }

    .struk {
        border: 1px solid black;
        padding: 4;
        margin-bottom: 4;
    }
</style>

<div class="struk">
    <h2>MyMart</h2>
    <p>No Faktur : {{ $penjualan->no_faktur }}</p>
    <p>Tanggal : {{ $penjualan->tanggal }}</p>
    <hr>
    @foreach ($penjualan->detail_penjualan as $detail_penjualan)
        <p>{{ $detail_penjualan->barang->nama }} ({{ $detail_penjualan->qty }})</p>
        <p>Rp. {{ number_format($detail_penjualan->harga, 0, ',', '.') }}</p>
        <p>Rp. {{ number_format($detail_penjualan->subtotal, 0, ',', '.') }}</p>
        <hr>
    @endforeach
    <p>Total : Rp. {{ number_format($penjualan->total, 0, ',', '.') }}</p>
    <p>Terima Kasih</p>
</div>
