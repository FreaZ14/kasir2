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
                    <th>Subtotal</th>
                </tr>
            </thead>
            <tbody>
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
                        <td><input type="number" name="harga[]" class="form-control" value="{{ $item->harga }}" required>
                        </td>
                        <td><input type=" number" name="subtotal[]" class="form-control" value="{{ $item->subtotal }}"</td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <div class="mb-3">
            <label class="form-label">Total Harga</label>
            <input type="number" name="total" class="form-control" value="{{ $pembelian->total }}" required>
        </div>

        <button type="submit" class="btn btn-primary">Simpan</button>
    </form>

@endsection
