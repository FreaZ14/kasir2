@extends('layouts.app')

@section('title', 'Tambah Barang')

@section('breadcrumb')
    <div class="pagetitle">
        <h1>Tambah Barang</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/dashboard">Home</a></li>
                <li class="breadcrumb-item"><a href="{{ route('barang.index') }}">Barang</a></li>
                <li class="breadcrumb-item active">Tambah Barang</li>
            </ol>
        </nav>
    </div>
@endsection

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex align-items-center justify-content-between">
                        <h3 class="card-title">Tambah Barang</h3>
                        <a href = "{{ route('barang.index') }}" class="btn btn-primary">Kembali</a>
                    </div>
                </div>
                <div class="card-body">
                    <form action="{{ route('barang.store') }}" method="POST">
                        @csrf
                        <form>
                            <div class="mb-3">
                                <label for="nama" name="nama" class="form-label">Nama</label>
                                <input name="nama" type="text" class="form-control" id="nama"
                                    placeholder="Nama Barang">
                            </div>
                            <div class="mb-3">
                                <label for="stok" name="stok" class="form-label">Stok</label>
                                <input name="stok" type="number" class="form-control" id="stok"
                                    placeholder="Stok Barang">
                            </div>
                            <div class="mb-3">
                                <label for="harga" name="harga" class="form-label">Harga</label>
                                <input name="harga" type="number" class="form-control" id="harga"
                                    placeholder="Harga Barang">
                            </div>
                            <div>
                                <div class="mb-3">
                                    <label for="gambar" class="form-label">Gambar</label>
                                    <input class="form-control @error('gambar') is-invalid @enderror" type="file"
                                        id="gambar" name="gambar">
                                    @error('gambar')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="d-flex justify-content-end">
                                    <button type="submit" class="btn btn-primary">Simpan</button>
                                </div>
                        </form>
                </div>
            </div>
        </div>
    </div>
@endsection
