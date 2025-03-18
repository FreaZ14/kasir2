@extends('layouts.app')

@section('title', 'Edit Pembelian')

@section('content')
    {{-- @dump(session()->all()) --}}
    <h2>Edit Pembelian</h2>
    <a href="{{ route('pembelian.index') }}" class="btn btn-secondary">Kembali</a>

    <form action="{{ route('pembelian.update', $pembelian->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label class="form-label">No Faktur</label>
            <input type="text" name="no_faktur" class="form-control" value="{{ $pembelian->no_faktur }}" readonly>
        </div>
        <div class="mb-3">
            <label class="form-label">Tanggal</label>
            <input type="date" name="tanggal" class="form-control" value="{{ $pembelian->tanggal }}" required>
        </div>
        <table class="table table-bordered table-striped table-responsive mt-3">
            <thead>
                <tr class="text-center">
                    <th>Nama Barang</th>
                    <th>Qty</th>
                    <th>Harga</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody id="edit-container">
                @foreach ($pembelian->detail_pembelian as $item)
                    <tr class="text-center">

                        <td><select name="barang_id[]" class="form-control" required>
                                <option value="">Pilih Barang</option>
                                @foreach ($barang as $b)
                                    <option {{ $b->id == $item->barang_id ? 'selected' : '' }} value="{{ $b->id }}">
                                        {{ $b->nama }}</option>
                                @endforeach
                            </select></td>
                        <td> <input type="number" name="qty[]" class="form-control" value="{{ $item->qty }}" required>
                        </td>
                        <td><input type="number" name="harga[]" class="form-control" value="{{ $item->harga }}" required
                                readonly>
                        </td>

                        <td><button type="button" class="btn btn-danger remove-barang">Hapus</button></td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <div class="mb-3">
            <label class="form-label">Total Harga</label>
            <input type="number" name="total" id="subtotal" class="form-control" value="{{ $pembelian->total }}"
                required>
        </div>

        <button type="button" id="tambah-barang2" class="btn btn-success mt-0">Tambah Barang</button>
        <button style=" margin-left: 600px;" type="submit" class="btn btn-primary">Simpan</button>
    </form>

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

        document.getElementById('tambah-barang2').addEventListener('click', function() {
            let container = document.getElementById('edit-container');
            let tr = document.createElement('tr');
            tr.classList.add('edit-barang-item');
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
            <td class="text-center"><button type="button" class="btn btn-danger remove-barang">Hapus</button></td>
            
            
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
