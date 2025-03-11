@extends('layouts.app')

@section('content')
    <div class="container">
        <div style="display: flex; flex-direction: column; align-items: center">
            <h2>Detail Penjualan</h2>
            <a href="{{ route('penjualan.index') }}" class="btn btn-secondary">Kembali</a>
            <table class="table table-bordered table-striped table-responsive mt-3">
                <thead>
                    <tr class="text-center">
                        <th>penjualan Id</th>
                        <th>Nama Barang</th>
                        <th>Qty</th>
                        <th>Harga</th>
                        <th>Subtotal</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($penjualan->detail_penjualan as $item)
                        <tr class="text-center">
                            <td>{{ $item->penjualan_id }}</td>
                            <td>{{ $item->barang->nama }}</td>
                            <td>{{ $item->qty }}</td>
                            <td>{{ $item->harga }}</td>
                            <td>{{ $item->subtotal }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
@section('js')
    <script>
        function deleteData(id) {
            if (confirm("Apakah anda yakin?")) {
                document.getElementById('deleteForm' + id).submit()
            }
            return false;
        }
    </script>
@endsection
