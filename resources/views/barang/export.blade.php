<style>
    table {
        border-collapse: collapse;
        width: 100%;
        border: 1px solid #0c0909;
    }

    th,
    td {
        text-align: left;
        padding: 8px;
        border-bottom: 1px solid #030303;
        border-right: 1px solid #0a0909;
        border-left: 1px solid #0a0909;

    }

    tr:nth-child(even) {
        background-color: #f2f2f2;
    }

    th {
        background-color: #0e50dd;
        color: white;
    }
</style>

<table class="table table-bordered mt-3 table-striped">
    <thead class="text-center">
        <tr>
            <th>Nama</th>
            <th>Stok</th>
            <th>Harga Jual</th>
            <th>Satuan</th>
            <th>Keterangan</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($barang as $item)
            <tr>
                <td>{{ $item->nama }}</td>
                <td>{{ $item->stok }}</td>
                <td>{{ $item->harga_jual }}</td>
                <td>{{ $item->satuan }}</td>
                <td>{{ $item->keterangan }}</td>
            </tr>
        @endforeach
    </tbody>
</table>
