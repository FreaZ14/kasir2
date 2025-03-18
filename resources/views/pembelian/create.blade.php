@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>Tambah Pembelian</h2>
        <a href="{{ route('pembelian.index') }}" class="btn btn-secondary">Kembali</a>

        <form action="{{ route('pembelian.store') }}" method="POST" class="mt-3">
            @csrf
            <div class="mb-3">
                <label class="form-label">No. Faktur</label>
                <input type="text" name="no_faktur" class="form-control" value="{{ $noFaktur }}" readonly>
            </div>
            <div class="mb-3">
                <label class="form-label">Tanggal</label>
                <input type="date" name="tanggal" class="form-control" value="{{ date('Y-m-d') }}" required>
            </div>

            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Nama Barang</th>
                        <th>Qty</th>
                        <th>Harga</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody id="barang-container">
                    <tr class="barang-item">
                        <td>
                            <select name="barang_id[]" class="form-control" required>
                                <option value="">Pilih Barang</option>
                                @foreach ($barang as $item)
                                    <option data-harga="{{ $item->harga_jual }}" value="{{ $item->id }}">
                                        {{ $item->nama }}</option>
                                @endforeach
                            </select>
                        </td>
                        <td><input type="number" name="qty[]" class="form-control" placeholder="Jumlah" required></td>
                        <td><input type="number" name="harga[]" class="form-control" placeholder="Harga" required>
                        </td>
                        <td><button type="button" class="btn btn-danger remove-barang">Hapus</button></td>
                    </tr>
                </tbody>
            </table>
            <div class="mb-3">
                <label class="form-label">Subtotal</label>
                <input type="number" id="subtotal" class="form-control" readonly>
            </div>
            <button type="button" id="tambah-barang" class="btn btn-success mt-2">Tambah Barang</button>
            <button style=" margin-left: 600px;" type="submit" class="btn btn-primary mt-3">Simpan</button>
        </form>
    </div>

    <script>
        function calculateSubtotal() {
            let subtotals = document.querySelectorAll('input[name="harga[]"]');
            let qtys = document.querySelectorAll('input[name="qty[]"]');
            let total = 0;
            subtotals.forEach((input, index) => {
                total += parseFloat(input.value) * parseFloat(qtys[index].value) || 0;
            });
            document.getElementById('subtotal').value = total;
        }

        document.getElementById('tambah-barang').addEventListener('click', function() {
            let container = document.getElementById('barang-container');
            let tr = document.createElement('tr');
            tr.classList.add('barang-item');
            tr.innerHTML = `
            <td>
                <select name="barang_id[]" class="form-control" required>
                    <option value="">Pilih Barang</option>
                    @foreach ($barang as $item)
                        <option data-harga="{{ $item->harga_jual }}" value="{{ $item->id }}">{{ $item->nama }}</option>
                    @endforeach
                </select>
            </td>
            <td><input type="number" name="qty[]" class="form-control" placeholder="Jumlah" required></td>
            <td><input type="number" name="harga[]" class="form-control" placeholder="Harga" required></td>
            <td><button type="button" class="btn btn-danger remove-barang">Hapus</button></td>
            
        `;
            container.appendChild(tr);
            calculateSubtotal();
        });

        document.addEventListener('change', function(e) {
            if (e.target.tagName === 'SELECT') {
                let harga = e.target.options[e.target.selectedIndex].getAttribute('data-harga');
                e.target.parentNode.nextElementSibling.nextElementSibling.firstElementChild.value = harga;
                calculateSubtotal();
            }
        });

        document.addEventListener('input', function(e) {
            if (e.target.tagName === 'INPUT' && e.target.name === 'qty[]') {
                calculateSubtotal();
            }
        });

        document.addEventListener('click', function(e) {
            if (e.target.classList.contains('remove-barang')) {
                e.target.parentElement.parentElement.remove();
                calculateSubtotal();
            }
        });
    </script>
@endsection
