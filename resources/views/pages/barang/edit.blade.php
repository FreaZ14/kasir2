@extends('layouts.app')

@section('title', 'Edit Barang')

@section('breadcrumb')
    <div class="pagetitle">
        <h1>Edit Barang</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/dashboard">Home</a></li>
                <li class="breadcrumb-item"><a href="{{ route('barang.index') }}">Barang</a></li>
                <li class="breadcrumb-item active">Edit Barang</li>
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
                        <h3 class="card-title">Edit Barang</h3>
                        <a href="{{ route('barang.index') }}" class="btn btn-primary">Kembali</a>
                    </div>
                </div>
                <div class="card-body">
                    <form action="{{ route('barang.update', $barang->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="mb-3">
                            <label for="nama" class="form-label">Nama</label>
                            <input value="{{ $barang->nama }}" name="nama" type="text" class="form-control"
                                id="nama" placeholder="Nama Barang">
                        </div>
                        <div class="mb-3">
                            <label for="stok" class="form-label">Stok</label>
                            <input value="{{ $barang->stok }}" name="stok" type="number" class="form-control"
                                id="stok" placeholder="Stok Barang">
                        </div>
                        <div class="mb-3">
                            <label for="harga" class="form-label">Harga</label>
                            <input value="{{ $barang->harga }}" name="harga" type="number" class="form-control"
                                id="harga" placeholder="Harga Barang">
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
