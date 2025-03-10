@extends('layouts.app')

@section('title', 'Edit Pembelian')

@section('content')
    <h2>Edit Pembelian</h2>
    <a href="{{ route('pembelian.index') }}" class="btn btn-secondary">Kembali</a>

    <form action="{{ route('pembelian.update', $pembelian->id) }}" method="POST" class="mt-3">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label class="form-label">No. Faktur</label>
            <input type="text" name="no_faktur" class="form-control" value="{{ $pembelian->no_faktur }}" readonly>
        </div>
        <div class="mb-3">
            <label class="form-label">Tanggal</label>
            <input type="date" name="tanggal" class="form-control" required>
        </div>
        <div>
            <select name="barang_id[]" class="form-control" required>
                <option value="">Pilih Barang</option>
                @foreach ($barang as $item)
                    <option value="{{ $item->id }}">{{ $item->nama }}</option>
                @endforeach
            </select>
        </div>
        <div class="mb-3">
            <label class="form-label">Qty</label>
            <input type="number" name="qty" class="form-control" value="{{ $pembelian->qty }}" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Total</label>
            <input type="number" name="total" class="form-control" value="{{ $pembelian->total }}" required>
        </div>

        <button style=" margin-left: 600px;" type="submit" class="btn btn-primary mt-3">Simpan</button>
    </form>
    </div>



@endsection
