@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>Tambah Penjualan</h2>
        <a href="{{ route('penjualan.index') }}" class="btn btn-secondary">Kembali</a>

        <form action="{{ route('penjualan.store') }}" method="POST" class="mt-3">
            @csrf
            <div class="mb-3">
                <label class="form-label">No. Faktur</label>
                <input type="text" name="no_faktur" class="form-control" value="{{ $noFaktur }}" readonly>
            </div>
            <div class="mb-3">
                <label class="form-label">Tanggal</label>
                <input type="date" name="tanggal" class="form-control" required>
            </div>

            <div id="barang-container">
                <div class="barang-item">
                    <select name="barang_id[]" class="form-control" required>
                        <option value="">Pilih Barang</option>
                        @foreach ($barang as $item)
                            <option value="{{ $item->id }}">{{ $item->nama }}</option>
                        @endforeach
                    </select>
                    <input style="margin-top: 10px;" type="number" name="qty[]" class="form-control" placeholder="Qty"
                        required>
                    <input style="margin-top: 10px;" type="number" name="harga[]" class="form-control" placeholder="Harga"
                        required>
                    <button style="margin-top: 10px;" type="button" class="btn btn-danger remove-barang">Hapus</button>
                </div>
            </div>
            <button type="button" id="tambah-barang" class="btn btn-success mt-2">Tambah Barang</button>
            <button style=" margin-left: 600px;" type="submit" class="btn btn-primary mt-3">Simpan</button>
        </form>
    </div>

    <script>
        document.getElementById('tambah-barang').addEventListener('click', function() {
            let container = document.getElementById('barang-container');
            let div = document.createElement('div');
            div.classList.add('barang-item');
            div.innerHTML = `
            <select style="margin-top: 10px;" name="barang_id[]" class="form-control" required>
                <option value="">Pilih Barang</option>
                @foreach ($barang as $item)
                    <option value="{{ $item->id }}">{{ $item->nama }}</option>
                @endforeach
            </select>
            <input style="margin-top: 10px;" type="number" name="qty[]" class="form-control" placeholder="Jumlah" required>
            <input style="margin-top: 10px;" type="number" name="harga[]" class="form-control" placeholder="Harga" required>
            <button style="margin-top: 10px;" type="button" class="btn btn-danger remove-barang">Hapus</button>
        `;
            container.appendChild(div);
        });

        document.addEventListener('click', function(e) {
            if (e.target.classList.contains('remove-barang')) {
                e.target.parentElement.remove();
            }
        });
    </script>
@endsection
