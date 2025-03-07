@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="d-flex align-items-center justify-content-between">
            <h2 class="card-title">Tambah Barang</h2>

            <a href="{{ route('barang.index') }}" class="btn btn-secondary">Kembali</a>
        </div>
        <form action="{{ route('barang.store') }}" method="POST" enctype="multipart/form-data" class="mt-3 mb-3 ">
            @csrf
            <div class="mb-3">
                <label class="form-label">Nama Barang</label>
                <input type="text" name="nama" class="form-control" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Stok</label>
                <input type="number" name="stok" class="form-control" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Harga Jual</label>
                <input type="number" name="harga_jual" class="form-control" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Satuan</label>
                <input type="text" name="satuan" class="form-control" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Keterangan</label>
                <textarea name="keterangan" class="form-control"></textarea>
            </div>
            <div class="mb-3">
                <label class="form-label">Gambar</label>
                <input type="file" name="gambar" class="form-control">
            </div>
            <button type="submit" class="btn btn-primary">Simpan</button>
        </form>
    </div>
@endsection
